<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccommodationDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $escort_with = null;
        if ($this->escort_with !== null) {
            $escort_with = $this->came_with->hotel_system_booking_details_id;
        }

        return [
            'id' => $this->hotel_system_booking_details_id,
            'escortWith' => $escort_with,
            'arrivalAt' => $this->arrival_at->format("Y-M-d"),
            'expectedDepartureTime' => $this->expected_departure_time->format("Y-M-d"),
            "identityInformation" => GuestResource::make($this->guest),
            "firearmInformation" => FirearmResource::make($this->firearm),
        ];
    }
}
