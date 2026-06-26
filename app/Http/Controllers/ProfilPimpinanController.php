<?php

namespace App\Http\Controllers;

use App\DataTables\ProfilPimpinanDataTable;
use App\Http\Requests\ProfilePimpinanRequest;
use App\Models\ProfilPimpinan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfilPimpinanController extends Controller
{
    /**
     * Tampilkan daftar profil pimpinan dengan DataTables.
     */
    public function index(ProfilPimpinanDataTable $dataTable)
    {
        return $dataTable->render('pages.profilpimpinan.index');
    }

    /**
     * Tampilkan form tambah profil pimpinan.
     */
    public function create(): View
    {
        return view('pages.profilpimpinan.create');
    }

    /**
     * Simpan profil pimpinan baru ke database.
     */
    public function store(ProfilePimpinanRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Handle upload foto
        if ($request->hasFile('photo')) {
            $data['url_photo'] = $request->file('photo')->store('profil-pimpinan', 'public');
        }

        unset($data['photo']);

        ProfilPimpinan::create($data);

        toast('Profil Pimpinan berhasil ditambahkan.', 'success');
        return redirect()->route('profil-pimpinan.index');
    }

    /**
     * Tampilkan form edit profil pimpinan.
     */
    public function edit(ProfilPimpinan $profilPimpinan): View
    {
        return view('pages.profilpimpinan.edit', compact('profilPimpinan'));
    }

    /**
     * Simpan perubahan profil pimpinan.
     */
    public function update(ProfilePimpinanRequest $request, ProfilPimpinan $profilPimpinan): RedirectResponse
    {
        $data = $request->validated();

        // Handle upload foto baru
        if ($request->hasFile('photo')) {
            if ($profilPimpinan->url_photo) {
                Storage::disk('public')->delete($profilPimpinan->url_photo);
            }
            $data['url_photo'] = $request->file('photo')->store('profil-pimpinan', 'public');
        }

        unset($data['photo']);

        $profilPimpinan->update($data);

        toast('Profil Pimpinan berhasil diperbarui.', 'success');
        return redirect()->route('profil-pimpinan.index');
    }

    /**
     * Hapus profil pimpinan dari database.
     */
    public function destroy(ProfilPimpinan $profilPimpinan): RedirectResponse
    {
        if ($profilPimpinan->url_photo) {
            Storage::disk('public')->delete($profilPimpinan->url_photo);
        }

        $profilPimpinan->delete();

        toast('Profil Pimpinan berhasil dihapus.', 'success');
        return redirect()->route('profil-pimpinan.index');
    }
}
