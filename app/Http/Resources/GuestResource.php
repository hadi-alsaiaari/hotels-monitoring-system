<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $identity = $this->identity;

        return [
            'identityNumber' => $identity->identity_number,
            'firstName' => $identity->first_name,
            'secondName' => $identity->second_name,
            'thirdName' => $identity->third_name,
            'lastName' => $identity->last_name,
            'sex' => $identity->sex,
            'country' => $identity->country,
            'placeOfBirth' => $identity->place_of_birth,
            'dateOfBirth' => $identity->date_of_birth->format("Y-M-d"),
            'issuingAuthority' => $identity->issuing_authority,
            'identityType' => $identity->identity_type,
            'dateOfIssue' => $identity->date_of_issue->format("Y-M-d"),
            'dateOfExpiry' => $identity->date_of_expiry->format("Y-M-d"),
        ];
    }
}
