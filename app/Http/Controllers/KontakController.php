<?php

namespace App\Http\Controllers;

use App\DataTables\KontakDataTable;
use App\Http\Requests\KontakRequest;
use App\Models\Kontak;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KontakController extends Controller
{
    /**
     * Tampilkan daftar kontak dengan DataTables.
     */
    public function index(KontakDataTable $dataTable)
    {
        return $dataTable->render('pages.kontak.index');
    }

    /**
     * Tampilkan form tambah kontak.
     */
    public function create(): View
    {
        return view('pages.kontak.create');
    }

    /**
     * Simpan kontak baru ke database.
     */
    public function store(KontakRequest $request): RedirectResponse
    {
        Kontak::create($request->validated());

        toast('Data kontak berhasil ditambahkan.', 'success');
        return redirect()->route('kontak.index');
    }

    /**
     * Tampilkan form edit kontak.
     */
    public function edit(Kontak $kontak): View
    {
        return view('pages.kontak.edit', compact('kontak'));
    }

    /**
     * Simpan perubahan data kontak.
     */
    public function update(KontakRequest $request, Kontak $kontak): RedirectResponse
    {
        $kontak->update($request->validated());

        toast('Data kontak berhasil diperbarui.', 'success');
        return redirect()->route('kontak.index');
    }

    /**
     * Hapus kontak dari database.
     */
    public function destroy(Kontak $kontak): RedirectResponse
    {
        $kontak->delete();

        toast('Data kontak berhasil dihapus.', 'success');
        return redirect()->route('kontak.index');
    }
}
