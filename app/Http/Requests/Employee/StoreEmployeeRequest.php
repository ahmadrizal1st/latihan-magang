<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
        return [
            'name'    => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'job_id'  => 'required|exists:employee_jobs,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Nama karyawan wajib diisi.',
            'city_id.required' => 'Kota wajib dipilih.',
            'city_id.exists'   => 'Kota tidak ditemukan.',
            'job_id.required'  => 'Pekerjaan wajib dipilih.',
            'job_id.exists'    => 'Pekerjaan tidak ditemukan.',
        ];
    }
}