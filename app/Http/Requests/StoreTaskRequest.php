<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'max:255'],
            'case_type' => ['required', 'max:255'],
            'region' => ['required', 'max:255'],
            'customer' => ['required', 'max:255'],
            'reference_number' => ['required', 'max:255'],
            //
        ];
    }
}
