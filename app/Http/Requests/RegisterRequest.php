<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => [
                'required',
                'string',
                'max:100',
            ],


            'job_title' => [
                'required',
                'string',
                'max:100',
            ],

            'role' => [
                'required',
                Rule::in([
                    'Admin',
                    'Officer',
                    'Coordinator',
                    'Staff',
                ]),
            ],

            'department_id' => [
                'required',
                'integer',
                'exists:departments,department_id',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:staff,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ];
    }
}