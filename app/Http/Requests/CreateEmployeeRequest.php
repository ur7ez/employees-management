<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'min:3', 'max:255'],
            'last_name' => ['required', 'min:3', 'max:255'],
            'middle_name' => ['nullable', 'min:3', 'max:255'],
            'department_id' => ['required', 'exists:departments,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'zip_code' => ['required', 'min:5', 'max:10'],
            'birth_date' => 'nullable|date',
            'date_hired' => 'nullable|date',
        ];
    }
}
