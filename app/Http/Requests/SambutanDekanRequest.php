<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SambutanDekanRequest extends FormRequest
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
            'deskripsi' => ['required', 'string'],
            'photo'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],
            'url_video' => ['nullable', 'string', 'url', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'deskripsi.required' => 'Deskripsi sambutan wajib diisi.',
            'photo.image'        => 'File foto harus berupa gambar.',
            'photo.mimes'        => 'Format foto harus jpg, jpeg, png, atau webp.',
            'url_video.url'      => 'URL video harus berupa URL yang valid.',
            'url_video.max'      => 'URL video maksimal 1000 karakter.',
        ];
    }

    public function attributes(): array
    {
        return [
            'deskripsi' => 'Deskripsi',
            'photo'     => 'Foto Dekan',
            'url_video' => 'URL Video',
        ];
    }
}
