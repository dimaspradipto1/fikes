<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Tampilkan daftar pengguna dengan DataTables.
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('pages.users.index');
    }

    /**
     * Tampilkan form tambah pengguna.
     */
    public function create(): View
    {
        return view('pages.users.create');
    }

    /**
     * Simpan pengguna baru ke database.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        User::create([
            'name'     => $request->validated('name'),
            'email'    => $request->validated('email'),
            'password' => $request->validated('password'), // auto-hash via cast
            'roles'    => $request->validated('roles'),
        ]);

        toast('Pengguna berhasil ditambahkan.', 'success');
        return redirect()->route('user.index');
    }

    /**
     * Tampilkan detail pengguna.
     */
    public function show(User $user): View
    {
        return view('pages.users.show', compact('user'));
    }

    /**
     * Tampilkan form edit pengguna.
     */
    public function edit(User $user): View
    {
        return view('pages.users.edit', compact('user'));
    }

    /**
     * Simpan perubahan data pengguna (tanpa password).
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->update([
            'name'  => $request->validated('name'),
            'email' => $request->validated('email'),
            'roles' => $request->validated('roles'),
        ]);

        toast('Data pengguna berhasil diperbarui.', 'success');
        return redirect()->route('user.index');
    }

    /**
     * Hapus pengguna dari database.
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->user()?->id) {
            toast('Anda tidak dapat menghapus akun Anda sendiri.', 'error');
            return redirect()->route('user.index');
        }

        $user->delete();

        toast('Pengguna berhasil dihapus.', 'success');
        return redirect()->route('user.index');
    }

    /**
     * Tampilkan form update password.
     */
    public function updatePasswordForm(User $user): View
    {
        return view('pages.users.update-password', compact('user'));
    }

    /**
     * Proses update password.
     * Jika password diisi → pakai password baru.
     * Jika password kosong → tetap pakai password lama.
     */
    public function updatePassword(UserRequest $request, User $user): RedirectResponse
    {
        $newPassword = $request->validated('password');

        if (!empty($newPassword)) {
            $user->password = $newPassword;
            $user->save();
            toast('Password pengguna berhasil diperbarui.', 'success');
        } else {
            toast('Password tidak diubah karena kolom dikosongkan.', 'info');
        }

        return redirect()->route('user.index');
    }
}
