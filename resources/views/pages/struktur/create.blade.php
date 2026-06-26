@extends('layouts.dashboard.template')

@section('title', 'Tambah Struktur Organisasi')

@section('content')
<div class="pagetitle">
    <h1>Tambah Struktur Organisasi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('struktur.index') }}">Struktur Organisasi</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-diagram-3-fill me-2 text-primary"></i>Form Tambah Struktur Organisasi
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

                <form action="{{ route('struktur.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Upload Gambar Struktur --}}
                    <div class="mb-4">
                        <label for="gambar" class="form-label fw-semibold">
                            Gambar Struktur Organisasi <span class="text-danger">*</span>
                        </label>
                        <input type="file"
                               id="gambar"
                               name="gambar"
                               class="form-control @error('gambar') is-invalid @enderror">
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Unggah gambar struktur organisasi. Maks. 4 MB.
                        </div>
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- Preview gambar --}}
                        <div id="preview-wrap" class="mt-3 d-none">
                            <p class="text-muted small mb-1"><i class="bi bi-eye me-1"></i>Preview gambar:</p>
                            <img id="img-preview" src="" alt="Preview Struktur"
                                 class="img-fluid rounded border shadow-sm"
                                 style="max-height:400px; object-fit:contain;">
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('struktur.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Struktur
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
        const file = this.files[0];
        const wrap  = document.getElementById('preview-wrap');
        const img   = document.getElementById('img-preview');
        if (file) {
            img.src = URL.createObjectURL(file);
            wrap.classList.remove('d-none');
        } else {
            wrap.classList.add('d-none');
        }
    });
</script>
@endpush
