<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SejarahIbnuSinaRequest extends FormRequest
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
            'photo'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'url_video' => ['nullable', 'url', 'max:255'],
            'deskripsi' => ['required', 'string'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'photo.image'      => 'File harus berupa gambar.',
            'photo.mimes'      => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'photo.max'        => 'Ukuran foto maksimal 2 MB.',
            'url_video.url'    => 'URL video tidak valid.',
            'deskripsi.required' => 'Kolom Deskripsi wajib diisi.',
        ];
    }
}
