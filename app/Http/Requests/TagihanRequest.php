<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagihanRequest extends FormRequest
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
            'id_biayas' => 'exists:biayas,id',
            'start_date.*' => 'nullable',
            'end_date.*' => 'nullable',
            'mounth.*' => 'nullable',
            'amount.*' => 'required|numeric|min_digits:4',
            'status' => 'nullable',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'amount' => str_replace('.', '', $this->amount),
        ]);
    }
}
