<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
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
            'namamhs' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255'],
            'jurusan' => ['required'],
            'password' => 'required|min:8',
            // 'univ' => ['required'],
            'emailmhs' => 'required|email:rfc,dns',
        ];
    }
}
