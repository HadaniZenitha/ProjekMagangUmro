@extends('layouts.dashboard')

@section('title', 'Detail Gedung')
@section('page-title', 'Detail Gedung')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <b>Kode Gedung:</b> {{ $gedung->kode_gedung }}
            </li>

            <li class="list-group-item">
                <b>Nama Gedung:</b> {{ $gedung->nama_gedung }}
            </li>

            <li class="list-group-item">
                <b>Status:</b>
                @if($gedung->is_active)
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Nonaktif</span>
                @endif
            </li>
        </ul>

        <div class="mt-3">
            <a href="{{ route('gedung.index') }}" 
               class="btn btn-warning shadow-sm text-white">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

    </div>
</div>

@endsection