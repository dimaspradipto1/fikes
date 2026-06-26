@extends('layouts.dashboard.template')

@section('title', 'Edit Profil Pimpinan')

@section('content')
<div class="pagetitle">
    <h1>Edit Profil Pimpinan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profil-pimpinan.index') }}">Profil Pimpinan</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-7 col-md-9">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-pencil-square me-2 text-warning"></i>Form Edit Profil Pimpinan
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

                <form action="{{ route('profil-pimpinan.update', $profilPimpinan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Foto --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Foto Pimpinan</label>

                        <div class="d-flex align-items-center gap-3 mb-2">
                            {{-- Foto saat ini atau placeholder --}}
                            @if ($profilPimpinan->url_photo)
                                <img id="img-current"
                                     src="{{ Storage::disk('public')->url($profilPimpinan->url_photo) }}"
                                     alt="Foto {{ $profilPimpinan->nama }}"
                                     class="rounded-circle border shadow-sm flex-shrink-0"
                                     style="width:80px;height:80px;object-fit:cover;">
                            @else
                                <div id="avatar-placeholder"
                                     class="rounded-circle bg-secondary d-flex align-items-center justify-content-center flex-shrink-0"
                                     style="width:80px;height:80px;">
                                    <i class="bi bi-person-fill text-white" style="font-size:2.2rem;"></i>
                                </div>
                            @endif

                            {{-- Preview foto baru --}}
                            <img id="img-preview" src="" alt="Preview Baru"
                                 class="rounded-circle border border-success shadow-sm d-none flex-shrink-0"
                                 style="width:80px;height:80px;object-fit:cover;">

                            <div>
                                <input type="file"
                                       id="photo"
                                       name="photo"
                                       class="form-control @error('photo') is-invalid @enderror">
                                <div class="form-text">Unggah foto pimpinan. Maks. 2 MB. Kosongkan jika tidak ingin mengganti.</div>
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
                               value="{{ old('nama', $profilPimpinan->nama) }}"
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
                               value="{{ old('jabatan', $profilPimpinan->jabatan) }}"
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
    document.getElementById('photo').addEventListener('change', function () {
        const file    = this.files[0];
        const current = document.getElementById('img-current');
        const preview = document.getElementById('img-preview');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
            if (current) current.style.opacity = '0.4';
        } else {
            preview.classList.add('d-none');
            if (current) current.style.opacity = '1';
        }
    });
</script>
@endpush
