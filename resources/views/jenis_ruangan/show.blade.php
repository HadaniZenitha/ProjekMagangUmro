@extends('layouts.dashboard')

@section('page-title', 'Detail Jenis Ruangan')
@section('title', 'Detail Jenis Ruangan')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <b>Kode:</b> {{ $jenis_ruangan->kode_jenis_ruangan }}
            </li>
            <li class="list-group-item">
                <b>Nama:</b> {{ $jenis_ruangan->nama_jenis_ruangan }}
            </li>
            <li class="list-group-item">
                <b>Status:</b>
                @if($jenis_ruangan->is_active)
                    <span class="badge bg-success">
                        <i class="fa-solid fa-circle-check me-1"></i> Aktif
                    </span>
                @else
                    <span class="badge bg-danger">
                        <i class="fa-solid fa-circle-xmark me-1"></i> Nonaktif
                    </span>
                @endif
            </li>
        </ul>

        <div class="mt-3">
            <a href="{{ route('jenis-ruangan.index') }}" 
               class="btn btn-warning shadow-sm text-dark">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

    </div>
</div>

@endsection