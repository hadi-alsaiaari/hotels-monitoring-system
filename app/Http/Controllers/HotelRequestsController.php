<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Validation\Rule;
use App\Events\FinshAddingRooms;
use App\Events\DetermineDateGoingDown;
use App\Events\HotelLicenseIssuanceFee;
use App\Events\ReplyToRequestToOpenHotel;
use App\Events\InitialAcceptanceToRequestToOpenHotel;
use App\Models\HotelRequest;
use App\Services\UploadFile;

class HotelRequestsController extends Controller
{
    public function index()
    {
        $this->authorize('hotel-requests.reply');

        $hotels = Hotel::where('status', 'inactive')
            ->with('hotel_owner.identity', 'phone_numbers',)
            ->withCount('rooms')
            ->get();

        return view('tourism_office.hotel_requests.index', [
            'hotels' => $hotels,
        ]);
    }

    public function show($id)
    {
        $this->authorize('hotel-requests.reply');

        $hotel = Hotel::findOrFail($id)->load('hotel_owner.identity', 'documents', 'rooms', 'phone_numbers');
        $hotel_request = $hotel->hotel_request;
        return view('tourism_office.hotel_requests.show', [
            'hotel' => $hotel,
            'hotel_request' => $hotel_request,
        ]);
    }


    // ---------------------------------------------Setp One---------------------------------------------
    // request
    public function finshAddedRooms($id)
    {
        $hotel = Hotel::where('id', $id)->where('status', '=', 'inactive')->first();
        if ($hotel) {
            $hotel->update([
                'license' => 'request2',
            ]);
            event(new FinshAddingRooms($hotel));

            $notification = array(
                'message' => 'Send Information of rooms to Tourism Office successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        return abort(404);
    }
    // request2


    // ---------------------------------------------Setp TWO---------------------------------------------
    // request2
    public function determineDateGoingDownToHotel($id)
    {
        $this->authorize('hotel-requests.reply');

        $hotel = Hotel::where('id', $id)->where('status', '=', 'inactive')->first();
        if ($hotel) {
            $request = request();
            $request->validate([
                'date' => ['required', 'date', 'after:' . now()->format('Y-m-d')],
            ]);
            $date = $request->date;
            event(new DetermineDateGoingDown($hotel, $date));
            $hotel_request = $hotel->hotel_request()->create([
                'hotel_id' => $hotel->id,
                'field_landing_at' => $request->date,
            ]);
            $notification = array(
                'message' => 'Send the date to hotel owner successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'THe hotel is not exist.',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
    // processing


    // ---------------------------------------------Setp Three---------------------------------------------
    // processing
    public function initialAcceptance($id)
    {
        $this->authorize('hotel-requests.reply');

        $hotel = Hotel::where('id', $id)->where('status', '=', 'inactive')->first();
        if (!$hotel) {
            $notification = array(
                'message' => 'THe hotel is not exist.',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }
        $request = request();
        $request->validate([
            'status' => ['required', 'in:1,0'],
            'field_landing_report' => ['required', 'mimes:pdf', 'max:5150'],
            'money' => [
                Rule::requiredIf(function () use ($request) {
                    return !($request->input('status' == true));
                }),
                'numeric',
            ],
            'account' => [
                Rule::requiredIf(function () use ($request) {
                    return !($request->input('status' == true));
                }),
                'string',
            ],
            'class' => [
                Rule::requiredIf(function () use ($request) {
                    return !($request->input('status' == true));
                }),
                'string',
                'in:one,two,three,four,five',
            ],
            'bank' => [
                Rule::requiredIf(function () use ($request) {
                    return !($request->input('status' == true));
                }),
                'string',
            ],
        ]);
        $money = $request->money;
        $account = $request->account;
        $status = $request->status;
        $class = $request->class;
        $bank = $request->bank;
        $field_landing_report = UploadFile::newUploadFile($request, 'field_landing_report');
        if ($status) {
            $hotel_request = $hotel->hotel_request()->update([
                'account' => $account,
                'money' => $money,
                'bank' => $bank,
                'class' => $class,
                'field_landing_report' => $field_landing_report,
            ]);
        } else {
            $hotel_request = $hotel->hotel_request()->update([
                'field_landing_report' => $field_landing_report,
            ]);
        }

        event(new InitialAcceptanceToRequestToOpenHotel($hotel, $status, $money, $account, $class));

        $notification = array(
            'message' => 'Send initial acceptance to hotel owner successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // preparation or rejected


    // ---------------------------------------------Setp Four---------------------------------------------
    // preparation
    public function licenseIssuanceFee($id)
    {
        $hotel = Hotel::where('id', $id)->where('status', '=', 'inactive')->first();
        if (!$hotel) {
            return abort(404);
        }

        $request = request();

        $request->validate([
            'transfer_deed' => ['required', 'mimes:pdf', 'max:5150'],
        ]);
        $transfer_deed = UploadFile::newUploadFile($request, 'transfer_deed');
        $hotel->update([
            'license' => 'preparation2',
        ]);
        $hotel_request = $hotel->hotel_request()->update([
            'transfer_deed' => $transfer_deed,
        ]);
        event(new HotelLicenseIssuanceFee($hotel, $transfer_deed));

        $notification = array(
            'message' => 'Send document of license issuance fee to Tourism Office successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // preparation2


    // ---------------------------------------------Setp Five---------------------------------------------
    // preparation2
    public function hotelOpeningRequest($id)
    {
        $this->authorize('hotel-requests.reply');

        $hotel = Hotel::where('id', $id)->where('status', '=', 'inactive')->first();
        if (!$hotel) {
            $notification = array(
                'message' => 'THe hotel is not exist.',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }
        $request = request();
        $request->validate([
            'status' => ['required', 'in:1,0'],
        ]);
        $status = $request->status;
        event(new ReplyToRequestToOpenHotel($hotel, $status));

        $notification = array(
            'message' => 'The approval has been send to the hotel owner successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
    // valid or preparation

    public function hotelRenewalRequest1($id)
    {
        $hotel = Hotel::where('id', $id)->where('status', '=', 'active')->where('license', '=', 'renewal')->first();
        if (!$hotel) {
            return abort(404);
        }

        $request = request();

        $request->validate([
            'transfer_deed' => ['required', 'mimes:pdf', 'max:5150'],
        ]);
        $transfer_deed = UploadFile::newUploadFile($request, 'transfer_deed');
        $hotel->update([
            'license' => 'renewal2',
        ]);
        $document = $hotel->documents()->create([
            'file' => $transfer_deed,
            'type' => 'license_renewal_fee',
        ]);
        event(new HotelLicenseIssuanceFee($hotel, $transfer_deed));

        $notification = array(
            'message' => 'Send document of license renewal fee to Tourism Office successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function hotelRenewalRequestq2($id)
    {
        $this->authorize('hotel-requests.reply');

        $hotel = Hotel::where('id', $id)->where('status', '=', 'active')->where('license', '=', 'renewal2')->first();
        if (!$hotel) {
            $notification = array(
                'message' => 'THe hotel is not exist.',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }
        $request = request();
        $request->validate([
            'status' => ['required', 'in:1,0'],
        ]);
        $status = $request->status;
        event(new ReplyToRequestToOpenHotel($hotel, $status));

        $notification = array(
            'message' => 'The approval has been send to the hotel owner successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
