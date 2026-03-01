<?php

namespace App\Http\Requests\Village;

use Illuminate\Foundation\Http\FormRequest;

class StoreVillageRequest extends FormRequest
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
            'name'        => 'required|string|max:255|unique:villages,name',
            'district_id' => 'required|integer|exists:districts,id',
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
            'name.required'        => 'Nama desa/kelurahan wajib diisi.',
            'name.unique'          => 'Nama desa/kelurahan sudah terdaftar.',
            'name.max'             => 'Nama desa/kelurahan maksimal 255 karakter.',
            'district_id.required' => 'Kecamatan wajib dipilih.',
            'district_id.integer'  => 'Kecamatan tidak valid.',
            'district_id.exists'   => 'Kecamatan tidak ditemukan.',
        ];
    }
}