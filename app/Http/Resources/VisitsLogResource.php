<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitsLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 🟢 Maps the unique primary key for the checkpoint traffic file row
            "visit_id" => $this->visit_id,

            // 🟢 Connects the profile instance back to the unique arriving civilian entity
            "visitor_id" => $this->visitor_id,

            // 🟢 References the official internal administrative worker tracking slot
            "staff_id" => $this->staff_id,

            // 🟢 Stells your system ledger when they crossed into the security line layout
            "check_in_time" => $this->check_in_time,

            // 🟢 Details when their processing finished and they exited the compound perimeter
            "check_out_time" => $this->check_out_time,

            // 🟢 Standard database auditing timestamps parsed into clean datetime segments
            "created_at" => $this->created_at?->toDateTimeString(),
            "updated_at" => $this->updated_at?->toDateTimeString(),
        ];
    }
}
