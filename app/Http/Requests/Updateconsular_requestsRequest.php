<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class Updateconsular_requestsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 🟢 UNLOCKED
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
            // 🟢 Swaps "required" for "sometimes" to handle optional, partial file modifications
            "citizen_id" => ["sometimes", "integer", "exists:citizens,citizen_id"],
            "request_type" => ["sometimes", "string", "in:Passport Renewal,Birth Registration,Emergency Assistance"],
            "request_status" => ["sometimes", "string", "in:Received,In Progress,Completed"],

        ];
    }
}
