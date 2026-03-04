<?php

namespace App\Http\Requests\LeaveRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeaveRequestRequest extends FormRequest
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
            'employee_id' => 'required|exists:employees,id',
            'type' => 'required|string|max:255',
            'reason' => 'required|string|max:1000',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'return_date' => 'required|date|after:end_date',
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
            'employee_id.required' => 'Karyawan wajib dipilih.',
            'employee_id.exists' => 'Karyawan tidak ditemukan.',
            'type.required' => 'Tipe cuti wajib diisi.',
            'type.max' => 'Tipe cuti maksimal 255 karakter.',
            'reason.required' => 'Alasan cuti wajib diisi.',
            'reason.max' => 'Alasan cuti maksimal 1000 karakter.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.date' => 'Format tanggal mulai tidak valid.',
            'end_date.required' => 'Tanggal akhir wajib diisi.',
            'end_date.date' => 'Format tanggal akhir tidak valid.',
            'end_date.after_or_equal' => 'Tanggal akhir harus sama dengan atau setelah tanggal mulai.',
            'return_date.required' => 'Tanggal kembali wajib diisi.',
            'return_date.date' => 'Format tanggal kembali tidak valid.',
            'return_date.after' => 'Tanggal kembali harus setelah tanggal akhir.',
        ];
    }
}