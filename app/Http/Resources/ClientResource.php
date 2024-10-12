<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->resource->id,
            'firstName'           => $this->resource->first_name,
            'middleName'          => $this->resource->middle_name,
            'lastName'            => $this->resource->last_name,
            'passportSeries'      => $this->resource->passport_series,
            'passportNumber'      => $this->resource->passport_number,
            'passportNotes'       => $this->resource->passport_notes,
            'birthday'            => $this->resource->birthday->format('Y-m-d'),
            'registrationAddress' => $this->resource->registration_address,
            'residenceAddress'    => $this->resource->residence_address,
            'phoneNumber'         => $this->resource->phone_number,
            'comment'             => $this->resource->comment,
            'branchId'            => $this->resource->branch_id,
            'email'               => $this->resource->email,
            'residentCard'        => $this->resource->resident_card,
            'personnelNumber'     => $this->resource->personnel_number,
            'fullName'            => sprintf(
                '%s %s %s',
                $this->resource->last_name,
                $this->resource->first_name,
                $this->resource->middle_name
            ),
        ];
    }
}
