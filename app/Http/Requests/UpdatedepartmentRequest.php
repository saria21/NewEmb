<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatedepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 🟢 FIXED: Points to your true database column named 'id' instead of 'building_id'
            "building_id" => ["sometimes", "integer", "exists:related_buildings,id"],
            
            "department_name" => ["sometimes", "string", "max:255"],
        ];
    }
}
