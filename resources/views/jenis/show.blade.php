@extends('layouts.dashboard')

@section('title', 'Detail Jenis Barang')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <h5 class="mb-3">
            Kode Jenis: <span class="badge bg-dark">{{ $jenis->kode_jenis }}</span>
        </h5>

        <p>
            <b>Nama Jenis:</b><br>
            {{ $jenis->nama_jenis }}
        </p>

        <p>
            <b>Kelompok Barang:</b><br>
            {{ $jenis->kelompok->nama_kelompok }}
        </p>

        <p>
            <b>Deskripsi:</b><br>
            {{ $jenis->deskripsi ?? '-' }}
        </p>

        <a href="{{ route('jenis.index') }}" class="btn btn-secondary">
            Kembali
        </a>

        <a href="{{ route('jenis.edit', $jenis->id) }}" class="btn btn-warning">
            Edit
        </a>

    </div>
</div>
@endsection
