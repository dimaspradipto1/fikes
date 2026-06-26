<?php

namespace App\Http\Controllers;

use App\DataTables\StrukturDataTable;
use App\Http\Requests\StrukturRequest;
use App\Models\Struktur;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StrukturController extends Controller
{
    /**
     * Tampilkan daftar struktur organisasi dengan DataTables.
     */
    public function index(StrukturDataTable $dataTable)
    {
        return $dataTable->render('pages.struktur.index');
    }

    /**
     * Tampilkan form tambah struktur organisasi.
     */
    public function create(): View
    {
        return view('pages.struktur.create');
    }

    /**
     * Simpan struktur organisasi baru ke database.
     */
    public function store(StrukturRequest $request): RedirectResponse
    {
        $data = [];

        if ($request->hasFile('gambar')) {
            $data['url_struktur'] = $request->file('gambar')->store('struktur', 'public');
        }

        Struktur::create($data);

        toast('Struktur Organisasi berhasil ditambahkan.', 'success');
        return redirect()->route('struktur.index');
    }

    /**
     * Tampilkan form edit struktur organisasi.
     */
    public function edit(Struktur $struktur): View
    {
        return view('pages.struktur.edit', compact('struktur'));
    }

    /**
     * Simpan perubahan struktur organisasi.
     */
    public function update(StrukturRequest $request, Struktur $struktur): RedirectResponse
    {
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($struktur->url_struktur) {
                Storage::disk('public')->delete($struktur->url_struktur);
            }
            $struktur->url_struktur = $request->file('gambar')->store('struktur', 'public');
            $struktur->save();
        }

        toast('Struktur Organisasi berhasil diperbarui.', 'success');
        return redirect()->route('struktur.index');
    }

    /**
     * Hapus struktur organisasi dari database.
     */
    public function destroy(Struktur $struktur): RedirectResponse
    {
        // Hapus gambar dari storage jika ada
        if ($struktur->url_struktur) {
            Storage::disk('public')->delete($struktur->url_struktur);
        }

        $struktur->delete();

        toast('Struktur Organisasi berhasil dihapus.', 'success');
        return redirect()->route('struktur.index');
    }
}
