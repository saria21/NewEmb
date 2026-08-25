<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "department_id" => $this->department_id,
            "building_id" => $this->building_id,
            
            // 🟢 THIS LINE FIXES IT: Tells Laravel to grab the real string out of the "name" column!
            "department_name" => $this->name, 
            "created_at" => $this->created_at?->toDateTimeString(),
            "updated_at" => $this->updated_at?->toDateTimeString(),
        ];
    }
}
