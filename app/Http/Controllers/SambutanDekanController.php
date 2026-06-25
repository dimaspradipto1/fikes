<?php

namespace App\Http\Controllers;

use App\DataTables\SambutanDekanDataTable;
use App\Http\Requests\SambutanDekanRequest;
use App\Models\SambutanDekan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SambutanDekanController extends Controller
{
    /**
     * Tampilkan daftar sambutan dekan dengan DataTables.
     */
    public function index(SambutanDekanDataTable $dataTable)
    {
        return $dataTable->render('pages.sambutan-dekan.index');
    }

    /**
     * Tampilkan form tambah sambutan dekan.
     */
    public function create(): View
    {
        return view('pages.sambutan-dekan.create');
    }

    /**
     * Simpan sambutan dekan baru ke database.
     */
    public function store(SambutanDekanRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Handle upload foto
        if ($request->hasFile('photo')) {
            $data['url_photo'] = $request->file('photo')->store('sambutan-dekan', 'public');
        }

        unset($data['photo']);

        SambutanDekan::create($data);

        toast('Sambutan Dekan berhasil ditambahkan.', 'success');
        return redirect()->route('sambutan-dekan.index');
    }

    /**
     * Tampilkan form edit sambutan dekan.
     */
    public function edit(SambutanDekan $sambutanDekan): View
    {
        return view('pages.sambutan-dekan.edit', compact('sambutanDekan'));
    }

    /**
     * Simpan perubahan data sambutan dekan.
     */
    public function update(SambutanDekanRequest $request, SambutanDekan $sambutanDekan): RedirectResponse
    {
        $data = $request->validated();

        // Handle upload foto baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($sambutanDekan->url_photo) {
                Storage::disk('public')->delete($sambutanDekan->url_photo);
            }
            $data['url_photo'] = $request->file('photo')->store('sambutan-dekan', 'public');
        }

        unset($data['photo']);

        $sambutanDekan->update($data);

        toast('Sambutan Dekan berhasil diperbarui.', 'success');
        return redirect()->route('sambutan-dekan.index');
    }

    /**
     * Hapus sambutan dekan dari database.
     */
    public function destroy(SambutanDekan $sambutanDekan): RedirectResponse
    {
        // Hapus foto dari storage jika ada
        if ($sambutanDekan->url_photo) {
            Storage::disk('public')->delete($sambutanDekan->url_photo);
        }

        $sambutanDekan->delete();

        toast('Sambutan Dekan berhasil dihapus.', 'success');
        return redirect()->route('sambutan-dekan.index');
    }

    /**
     * Handle upload gambar dari TinyMCE editor.
     */
    public function uploadImage(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        ]);

        $path = $request->file('file')->store('sambutan-dekan/editor', 'public');

        return response()->json([
            'location' => Storage::disk('public')->url($path),
        ]);
    }
}
