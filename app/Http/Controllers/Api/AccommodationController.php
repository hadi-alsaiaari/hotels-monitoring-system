<?php

namespace App\Http\Controllers\Api;

use App\Events\AccommodationWithForeign;
use App\Events\AccommodationWithResidentialPermit;
use App\Events\AccommodationWithWantedPeople;
use App\Http\Requests\Api\Accommodation\AddAccommodationRequest;
use App\Http\Requests\Api\Accommodation\AddGuestRequest;
use App\Http\Requests\Api\Accommodation\ExitAccommodationRequest;
use App\Http\Requests\Api\Accommodation\ExitGuestRequest;
use App\Http\Resources\AccommodationResource;
use App\Models\Accommodation;
use App\Models\AccommodationDetails;
use App\Models\Firearm;
use App\Models\Guest;
use App\Models\ResidentialPermit;
use App\Models\WantedPeople;
use Exception;
use Illuminate\Support\Facades\DB;

class AccommodationController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotel = request()->user()->user_of_hotel()->firstOrFail()->hotel()->firstOrFail();

        $accommodations = $hotel->accommodations()->withCount('accommodation_details')->get();

        return AccommodationResource::collection($accommodations);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hotel_id = request()->user()->user_of_hotel()->firstOrFail()->hotel()->firstOrFail()->id;

        $accommodation = Accommodation::where('hotel_system_booking_id', $id)->where('hotel_id', $hotel_id)->withCount('accommodation_details')->firstOrFail()->load('accommodation_details');

        return AccommodationResource::make($accommodation);
    }

    public function AddAccommodation(AddAccommodationRequest $request)
    {
        $validated = $request->safe()->all();

        $hotel_receptionist = $request->user()->user_of_hotel()->firstOrFail();
        $room = $hotel_receptionist->hotel->rooms()->where('number', $validated['roomNumber'])->firstOrFail();
        $firearms = empty($validated['firearms']) ? '' : $validated['firearms'];
        $order_guest_firearm = 0;
        $escort_with = null;
        $number_foreign = 0;
        $all_wanted_people = WantedPeople::where("sure_at", null)->get();
        $number_wanted_people = [0, 0];
        $type_wanted_people_count = [0, 0];

        if ($room->price < $validated['price']) {
            return response()->json(['errors' => ['price' => ['Entered price is greater than room\'s price.']]], 422);
        }

        $same_room_booking = Accommodation::where('room_id', $room->id)->where('departure_at', null)->first();
        if ($same_room_booking) {
            return response()->json(['errors' => ['roomNumber' => ['Room is already booked for another guest!']]], 422);
        }

        if (count($validated['guests']) != count(collect($validated['guests'])->unique('identityNumber'))) {
            return response()->json(['errors' => ['guests.*.identityNumber' => ['There is a duplicate in the identities number of guests.']]], 422);
        }

        if (isset($validated['firearms']) && count($validated['firearms']) != count(collect($validated['firearms'])->unique('firearmSerialNumber'))) {
            return response()->json(['errors' => ['firearms.*.firearmSerialNumber' => ['There is a duplicate in the serials number for firearms.']]], 422);
        }

        DB::beginTransaction();
        try {
            if (isset($validated['numberPermit'])) {
                $residential_permit = ResidentialPermit::where('number_permit', $validated['numberPermit'])->first();
                if (!$residential_permit || $residential_permit->status == 'used_expired' || $residential_permit->status == 'not_used_expired' && ($residential_permit->hotel_id)) {
                    return response()->json(['errors' => ['numberPermit' => ['Invalid residential permit!']]], 422);
                }
                $residential_permit->update(['hotel_id' => $hotel_receptionist->hotel_id, 'status' => 'using']);
            }

            $accommodation = Accommodation::createNewAccommodation($hotel_receptionist->id, $hotel_receptionist->hotel->id, $validated['bookingId'], $validated['price'], isset($validated['notice']) ? $validated['notice'] : '', $validated['arrivalAt'], $validated['expectedDepartureTime'], $room->id, isset($residential_permit) ? $residential_permit->id : null);

            foreach ($validated['guests'] as $number => $guest) {
                $existguest = Guest::createOrGetGuest($guest);
                $accommodation_guests = $existguest->check_guest;
                if (isset($accommodation_guests[0])) {
                    return response()->json(['errors' => ['guests.' . $number . '.identityNumber' => ['This guest is exist in another booking.']]], 422);
                }

                if ($existguest->identity->country != 'ye') {
                    $number_foreign += 1;
                }

                $first_lastG = $existguest->identity->first_name . ' ' . $existguest->identity->last_name;
                $second_lastG = $existguest->identity->second_name . ' ' . $existguest->identity->last_name;
                $third_lastG = $existguest->identity->third_name . ' ' . $existguest->identity->last_name;
                $identity_numberG = $existguest->identity->identity_number;

                if (isset($firearms[$order_guest_firearm])) {
                    if ($validated['guestsHaveFirearm'][$order_guest_firearm] == $number) {
                        $firearm = Firearm::createOrGetFirearm($firearms, $order_guest_firearm);
                        $accommodation_firearms = $firearm->check_firearm;
                        if (isset($accommodation_firearms[0])) {
                            return response()->json(['errors' => ['firearms.' . $number . '.firearmSerialNumber' => ['This firearm is exist in another booking.']]], 422);
                        }
                        $order_guest_firearm++;
                    }
                }

                $accommodation_details_id = AccommodationDetails::addNewGuestToAccommodation($accommodation, $existguest->id, $validated['bookingDetailsId'][$number], $escort_with, empty($firearm) ? null : $firearm->id, $validated['arrivalAt'], $validated['expectedDepartureTime']);

                foreach ($all_wanted_people as $counts => $wanted_people) {
                    $first_lastW = $wanted_people->first_name . ' ' . $wanted_people->last_name;
                    $second_lastW = $wanted_people->second_name . ' ' . $wanted_people->last_name;
                    $third_lastW = $wanted_people->third_name . ' ' . $wanted_people->last_name;
                    $identity_numberW = $wanted_people->identity_number;

                    if (($first_lastG == $first_lastW) || ($second_lastG == $second_lastW) || ($third_lastG == $third_lastW) || ($identity_numberG == $identity_numberW)) {
                        $wanted_people->accommodations_details()->attach([
                            $accommodation_details_id => [
                                'detection_at' => now(),
                            ]
                        ]);
                        if ($wanted_people->policable_type == 'App\Models\TouristPolice') {
                            $number_wanted_people[0] += 1;
                            $type_wanted_people_count[0] = 'App\Models\TouristPolice';
                        } else {
                            $number_wanted_people[1] += 1;
                            $type_wanted_people_count[1] = 'App\Models\SecurityDepartmentOffice';
                        }
                    }
                }
                if ($number == 0) {
                    $escort_with = $accommodation->lastGuest()->first()->pivot->id;
                }
            }

            $percentage = DB::selectOne('
                select percentage
                from tax_percentages
                where (tax_percentages.status = "used") && (tax_percentages.class = ?);
            ', [$hotel_receptionist->hotel->class]);
            $tax_value = $accommodation->price * ($percentage->percentage / 100);
            $accommodation->tax()->create([
                'hotel_id' => $hotel_receptionist->hotel_id,
                'tax_value' => $tax_value,
            ]);

            if (isset($residential_permit)) {
                $accommodation = $accommodation->load('hotel:id,trade_name');
                $residential_permit = $accommodation->residential_permit()->withCount('permit_seekers')->first();
                event(new AccommodationWithResidentialPermit($accommodation, $residential_permit));
            }

            if ($number_foreign > 0) {
                event(new AccommodationWithForeign($accommodation, $number_foreign));
            }

            if (isset($number_wanted_people)) {
                event(new AccommodationWithWantedPeople($accommodation, $number_wanted_people, $type_wanted_people_count));
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->sendResponse("Added the booking $accommodation->hotel_system_booking_id successfully", 201);
    }

    public function addGuest(AddGuestRequest $request)
    {
        $validated = $request->safe()->all();

        $hotel_receptionist = $request->user()->user_of_hotel()->firstOrFail();
        $room = $hotel_receptionist->hotel->rooms()->where('number', $validated['roomNumber'])->firstOrFail();
        $firearms = empty($validated['firearms']) ? '' : $validated['firearms'];
        $order_guest_firearm = 0;
        $number_foreign = 0;
        $all_wanted_people = WantedPeople::where("sure_at", null)->get();
        $number_wanted_people = [0, 0];
        $type_wanted_people_count = [0, 0];

        $accommodation = Accommodation::where('room_id', $room->id)->where('hotel_system_booking_id', $validated['bookingId'])->where('departure_at', null)->first();
        if (empty($accommodation)) {
            return response()->json(['errors' => ['roomNumber' => ['Room is not booked in this day']]], 422);
        }

        if (count($validated['guests']) != count(collect($validated['guests'])->unique('identityNumber'))) {
            return response()->json(['errors' => ['guests.*.identityNumber' => ['There is a duplicate in the identities number of guests.']]], 422);
        }

        if (isset($validated['firearms']) && count($validated['firearms']) != count(collect($validated['firearms'])->unique('firearmSerialNumber'))) {
            return response()->json(['errors' => ['firearms.*.firearmSerialNumber' => ['There is a duplicate in the serials number for firearms.']]], 422);
        }

        DB::beginTransaction();
        try {
            Accommodation::find($accommodation->id)->update([
                'hotel_receptionist_id' => $hotel_receptionist->id,
            ]);

            $escort_with = $accommodation->firstGuest[0]['pivot']['id'];

            foreach ($validated['guests'] as $number => $guest) {
                $existguest = Guest::createOrGetGuest($guest);
                $accommodation_guests = $existguest->check_guest;

                if (!empty($accommodation_guests[0])) {
                    return response()->json(['errors' => ['guests.' . $number . '.identityNumber' => ['This guest is exist in another booking.']]], 422);
                }

                if ($existguest->identity->country != 'ye') {
                    $number_foreign += 1;
                }

                $first_lastG = $existguest->identity->first_name . ' ' . $existguest->identity->last_name;
                $second_lastG = $existguest->identity->second_name . ' ' . $existguest->identity->last_name;
                $third_lastG = $existguest->identity->third_name . ' ' . $existguest->identity->last_name;
                $identity_numberG = $existguest->identity->identity_number;

                if (!empty($firearms[$order_guest_firearm])) {
                    if ($validated['guestsHaveFirearm'][$order_guest_firearm] == $number) {
                        $firearm = Firearm::createOrGetFirearm($firearms, $order_guest_firearm);
                        $accommodation_firearms = $firearm->check_firearm;
                        if (!empty($accommodation_firearms[0])) {
                            return response()->json(['errors' => ['firearms.' . $number . '.firearmSerialNumber' => ['This firearm is exist in another booking.']]], 422);
                        }
                        $order_guest_firearm++;
                    }
                }

                $accommodation_details_id = AccommodationDetails::addNewGuestToAccommodation($accommodation, $existguest->id, $validated['bookingDetailsId'], $escort_with, empty($firearm) ? null : $firearm->id, $validated['arrivalAt'], $validated['expectedDepartureTime']);

                foreach ($all_wanted_people as $counts => $wanted_people) {
                    $first_lastW = $wanted_people->first_name . ' ' . $wanted_people->last_name;
                    $second_lastW = $wanted_people->second_name . ' ' . $wanted_people->last_name;
                    $third_lastW = $wanted_people->third_name . ' ' . $wanted_people->last_name;
                    $identity_numberW = $wanted_people->identity_number;

                    if (($first_lastG == $first_lastW) || ($second_lastG == $second_lastW) || ($third_lastG == $third_lastW) || ($identity_numberG == $identity_numberW)) {
                        $wanted_people->accommodations_details()->attach([
                            $accommodation_details_id => [
                                'detection_at' => now(),
                            ]
                        ]);
                        if ($wanted_people->policable_type == 'App\Models\TouristPolice') {
                            $number_wanted_people[0] += 1;
                            $type_wanted_people_count[0] = 'App\Models\TouristPolice';
                        } else {
                            $number_wanted_people[1] += 1;
                            $type_wanted_people_count[1] = 'App\Models\SecurityDepartmentOffice';
                        }
                    }
                }
            }

            $type_wanted_people_count = array_unique($type_wanted_people_count);
            $type_wanted_people_count = array_values($type_wanted_people_count);
            if ($number_foreign > 0) {
                event(new AccommodationWithForeign($accommodation, $number_foreign));
            }
            if (isset($number_wanted_people)) {
                event(new AccommodationWithWantedPeople($accommodation, $number_wanted_people, $type_wanted_people_count));
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->sendResponse("Added new guests to booking $accommodation->hotel_system_booking_id successfully", 201);
    }

    public function exitAccommodation(ExitAccommodationRequest $request)
    {
        $validated = $request->safe()->all();

        $hotel_receptionist = $request->user()->user_of_hotel()->firstOrFail();
        $room = $hotel_receptionist->hotel->rooms()->where('number', $validated['roomNumber'])->firstOrFail();

        $accommodation = Accommodation::where('room_id', $room->id)->where('hotel_system_booking_id', $validated['bookingId'])->where('departure_at', null)->first();
        if (empty($accommodation)) {
            return response()->json(['errors' => ['roomNumber' => ['Room is not booked in this day']]], 422);
        }

        DB::beginTransaction();
        try {
            $accommodation->update([
                'departure_at' => now(),
            ]);
            $accommodation->guests()->update([
                'departure_at' => now(),
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->sendResponse("exited the booking $accommodation->hotel_system_booking_id successfully", 200);
    }

    public function exitGuest(ExitGuestRequest $request)
    {
        $validated = $request->safe()->all();

        $hotel_receptionist = $request->user()->user_of_hotel()->firstOrFail();
        $room = $hotel_receptionist->hotel->rooms()->where('number', $validated['roomNumber'])->firstOrFail();

        $accommodation = Accommodation::where('room_id', $room->id)->where('hotel_system_booking_id', $validated['bookingId'])->where('departure_at', null)->first();
        if (empty($accommodation)) {
            return response()->json(['errors' => ['roomNumber' => ['Room is not booked in this day']]], 422);
        }

        $guest = AccommodationDetails::where('accommodation_id', $accommodation->id)->where('hotel_system_booking_details_id', $validated['bookingDetailsId'])->where('departure_at', null)->first();
        if (!$guest) {
            return response()->json(['errors' => ['bookingDetailsId' => ['The guest is not exit']]], 422);
        }
        $guest->update([
            'departure_at' => now(),
        ]);

        $guests = AccommodationDetails::where('accommodation_id', $accommodation->id)->where('departure_at', null)->get();
        if (empty($guests[0])) {
            $accommodation->update([
                'departure_at' => now(),
            ]);
        }

        return $this->sendResponse("exited guest $guest->hotel_system_booking_details_id in booking $accommodation->hotel_system_booking_id successfully", 200);
    }
}
