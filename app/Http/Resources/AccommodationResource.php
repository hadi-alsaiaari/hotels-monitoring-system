<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccommodationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $room = $this->room()->first();
        $residential_permit = $this->residential_permit()->first();

        return [
            'id' => $this->hotel_system_booking_id,
            'roomNumber' => empty($room) ? null : $room->number,
            'numberPermit' => empty($residential_permit) ? null : $residential_permit->number_permit,
            'price' => $this->price,
            'arrivalAt' => $this->arrival_at->format("Y-M-d"),
            'expectedDepartureTime' => $this->expected_departure_time->format("Y-M-d"),
            "numberOfGuests" => $this->accommodation_details_count,
            "guestsInformation" => AccommodationDetailsResource::collection($this->whenLoaded('accommodation_details')),
        ];
    }
}
