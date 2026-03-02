@extends('layouts.dashboard')

@section('page-title', 'Detail Lantai')

@section('content')

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

@endsection