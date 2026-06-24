@extends('layouts.dashboard.template')

@section('title', 'Update Password Pengguna')

@section('content')
<div class="pagetitle">
    <h1>Update Password</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Pengguna</a></li>
            <li class="breadcrumb-item active">Update Password</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-6 col-md-8">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-key-fill me-2 text-info"></i>Update Password — {{ $user->name }}
                </h5>
            </div>
            <div class="card-body pt-4">

                {{-- Info user --}}
                <div class="alert alert-secondary d-flex align-items-center gap-2 py-2 mb-4">
                    <i class="bi bi-person-circle fs-5"></i>
                    <div>
                        <div class="fw-semibold">{{ $user->name }}</div>
                        <small class="text-muted">{{ $user->email }}</small>
                    </div>
                </div>

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

                <form action="{{ route('user.updatePassword', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Petunjuk --}}
                    <div class="alert alert-info d-flex align-items-start gap-2 py-2 mb-4" role="alert">
                        <i class="bi bi-info-circle-fill flex-shrink-0 mt-1"></i>
                        <span>
                            Kosongkan kolom di bawah jika tidak ingin mengubah password.
                            Password lama akan tetap digunakan.
                        </span>
                    </div>

                    {{-- Password Baru --}}
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            Password Baru
                            <span class="text-muted fw-normal">(kosongkan jika tidak diubah)</span>
                        </label>
                        <div class="input-group">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Minimal 6 karakter">
                            <button class="btn btn-outline-secondary" type="button" id="togglePw1">
                                <i class="bi bi-eye" id="eye1"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Konfirmasi Password Baru --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">
                            Konfirmasi Password Baru
                        </label>
                        <div class="input-group">
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password baru">
                            <button class="btn btn-outline-secondary" type="button" id="togglePw2">
                                <i class="bi bi-eye" id="eye2"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-info text-white">
                            <i class="bi bi-key me-1"></i> Simpan Password
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
