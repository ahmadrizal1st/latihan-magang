<?php

namespace App\Http\Requests\PostalCode;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostalCodeRequest extends FormRequest
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
            'code'       => 'required|string|max:10|unique:postal_codes,code,' . $this->route('id'),
        ];
    }

    /**
     * Return validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'code.required'       => 'Kode pos wajib diisi.',
            'code.unique'         => 'Kode pos sudah terdaftar.',
            'code.max'            => 'Kode pos maksimal 10 karakter.',
        ];
    }
}