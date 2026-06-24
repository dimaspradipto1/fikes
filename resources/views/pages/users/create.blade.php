@extends('layouts.dashboard.template')

@section('content')
<div class="pagetitle">
    <h1>Tambah Pengguna</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Pengguna</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-7 col-md-9">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-person-plus-fill me-2 text-primary"></i>Form Tambah Pengguna
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

                <form action="{{ route('user.store') }}" method="POST">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">
                            Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
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
                               value="{{ old('email') }}"
                               placeholder="contoh@email.com"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            Password <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Minimal 6 karakter"
                                   required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePw1">
                                <i class="bi bi-eye" id="eye1"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold">
                            Konfirmasi Password <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password"
                                   required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePw2">
                                <i class="bi bi-eye" id="eye2"></i>
                            </button>
                        </div>
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
                            <option value="" disabled {{ old('roles') ? '' : 'selected' }}>-- Pilih Hak Akses --</option>
                            <option value="administrator"  {{ old('roles') === 'administrator'  ? 'selected' : '' }}>Administrator</option>
                            <option value="editor"         {{ old('roles') === 'editor'         ? 'selected' : '' }}>Editor</option>
                            <option value="author"         {{ old('roles') === 'author'         ? 'selected' : '' }}>Author</option>
                            <option value="contributor"    {{ old('roles') === 'contributor'    ? 'selected' : '' }}>Contributor</option>
                            <option value="subscriber"     {{ old('roles') === 'subscriber'     ? 'selected' : '' }}>Subscriber</option>
                            <option value="customer"       {{ old('roles') === 'customer'       ? 'selected' : '' }}>Customer</option>
                            <option value="shop_manager"   {{ old('roles') === 'shop_manager'   ? 'selected' : '' }}>Shop Manager</option>
                            <option value="translator"     {{ old('roles') === 'translator'     ? 'selected' : '' }}>Translator</option>
                            <option value="seo_manager"    {{ old('roles') === 'seo_manager'    ? 'selected' : '' }}>SEO Manager</option>
                            <option value="seo_editor"     {{ old('roles') === 'seo_editor'     ? 'selected' : '' }}>SEO Editor</option>
                        </select>
                        @error('roles')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Pengguna
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
    // Toggle show/hide password
    function togglePassword(btnId, eyeId, inputId) {
        document.getElementById(btnId).addEventListener('click', function () {
            const inp = document.getElementById(inputId);
            const eye = document.getElementById(eyeId);
            const show = inp.type === 'password';
            inp.type = show ? 'text' : 'password';
            eye.className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    }
    togglePassword('togglePw1', 'eye1', 'password');
    togglePassword('togglePw2', 'eye2', 'password_confirmation');
</script>
@endpush
