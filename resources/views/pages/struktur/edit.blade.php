@extends('layouts.dashboard.template')

@section('title', 'Edit Struktur Organisasi')

@section('content')
<div class="pagetitle">
    <h1>Edit Struktur Organisasi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('struktur.index') }}">Struktur Organisasi</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-pencil-square me-2 text-warning"></i>Form Edit Struktur Organisasi
                </h5>
            </div>
            <div class="card-body pt-4">

                {{-- Error Summary --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Periksa kembali data Anda:</strong>
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('struktur.update', $struktur->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Gambar Saat Ini --}}
                    @if ($struktur->url_struktur)
                        <div class="mb-3">
                            <p class="form-label fw-semibold mb-2">
                                <i class="bi bi-image me-1 text-secondary"></i>Gambar Saat Ini
                            </p>
                            <img id="img-current"
                                 src="{{ Storage::disk('public')->url($struktur->url_struktur) }}"
                                 alt="Struktur Saat Ini"
                                 class="img-fluid rounded border shadow-sm"
                                 style="max-height:350px; object-fit:contain;">
                        </div>
                    @endif

                    {{-- Upload Gambar Baru --}}
                    <div class="mb-4">
                        <label for="gambar" class="form-label fw-semibold">
                            Ganti Gambar Struktur Organisasi
                        </label>
                        <input type="file"
                               id="gambar"
                               name="gambar"
                               class="form-control @error('gambar') is-invalid @enderror">
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Unggah gambar struktur organisasi. Maks. 4 MB.
                            Kosongkan jika tidak ingin mengganti gambar.
                        </div>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- Preview gambar baru --}}
                        <div id="preview-wrap" class="mt-3 d-none">
                            <p class="text-success small mb-1">
                                <i class="bi bi-check-circle me-1"></i>Preview gambar baru:
                            </p>
                            <img id="img-preview" src="" alt="Preview Gambar Baru"
                                 class="img-fluid rounded border shadow-sm"
                                 style="max-height:350px; object-fit:contain;">
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('struktur.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('gambar').addEventListener('change', function () {
        const file    = this.files[0];
        const wrap    = document.getElementById('preview-wrap');
        const img     = document.getElementById('img-preview');
        const current = document.getElementById('img-current');
        if (file) {
            img.src = URL.createObjectURL(file);
            wrap.classList.remove('d-none');
            if (current) current.style.opacity = '0.4';
        } else {
            wrap.classList.add('d-none');
            if (current) current.style.opacity = '1';
        }
    });
</script>
@endpush
