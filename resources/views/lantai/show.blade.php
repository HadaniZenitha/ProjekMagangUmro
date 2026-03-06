@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Detail Lantai</h2>

<<<<<<< HEAD
<div class="card shadow-sm">
    <ul class="list-group list-group-flush">

        <li class="list-group-item">
            <b>Gedung:</b> {{ $lantai->gedung->nama_gedung }}
        </li>

        <li class="list-group-item">
            <b>Kode Lantai:</b> {{ $lantai->kode_lantai }}
        </li>

        <li class="list-group-item">
            <b>Nama Lantai:</b> {{ $lantai->nama_lantai ?? '-' }}
        </li>

        <li class="list-group-item">
            <b>Status:</b>
            @if($lantai->is_active)
                <span class="badge bg-success">Aktif</span>
            @else
                <span class="badge bg-danger">Nonaktif</span>
            @endif
        </li>

    </ul>
</div>

<div class="mt-3">
    <a href="{{ route('lantai.index') }}" 
       class="btn btn-warning shadow-sm text-dark">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
</div>

=======
    <ul class="list-group">
        <li class="list-group-item">
            <b>Gedung:</b> {{ $lantai->gedung->nama_gedung }}
        </li>
        <li class="list-group-item">
            <b>Kode Lantai:</b> {{ $lantai->kode_lantai }}
        </li>
        <li class="list-group-item">
            <b>Nama Lantai:</b> {{ $lantai->nama_lantai ?? '-' }}
        </li>
        <li class="list-group-item">
            <b>Status:</b>

            @if($lantai->is_active)
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

    <a href="{{ route('lantai.index') }}" class="btn btn-secondary mt-3">
        <i class="fa-solid fa-arrow-left me-1"></i>Kembali
    </a>
</div>
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
@endsection