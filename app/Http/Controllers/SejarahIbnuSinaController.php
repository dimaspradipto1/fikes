<?php

namespace App\Http\Controllers;

use App\DataTables\SejarahIbnusinaDataTable;
use App\Http\Requests\SejarahIbnuSinaRequest;
use App\Models\SejarahIbnuSina;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SejarahIbnuSinaController extends Controller
{
    /**
     * Tampilkan daftar sejarah Ibnu Sina dengan DataTables.
     */
    public function index(SejarahIbnusinaDataTable $dataTable)
    {
        return $dataTable->render('pages.sejarahibnusina.index');
    }

    /**
     * Tampilkan form tambah sejarah Ibnu Sina.
     */
    public function create(): View
    {
        return view('pages.sejarahibnusina.create');
    }

    /**
     * Simpan sejarah Ibnu Sina baru ke database.
     */
    public function store(SejarahIbnuSinaRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Handle upload foto
        if ($request->hasFile('photo')) {
            $data['url_photo'] = $request->file('photo')->store('sejarah-ibnu-sina', 'public');
        }

        unset($data['photo']);

        SejarahIbnuSina::create($data);

        toast('Sejarah Ibnu Sina berhasil ditambahkan.', 'success');
        return redirect()->route('sejarah-ibnu-sina.index');
    }

    /**
     * Tampilkan form edit sejarah Ibnu Sina.
     */
    public function edit(SejarahIbnuSina $sejarahIbnuSina): View
    {
        return view('pages.sejarahibnusina.edit', compact('sejarahIbnuSina'));
    }

    /**
     * Simpan perubahan data sejarah Ibnu Sina.
     */
    public function update(SejarahIbnuSinaRequest $request, SejarahIbnuSina $sejarahIbnuSina): RedirectResponse
    {
        $data = $request->validated();

        // Handle upload foto baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($sejarahIbnuSina->url_photo) {
                Storage::disk('public')->delete($sejarahIbnuSina->url_photo);
            }
            $data['url_photo'] = $request->file('photo')->store('sejarah-ibnu-sina', 'public');
        }

        unset($data['photo']);

        $sejarahIbnuSina->update($data);

        toast('Sejarah Ibnu Sina berhasil diperbarui.', 'success');
        return redirect()->route('sejarah-ibnu-sina.index');
    }

    /**
     * Hapus sejarah Ibnu Sina dari database.
     */
    public function destroy(SejarahIbnuSina $sejarahIbnuSina): RedirectResponse
    {
        // Hapus foto dari storage jika ada
        if ($sejarahIbnuSina->url_photo) {
            Storage::disk('public')->delete($sejarahIbnuSina->url_photo);
        }

        $sejarahIbnuSina->delete();

        toast('Sejarah Ibnu Sina berhasil dihapus.', 'success');
        return redirect()->route('sejarah-ibnu-sina.index');
    }

    /**
     * Handle upload gambar dari TinyMCE editor.
     */
    public function uploadImage(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        ]);

        $path = $request->file('file')->store('sejarah-ibnu-sina/editor', 'public');

        return response()->json([
            'location' => Storage::disk('public')->url($path),
        ]);
    }
}
