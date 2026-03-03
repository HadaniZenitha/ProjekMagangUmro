@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Detail Sub Jenis Barang</h2>

    <ul class="list-group">
        <li class="list-group-item">
            <b>Kode Sub Jenis:</b> 
            <span class="badge bg-dark">{{ $subjenis->kode_subjenis }}</span>
        </li>

        <li class="list-group-item">
            <b>Nama Sub Jenis:</b> 
            {{ $subjenis->nama_subjenis }}
        </li>

        <li class="list-group-item">
            <b>Jenis Barang:</b> 
            {{ $subjenis->jenis->nama_jenis }}
        </li>

        <li class="list-group-item">
            <b>Deskripsi:</b> 
            {{ $subjenis->deskripsi ?? '-' }}
        </li>
    </ul>

    <div class="mt-3">
        <a href="{{ route('subjenis.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>Kembali
        </a>
    </div>
</div>
@endsection