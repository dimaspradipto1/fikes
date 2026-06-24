<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules dinamis berdasarkan HTTP method & route.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $roles = 'in:administrator,editor,author,contributor,subscriber,customer,shop_manager,translator,seo_manager,seo_editor';

        // ── Update Password ───────────────────────────────────────────
        if ($this->routeIs('user.updatePassword')) {
            return [
                'password'              => ['nullable', 'string', 'min:6', 'confirmed'],
                'password_confirmation' => ['nullable', 'string'],
            ];
        }

        // ── Update (Edit) ─────────────────────────────────────────────
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $userId = $this->route('user');

            return [
                'name'  => ['required', 'string', 'max:255'],
                'email' => [
                    'required', 'string', 'email', 'max:255',
                    Rule::unique('users', 'email')->ignore($userId),
                ],
                'roles' => ['required', $roles],
            ];
        }

        // ── Store (Create) ────────────────────────────────────────────
        return [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'              => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
            'roles'                 => ['required', $roles],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'Nama lengkap wajib diisi.',
            'name.max'           => 'Nama maksimal 255 karakter.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah digunakan oleh pengguna lain.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'roles.required'     => 'Hak akses wajib dipilih.',
            'roles.in'           => 'Hak akses tidak valid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'     => 'Nama Lengkap',
            'email'    => 'Email',
            'password' => 'Password',
            'roles'    => 'Hak Akses',
        ];
    }
}
