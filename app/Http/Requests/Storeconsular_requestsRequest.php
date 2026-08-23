<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class Storeconsular_requestsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 🟢 UNLOCKED: Allows the API to accept incoming consular processing requests
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
            // 🟢 Ensures this request is safely mapped back to a valid, registered citizen ID
            "citizen_id" => ["required", "integer", "exists:citizens,citizen_id"],

            // 🟢 Forces paperwork categories to match real-world embassy operations
            "request_type" => ["required", "string", "in:Passport Renewal,Birth Registration,Emergency Assistance"],

            // 🟢 Restricts tracking milestones to official processing sequences
            "request_status" => ["required", "string", "in:Received,In Progress,Completed"],

        ];
    }
}

