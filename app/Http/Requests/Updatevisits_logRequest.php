<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class Updatevisits_logRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            // 🟢 FIXED: Kept open for partial updates using any identification or passport index
            "visitor_id" => ["sometimes", "integer"],
            "staff_id" => ["sometimes", "integer", "exists:staff,staff_id"],
            "check_in_time" => ["sometimes", "date_format:Y-m-d H:i:s"],
            "check_out_time" => ["sometimes", "nullable", "date_format:Y-m-d H:i:s"],
        ];
    }
}
