@extends('layouts.dashboard')

@section('content')
<div class="container">

<<<<<<< HEAD
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detail Gedung</h2>

        <a href="{{ route('gedung.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

=======
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
    <ul class="list-group">
        <li class="list-group-item">
            <b>Kode:</b> {{ $gedung->kode_gedung }}
        </li>

        <li class="list-group-item">
            <b>Nama:</b> {{ $gedung->nama_gedung }}
        </li>

        <li class="list-group-item">
            <b>Status:</b>
            @if($gedung->is_active)
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

</div>
@endsection