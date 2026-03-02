<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'company_logo'        => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'company_name'        => 'required|string|max:255',
            'company_address'     => 'nullable|string',
            'company_province_id' => 'nullable|exists:provinces,id',
            'company_city_id'     => 'nullable|exists:cities,id',
            'company_district_id' => 'nullable|exists:districts,id',
            'company_village_id'  => 'nullable|exists:villages,id',
            'company_post_code' => 'nullable|string|max:10',
            'company_phone'       => 'nullable|string|max:20',
            'company_website'     => 'nullable|url|max:255',
            'company_email'       => 'nullable|email|max:255',
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
            'company_name.required' => 'Nama perusahaan wajib diisi.',
            'company_logo.image'    => 'Logo harus berupa file gambar.',
            'company_logo.mimes'    => 'Logo harus berformat jpg, jpeg, png, atau svg.',
            'company_logo.max'      => 'Ukuran logo maksimal 2MB.',
            'company_province_id.exists'   => 'Provinsi yang dipilih tidak valid.',
            'company_city_id.exists'       => 'Kota yang dipilih tidak valid.',
            'company_district_id.exists'   => 'Kecamatan yang dipilih tidak valid.',
            'company_village_id.exists'    => 'Kelurahan yang dipilih tidak valid.',
            'company_website.url'   => 'Format website tidak valid.',
            'company_email.email'   => 'Format email tidak valid.',
        ];
    }
}