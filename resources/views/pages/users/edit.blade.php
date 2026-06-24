@extends('layouts.dashboard.template')

@section('title', 'Edit Pengguna')

@section('content')
<div class="pagetitle">
    <h1>Edit Pengguna</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Pengguna</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-7 col-md-9">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-pencil-square me-2 text-warning"></i>Form Edit Pengguna
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

                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">
                            Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}"
                               placeholder="Masukkan nama lengkap"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            Email <span class="text-danger">*</span>
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}"
                               placeholder="contoh@email.com"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Hak Akses --}}
                    <div class="mb-4">
                        <label for="roles" class="form-label fw-semibold">
                            Hak Akses <span class="text-danger">*</span>
                        </label>
                        <select id="roles"
                                name="roles"
                                class="form-select @error('roles') is-invalid @enderror"
                                required>
                            <option value="" disabled>-- Pilih Hak Akses --</option>
                            <option value="administrator"  {{ old('roles', $user->roles) === 'administrator'  ? 'selected' : '' }}>Administrator</option>
                            <option value="editor"         {{ old('roles', $user->roles) === 'editor'         ? 'selected' : '' }}>Editor</option>
                            <option value="author"         {{ old('roles', $user->roles) === 'author'         ? 'selected' : '' }}>Author</option>
                            <option value="contributor"    {{ old('roles', $user->roles) === 'contributor'    ? 'selected' : '' }}>Contributor</option>
                            <option value="subscriber"     {{ old('roles', $user->roles) === 'subscriber'     ? 'selected' : '' }}>Subscriber</option>
                            <option value="customer"       {{ old('roles', $user->roles) === 'customer'       ? 'selected' : '' }}>Customer</option>
                            <option value="shop_manager"   {{ old('roles', $user->roles) === 'shop_manager'   ? 'selected' : '' }}>Shop Manager</option>
                            <option value="translator"     {{ old('roles', $user->roles) === 'translator'     ? 'selected' : '' }}>Translator</option>
                            <option value="seo_manager"    {{ old('roles', $user->roles) === 'seo_manager'    ? 'selected' : '' }}>SEO Manager</option>
                            <option value="seo_editor"     {{ old('roles', $user->roles) === 'seo_editor'     ? 'selected' : '' }}>SEO Editor</option>
                        </select>
                        @error('roles')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Info: ubah password di halaman terpisah --}}
                    <div class="alert alert-info d-flex align-items-center gap-2 py-2 mb-4" role="alert">
                        <i class="bi bi-info-circle-fill flex-shrink-0"></i>
                        <span>
                            Untuk mengubah password, gunakan tombol
                            <a href="{{ route('user.updatePasswordForm', $user->id) }}" class="alert-link fw-semibold">Update Password</a>.
                        </span>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
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
