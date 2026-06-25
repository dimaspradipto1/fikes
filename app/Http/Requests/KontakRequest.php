<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class KontakRequest extends FormRequest
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
            'no_telp'   => ['nullable', 'string', 'max:20'],
            'email'     => ['nullable', 'string', 'email', 'max:255'],
            'alamat'    => ['nullable', 'string'],
            'latitude'  => ['nullable', 'string', 'max:50'],
            'longitude' => ['nullable', 'string', 'max:50'],
            'map'       => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'no_telp.max'    => 'Nomor telepon maksimal 20 karakter.',
            'email.email'    => 'Format email tidak valid.',
            'email.max'      => 'Email maksimal 255 karakter.',
            'latitude.max'   => 'Latitude maksimal 50 karakter.',
            'longitude.max'  => 'Longitude maksimal 50 karakter.',
        ];
    }

    public function attributes(): array
    {
        return [
            'no_telp'   => 'Nomor Telepon',
            'email'     => 'Email',
            'alamat'    => 'Alamat',
            'latitude'  => 'Latitude',
            'longitude' => 'Longitude',
            'map'       => 'Embed Map',
        ];
    }
}
