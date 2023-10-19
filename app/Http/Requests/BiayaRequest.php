<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BiayaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id_angkatans' => 'required',
            'id_kelas' => 'required',
            'id_jurusans' => 'required',
            'nama_biaya' => 'required|max:2',
            'jenis_biaya' => 'required|in:routine,tidakRoutine',
        ];
    }
}
