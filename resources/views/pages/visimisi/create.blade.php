@extends('layouts.dashboard.template')

@section('title', 'Tambah Visi Misi')

@section('content')
<div class="pagetitle">
    <h1>Tambah Visi Misi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('visi-misi.index') }}">Visi Misi</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-10 col-md-12">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-plus-circle-fill me-2 text-primary"></i>Form Tambah Visi Misi
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

                <form action="{{ route('visi-misi.store') }}" method="POST">
                    @csrf

                    {{-- Visi --}}
                    <div class="mb-4">
                        <label for="visi" class="form-label fw-semibold">
                            <i class="bi bi-eye me-1 text-primary"></i>Visi <span class="text-danger">*</span>
                        </label>
                        @error('visi')
                            <div class="text-danger small mb-1">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                        <textarea id="visi"
                                  name="visi"
                                  class="@error('visi') is-invalid @enderror">{{ old('visi') }}</textarea>
                    </div>

                    <hr class="my-4">

                    {{-- Misi --}}
                    <div class="mb-4">
                        <label for="misi" class="form-label fw-semibold">
                            <i class="bi bi-list-check me-1 text-primary"></i>Misi
                        </label>
                        <div class="form-text mb-2">
                            <i class="bi bi-info-circle me-1"></i>
                            Gunakan <strong>Bulleted List</strong> atau <strong>Numbered List</strong> di toolbar untuk menambahkan poin-poin misi.
                        </div>
                        @error('misi')
                            <div class="text-danger small mb-1">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                        <textarea id="misi"
                                  name="misi"
                                  class="@error('misi') is-invalid @enderror">{{ old('misi') }}</textarea>
                    </div>

                    <hr class="my-4">

                    {{-- Tujuan --}}
                    <div class="mb-4">
                        <label for="tujuan" class="form-label fw-semibold">
                            <i class="bi bi-trophy me-1 text-warning"></i>Tujuan
                        </label>
                        <div class="form-text mb-2">
                            <i class="bi bi-info-circle me-1"></i>
                            Gunakan <strong>Bulleted List</strong> atau <strong>Numbered List</strong> di toolbar untuk menambahkan poin-poin tujuan.
                        </div>
                        @error('tujuan')
                            <div class="text-danger small mb-1">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                        <textarea id="tujuan"
                                  name="tujuan"
                                  class="@error('tujuan') is-invalid @enderror">{{ old('tujuan') }}</textarea>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('visi-misi.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Visi Misi
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
    const tinyMceConfig = (selector) => ({
        selector: selector,
        language: 'id',
        height: 300,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'charmap',
            'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'help', 'wordcount'
        ],
        toolbar:
            'undo redo | blocks | bold italic underline | ' +
            'forecolor | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | removeformat | fullscreen | help',
        content_style: 'body { font-family: "Open Sans", sans-serif; font-size: 15px; line-height: 1.8; } ul, ol { padding-left: 1.5rem; }',
        branding: false,
        promotion: false,
    });

    tinymce.init(tinyMceConfig('#visi'));
    tinymce.init(tinyMceConfig('#misi'));
    tinymce.init(tinyMceConfig('#tujuan'));
</script>
@endpush
