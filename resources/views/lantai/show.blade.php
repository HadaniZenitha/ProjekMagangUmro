@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Detail Lantai</h2>

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
@endsection