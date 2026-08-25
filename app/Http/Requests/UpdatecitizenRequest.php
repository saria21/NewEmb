<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatecitizenRequest extends FormRequest
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
        // 🟢 Safely extract the raw integer ID number out of your route bar parameters
        $citizenId = $this->route('citizen')?->citizen_id ?? $this->citizen;

        return [
            // 🟢 FIXED: Passes strictly the integer number string into the exclusion slot to avoid SQL syntax corruption
            "passport_number" => [
                "sometimes", 
                "string", 
                "max:50", 
                "unique:citizens,passport_number," . $citizenId . ",citizen_id"
            ],

            "full_name" => ["sometimes", "string", "max:255"],
            
            "current_address" => ["sometimes", "string", "max:255"],
        ];
    }
}
