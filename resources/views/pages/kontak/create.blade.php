@extends('layouts.dashboard.template')

@section('title', 'Tambah Kontak')

@section('content')
<div class="pagetitle">
    <h1>Tambah Kontak</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('kontak.index') }}">Kontak</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-telephone-plus-fill me-2 text-primary"></i>Form Tambah Kontak
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

                <form action="{{ route('kontak.store') }}" method="POST">
                    @csrf

                    {{-- No. Telepon --}}
                    <div class="mb-3">
                        <label for="no_telp" class="form-label fw-semibold">
                            No. Telepon
                        </label>
                        <input type="text"
                               id="no_telp"
                               name="no_telp"
                               class="form-control @error('no_telp') is-invalid @enderror"
                               value="{{ old('no_telp') }}"
                               placeholder="Contoh: +62 811-2345-6789">
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            Email
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               placeholder="contoh@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">
                            Alamat
                        </label>
                        <textarea id="alamat"
                                  name="alamat"
                                  class="form-control @error('alamat') is-invalid @enderror"
                                  rows="3"
                                  placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        {{-- Latitude --}}
                        <div class="col-md-6 mb-3">
                            <label for="latitude" class="form-label fw-semibold">
                                Latitude
                            </label>
                            <input type="text"
                                   id="latitude"
                                   name="latitude"
                                   class="form-control @error('latitude') is-invalid @enderror"
                                   value="{{ old('latitude') }}"
                                   placeholder="Contoh: -6.2088">
                            @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Longitude --}}
                        <div class="col-md-6 mb-3">
                            <label for="longitude" class="form-label fw-semibold">
                                Longitude
                            </label>
                            <input type="text"
                                   id="longitude"
                                   name="longitude"
                                   class="form-control @error('longitude') is-invalid @enderror"
                                   value="{{ old('longitude') }}"
                                   placeholder="Contoh: 106.8456">
                            @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Embed Map --}}
                    <div class="mb-4">
                        <label for="map" class="form-label fw-semibold">
                            Embed Map (iframe Google Maps)
                        </label>
                        <textarea id="map"
                                  name="map"
                                  class="form-control @error('map') is-invalid @enderror"
                                  rows="4"
                                  placeholder='<iframe src="https://maps.google.com/..." ...></iframe>'>{{ old('map') }}</textarea>
                        <div class="form-text">Tempel kode embed iframe dari Google Maps.</div>
                        @error('map')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('kontak.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Kontak
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
