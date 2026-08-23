<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsularRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 🟢 Maps the unique primary tracking index for this bureaucratic request file
            "request_id" => $this->request_id,

            // 🟢 Exposes the relational foreign key connecting this file to a registered citizen profile
            "citizen_id" => $this->citizen_id,

            // 🟢 Formats the paperwork category descriptor (e.g. Passport Renewal, Birth Registration)
            "request_type" => $this->request_type,

            // 🟢 Captures the current processing operational status (e.g. Received, In Progress, Completed)
            "request_status" => $this->request_status,
            
            // 🟢 Standard database auditing timestamps parsed into clear datetime string segments
            "created_at" => $this->created_at?->toDateTimeString(),
            "updated_at" => $this->updated_at?->toDateTimeString(),
        ];
    }
}

