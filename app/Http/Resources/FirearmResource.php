<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FirearmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'firearmSerialNumber' => $this->firearm_serial_number,
            'firearmType' => $this->firearm_type,
            'licenseType' => $this->license_type,
            'licenseNumber' => $this->license_number,
        ];
    }
}
