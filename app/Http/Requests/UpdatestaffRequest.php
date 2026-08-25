<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatestaffRequest extends FormRequest
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
            // 🟢 Optional layout parameters for modifying employee assignments safely
            "department_id" => ["sometimes", "integer", "exists:departments,department_id"],
            "full_name" => ["sometimes", "string", "max:100"],
            "job_title" => ["sometimes", "string", "max:100"],
            "role" => ["sometimes", "string", "in:Security Guard,Visa Officer,Consular Officer,Interviewer,Ambassador,Admin"],
        ];
    }
}
