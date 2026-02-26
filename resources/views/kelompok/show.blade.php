@extends('layouts.dashboard')

@section('title', 'Detail Kelompok Barang')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <h5 class="mb-3">
            Kode Kelompok: <span class="badge bg-dark">{{ $kelompok->kode_kelompok }}</span>
        </h5>

        <p>
            <b>Nama Kelompok:</b><br>
            {{ $kelompok->nama_kelompok }}
        </p>

        <p>
            <b>Deskripsi:</b><br>
            {{ $kelompok->deskripsi ?? '-' }}
        </p>

        <a href="{{ route('kelompok.index') }}" class="btn btn-secondary">
            Kembali
        </a>

        <a href="{{ route('kelompok.edit', $kelompok->id) }}" class="btn btn-warning">
            Edit
        </a>

    </div>
</div>
@endsection
