@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Detail Divisi</h2>
        <a href="{{ route('divisi.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <ul class="list-group shadow-sm">
        <li class="list-group-item">
            <b>Kode:</b> {{ $divisi->kode_divisi }}
        </li>

        <li class="list-group-item">
            <b>Nama:</b> {{ $divisi->nama_divisi }}
        </li>

        <li class="list-group-item d-flex align-items-center">
            <b>Status:</b>
            @if($divisi->is_active)
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
<<<<<<< HEAD
=======

    <a href="{{ route('divisi.index') }}" class="btn btn-secondary mt-3">
        <i class="fa-solid fa-arrow-left me-1"></i>Kembali
    </a>
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
</div>
@endsection