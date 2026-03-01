<?php

namespace App\Http\Requests\EmployeeJob;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeJobRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:employee_jobs,name,' . $this->route('id'),
        ];
    }


    /**
     * Custom validation error messages.
     *
     * This method should return an associative array with the rule name as
     * the key and the error message as value.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama pekerjaan wajib diisi.',
            'name.unique'   => 'Nama pekerjaan sudah terdaftar.',
            'name.max'      => 'Nama pekerjaan maksimal 255 karakter.',
        ];
    }
}