<?php

namespace App\Http\Controllers;

use App\DataTables\VisiMisiDataTable;
use App\Http\Requests\VisiMisiRequest;
use App\Models\VisiMisi;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VisiMisiController extends Controller
{
    /**
     * Tampilkan daftar visi misi dengan DataTables.
     */
    public function index(VisiMisiDataTable $dataTable)
    {
        return $dataTable->render('pages.visimisi.index');
    }

    /**
     * Tampilkan form tambah visi misi.
     */
    public function create(): View
    {
        return view('pages.visimisi.create');
    }

    /**
     * Simpan visi misi baru ke database.
     */
    public function store(VisiMisiRequest $request): RedirectResponse
    {
        VisiMisi::create($request->validated());

        toast('Visi Misi berhasil ditambahkan.', 'success');
        return redirect()->route('visi-misi.index');
    }

    /**
     * Tampilkan form edit visi misi.
     */
    public function edit(VisiMisi $visiMisi): View
    {
        return view('pages.visimisi.edit', compact('visiMisi'));
    }

    /**
     * Simpan perubahan data visi misi.
     */
    public function update(VisiMisiRequest $request, VisiMisi $visiMisi): RedirectResponse
    {
        $visiMisi->update($request->validated());

        toast('Visi Misi berhasil diperbarui.', 'success');
        return redirect()->route('visi-misi.index');
    }

    /**
     * Hapus visi misi dari database.
     */
    public function destroy(VisiMisi $visiMisi): RedirectResponse
    {
        $visiMisi->delete();

        toast('Visi Misi berhasil dihapus.', 'success');
        return redirect()->route('visi-misi.index');
    }
}
