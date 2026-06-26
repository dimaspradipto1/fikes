@extends('layouts.dashboard.template')

@section('title', 'Tambah Profil Pimpinan')

@section('content')
<div class="pagetitle">
    <h1>Tambah Profil Pimpinan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profil-pimpinan.index') }}">Profil Pimpinan</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-7 col-md-9">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-person-plus-fill me-2 text-primary"></i>Form Tambah Profil Pimpinan
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

                <form action="{{ route('profil-pimpinan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Foto --}}
                    <div class="mb-3">
                        <label for="photo" class="form-label fw-semibold">Foto Pimpinan</label>

                        {{-- Avatar preview placeholder --}}
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div id="avatar-placeholder"
                                 class="rounded-circle bg-secondary d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:80px;height:80px;">
                                <i class="bi bi-person-fill text-white" style="font-size:2.2rem;"></i>
                            </div>
                            <img id="img-preview" src="" alt="Preview"
                                 class="rounded-circle border shadow-sm d-none flex-shrink-0"
                                 style="width:80px;height:80px;object-fit:cover;">
                            <div>
                                <input type="file"
                                       id="photo"
                                       name="photo"
                                       class="form-control @error('photo') is-invalid @enderror">
                                <div class="form-text">Unggah foto pimpinan. Maks. 2 MB.</div>
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">
                            Nama <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               id="nama"
                               name="nama"
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}"
                               placeholder="Masukkan nama lengkap pimpinan">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jabatan --}}
                    <div class="mb-4">
                        <label for="jabatan" class="form-label fw-semibold">
                            Jabatan <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               id="jabatan"
                               name="jabatan"
                               class="form-control @error('jabatan') is-invalid @enderror"
                               value="{{ old('jabatan') }}"
                               placeholder="Contoh: Dekan, Wakil Dekan I, ...">
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('profil-pimpinan.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Pimpinan
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
    document.getElementById('photo').addEventListener('change', function () {
        const file        = this.files[0];
        const placeholder = document.getElementById('avatar-placeholder');
        const preview     = document.getElementById('img-preview');
        if (file) {
            preview.src = URL.createObjectURL(file);
            placeholder.classList.add('d-none');
            preview.classList.remove('d-none');
        } else {
            placeholder.classList.remove('d-none');
            preview.classList.add('d-none');
        }
    });
</script>
@endpush
