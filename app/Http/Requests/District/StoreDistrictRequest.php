<?php

namespace App\Http\Requests\District;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistrictRequest extends FormRequest
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
            'name'    => 'required|string|max:255|unique:districts,name',
            'city_id' => 'required|integer|exists:cities,id',
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
            'name.required'    => 'Nama kecamatan wajib diisi.',
            'name.unique'      => 'Nama kecamatan sudah terdaftar.',
            'name.max'         => 'Nama kecamatan maksimal 255 karakter.',
            'city_id.required' => 'Kota wajib dipilih.',
            'city_id.integer'  => 'Kota tidak valid.',
            'city_id.exists'   => 'Kota tidak ditemukan.',
        ];
    }
}