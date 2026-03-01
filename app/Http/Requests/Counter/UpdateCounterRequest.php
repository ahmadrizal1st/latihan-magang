<?php

namespace App\Http\Requests\Counter;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCounterRequest extends FormRequest
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
        $counterId = $this->route('counter');

        return [
            'code'        => "required|string|max:255|unique:counters,code,{$counterId}",
            'description' => 'nullable|string|max:255',
            'counter'     => 'required|integer|min:0',
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
            'code.required'    => 'Kode wajib diisi.',
            'code.unique'      => 'Kode sudah terdaftar.',
            'code.max'         => 'Kode maksimal 255 karakter.',

            'description.max'  => 'Deskripsi maksimal 255 karakter.',

            'counter.required' => 'Counter wajib diisi.',
            'counter.integer'  => 'Counter harus berupa angka.',
            'counter.min'      => 'Counter tidak boleh kurang dari 0.',
        ];
    }
}