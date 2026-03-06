@extends('layouts.dashboard')

<<<<<<< HEAD
@section('page-title', 'Detail Jenis Ruangan')
@section('title', 'Detail Jenis Ruangan')

=======
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
@section('content')
<div class="container">
    <h2>Detail Jenis Ruangan</h2>

<<<<<<< HEAD
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
=======
    <ul class="list-group">
        <li class="list-group-item">
            <b>Kode:</b> {{ $jenis_ruangan->kode_jenis_ruangan }}
        </li>
        <li class="list-group-item">
            <b>Nama:</b> {{ $jenis_ruangan->nama_jenis_ruangan }}
        </li>
        <li class="list-group-item">
            <b>Status:</b>

            @if($jenis_ruangan->is_active)
                <span class="badge bg-success ms-2">
                    <i class="fa-solid fa-circle-check me-1"></i> Aktif
                </span>
            @else
                <span class="badge bg-danger ms-2">
                    <i class="fa-solid fa-circle-xmark me-1"></i> Nonaktif
                </span>
            @endif
        </li>
    </ul>
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44

    <a href="{{ route('jenis-ruangan.index') }}" class="btn btn-secondary mt-3">
        <i class="fa-solid fa-arrow-left me-1"></i>Kembali
    </a>
</div>
@endsection