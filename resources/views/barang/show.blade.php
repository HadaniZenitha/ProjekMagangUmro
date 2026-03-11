@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Detail Barang</h2>

    <ul class="list-group">
        <li class="list-group-item">
            <b>Nama Barang:</b> {{ $barang->nama_barang }}
        </li>

        <li class="list-group-item">
            <b>Kode Inventaris:</b> 
            <span class="badge bg-dark">{{ $barang->kode_barang }}</span>
        </li>

        <li class="list-group-item">
            <b>Lokasi:</b> {{ $barang->ruang->nama_ruang ?? '-' }}
        </li>

        <li class="list-group-item">
            <b>Tahun Masuk:</b> {{ $barang->tahun_perolehan }}
        </li>

        <li class="list-group-item">
            <b>Kondisi:</b> {{ $barang->kondisi ?? '-' }}
        </li>
    </ul>

    <div class="mt-4">
        <h5>QR Code Barang</h5>

        <div class="p-3 bg-light d-inline-block rounded">
            {!! QrCode::size(150)->generate(route('barang.scan', $barang->kode_barang)) !!}
        </div>

        <p class="mt-2 text-muted">
            Scan QR Code untuk melihat informasi barang.
        </p>
    </div>

<<<<<<< HEAD
    {{-- Tombol --}}
    <div class="mt-4 d-flex gap-2">

        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning text-dark">
            <i class="fa-solid fa-pen-to-square me-1"></i> Update
        </a>

        <a href="{{ route('barang.index') }}" class="btn btn-danger text-dark">
            <i class="fa-solid fa-xmark me-1"></i> Batal
        </a>

=======
    <div class="mt-3">
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>Kembali
        </a>
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
    </div>

</div>
@endsection