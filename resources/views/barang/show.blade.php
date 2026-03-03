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
            <b>Lokasi:</b> {{ $barang->ruang->nama_ruang }}
        </li>

        <li class="list-group-item">
            <b>Tahun Masuk:</b> {{ $barang->tahun_perolehan }}
        </li>

        <li class="list-group-item">
            <b>Kondisi:</b> {{ $barang->keterangan ?? '-' }}
        </li>
    </ul>

    <div class="mt-4">
        <h5>QR Code Barang</h5>

        <div class="p-3 bg-light d-inline-block">
            {!! QrCode::size(150)->generate(route('barang.scan', $barang->kode_barang)) !!}
        </div>

        <p class="mt-2 text-muted">
            Scan untuk melihat informasi barang.
        </p>
    </div>

    <div class="mt-3">
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>Kembali
        </a>
    </div>
</div>
@endsection