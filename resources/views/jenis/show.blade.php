@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Detail Jenis Barang</h2>

    <ul class="list-group">
        <li class="list-group-item">
            <b>Kode Jenis:</b> 
            <span class="badge bg-dark">{{ $jenis->kode_jenis }}</span>
        </li>

        <li class="list-group-item">
            <b>Nama Jenis:</b> 
            {{ $jenis->nama_jenis }}
        </li>

        <li class="list-group-item">
            <b>Kelompok Barang:</b> 
            {{ $jenis->kelompok->nama_kelompok }}
        </li>

        <li class="list-group-item">
            <b>Deskripsi:</b> 
            {{ $jenis->deskripsi ?? '-' }}
        </li>
    </ul>

    <div class="mt-3">
        <a href="{{ route('jenis.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>Kembali
        </a>

        <a href="{{ route('jenis.edit', $jenis->id) }}" class="btn btn-warning">
            <i class="fa-solid fa-pen-to-square me-1"></i>Edit
        </a>
    </div>
</div>
@endsection