<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 🟢 Maps the unique primary key for the embassy employee profile
            "staff_id" => $this->staff_id,

            // 🟢 Exposes the foreign key linking this worker to their active structural division
            "department_id" => $this->department_id,

            // 🟢 FIXED: Maps directly to your real database schema full_name column!
            "full_name" => $this->full_name,

            // 🟢 FIXED: Captures the precise professional assignment role from your schema
            "job_title" => $this->job_title,

            // 🟢 Displays the assigned operational workspace role (e.g. Visa Officer, Security Guard)
            "role" => $this->role,

            // 🟢 Standard database auditing timestamps parsed into clean datetime segments
            "created_at" => $this->created_at?->toDateTimeString(),
            "updated_at" => $this->updated_at?->toDateTimeString(),
        ];
    }
}
