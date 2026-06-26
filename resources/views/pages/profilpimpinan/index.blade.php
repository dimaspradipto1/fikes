@extends('layouts.dashboard.template')

@section('title', 'Profil Pimpinan')

@section('content')
<div class="pagetitle">
    <h1>Profil Pimpinan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Profil Pimpinan</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm">
    <div class="card-header d-flex align-items-center justify-content-between py-3">
        <h5 class="mb-0 fw-semibold">
            <i class="bi bi-person-badge me-2 text-primary"></i>Daftar Profil Pimpinan
        </h5>
        <a href="{{ route('profil-pimpinan.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Pimpinan
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {{ $dataTable->table([
                'class' => 'table table-striped table-bordered align-middle',
                'style' => 'width:100%',
            ]) }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @if(app()->environment('production'))
        {!! str_replace('http:', 'https:', $dataTable->scripts()) !!}
    @else
        {!! $dataTable->scripts() !!}
    @endif
@endpush
