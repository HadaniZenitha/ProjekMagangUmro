@extends('layouts.dashboard')

@section('title', 'Detail Ruang')
@section('page-title', 'Detail Ruang')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <h5 class="mb-3">{{ $ruang->nama_ruang }}</h5>

        <p>
            <b>Kode Ruang :</b> {{ $ruang->kode_ruang }}
        </p>

        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('ruangs.index') }}" 
               class="btn btn-warning shadow-sm text-dark">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

    </div>
</div>

@endsection