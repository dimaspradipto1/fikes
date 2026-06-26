@extends('layouts.dashboard.template')

@section('title', 'Visi Misi')

@section('content')
<div class="pagetitle">
    <h1>Visi Misi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Visi Misi</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm">
    <div class="card-header d-flex align-items-center justify-content-between py-3">
        <h5 class="mb-0 fw-semibold">
            <i class="bi bi-bullseye me-2 text-primary"></i>Daftar Visi Misi
        </h5>
        <a href="{{ route('visi-misi.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Visi Misi
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
