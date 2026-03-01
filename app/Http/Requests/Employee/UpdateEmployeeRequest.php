<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Merge the job_id field from the request into the validation data.
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'job_id' => $this->employee_job_id,
        ]);
    }

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
        $employeeId = $this->route('employee');

        return [
            'name'          => 'required|string|max:255',
            'job_id'        => 'required|exists:employee_jobs,id',
            'date_of_birth' => 'required|date|before:today',
            'place_of_birth'=> 'required|string|max:255',
            'address'       => 'required|string|max:500',
            'province_id'   => 'required|exists:provinces,id',
            'city_id'       => 'required|exists:cities,id',
            'district_id'   => 'required|exists:districts,id',
            'village_id'    => 'required|exists:villages,id',
            'postal_code_id'=> 'required|exists:postal_codes,id',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'           => 'Nama karyawan wajib diisi.',
            'name.max'                => 'Nama karyawan maksimal 255 karakter.',

            'job_id.required'         => 'Pekerjaan wajib dipilih.',
            'job_id.exists'           => 'Pekerjaan tidak ditemukan.',

            'date_of_birth.required'  => 'Tanggal lahir wajib diisi.',
            'date_of_birth.date'      => 'Format tanggal lahir tidak valid.',
            'date_of_birth.before'    => 'Tanggal lahir harus sebelum hari ini.',

            'place_of_birth.required' => 'Tempat lahir wajib diisi.',
            'place_of_birth.max'      => 'Tempat lahir maksimal 255 karakter.',

            'address.required'        => 'Alamat wajib diisi.',
            'address.max'             => 'Alamat maksimal 500 karakter.',

            'province_id.required'    => 'Provinsi wajib dipilih.',
            'province_id.exists'      => 'Provinsi tidak ditemukan.',

            'city_id.required'        => 'Kota wajib dipilih.',
            'city_id.exists'          => 'Kota tidak ditemukan.',

            'district_id.required'    => 'Kecamatan wajib dipilih.',
            'district_id.exists'      => 'Kecamatan tidak ditemukan.',

            'village_id.required'     => 'Kelurahan wajib dipilih.',
            'village_id.exists'       => 'Kelurahan tidak ditemukan.',

            'postal_code_id.required' => 'Kode pos wajib dipilih.',
            'postal_code_id.exists'   => 'Kode pos tidak ditemukan.',

            'photo.image'             => 'File harus berupa gambar.',
            'photo.mimes'             => 'Format foto harus jpg, jpeg, atau png.',
            'photo.max'               => 'Ukuran foto maksimal 2MB.',
        ];
    }
}