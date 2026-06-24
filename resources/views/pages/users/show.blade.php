@extends('layouts.dashboard.template')

@section('title', 'Detail Pengguna')

@section('content')
<div class="pagetitle">
    <h1>Detail Pengguna</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Pengguna</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-6 col-md-8">
        <div class="card shadow-sm">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-person-badge me-2 text-primary"></i>Informasi Pengguna
                </h5>
                <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <div class="card-body pt-4">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th width="35%" class="text-muted fw-normal">Nama</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">Hak Akses</th>
                            <td>
                                @php
                                    $badgeClass = match($user->roles) {
                                        'superadmin' => 'bg-danger',
                                        'admin'      => 'bg-primary',
                                        'pimpinan'   => 'bg-success',
                                        'user'       => 'bg-info text-dark',
                                        default      => 'bg-secondary',
                                    };
                                @endphp
                                <span class="badge rounded-pill {{ $badgeClass }}">{{ ucfirst($user->roles) }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">Dibuat</th>
                            <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm text-white">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </a>
                    <a href="{{ route('user.updatePasswordForm', $user->id) }}" class="btn btn-info btn-sm text-white">
                        <i class="bi bi-key me-1"></i> Update Password
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
