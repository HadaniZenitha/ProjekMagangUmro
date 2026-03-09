@extends('layouts.dashboard')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detail Kelompok Barang</h2>

        <a href="{{ route('kelompok.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <ul class="list-group">
        <li class="list-group-item">
            <b>Kode Kelompok:</b> 
            <span class="badge bg-dark">{{ $kelompok->kode_kelompok }}</span>
        </li>

        <li class="list-group-item">
            <b>Nama Kelompok:</b> 
            {{ $kelompok->nama_kelompok }}
        </li>

        <li class="list-group-item">
            <b>Deskripsi:</b> 
            {{ $kelompok->deskripsi ?? '-' }}
        </li>
    </ul>

    <div class="mt-3">
        <a href="{{ route('kelompok.edit', $kelompok->id) }}" class="btn btn-warning">
            <i class="fa-solid fa-pen-to-square me-1"></i> Edit
        </a>
    </div>

</div>
@endsection