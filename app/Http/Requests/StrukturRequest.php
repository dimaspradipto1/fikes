<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StrukturRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'gambar' => [
                $this->isMethod('POST') ? 'required' : 'nullable',
                'image',
                'max:4096',
            ],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'gambar.required' => 'Gambar struktur organisasi wajib diunggah.',
            'gambar.image'    => 'File harus berupa gambar.',
            'gambar.max'      => 'Ukuran gambar maksimal 4 MB.',
        ];
    }
}
