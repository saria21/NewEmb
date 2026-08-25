<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class Storevisits_logRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 🟢 UNLOCKED: Allows your administrative checkpoint gates to save incoming traffic logs
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
            // 🟢 FIXED: Kept as a simple integer parameter so any visitor identification/passport can pass
            "visitor_id" => ["required", "integer"],

            // 🟢 Links this access log directly to a valid working employee tracking row
            "staff_id" => ["required", "integer", "exists:staff,staff_id"],

            // 🟢 Enforces strict calendar date properties for entry monitoring fields
            "check_in_time" => ["required", "date_format:Y-m-d H:i:s"],

            // 🟢 The exit time is optional upon entering, but must be a valid date if passed
            "check_out_time" => ["nullable", "date_format:Y-m-d H:i:s"],
        ];
    }
}
