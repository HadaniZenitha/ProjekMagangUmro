@extends('layouts.dashboard')

@section('title', 'Detail Barang')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <h5>{{ $barang->nama_barang }}</h5>

        <p><b>Kode Inventaris:</b> {{ $barang->kode_barang }}</p>
        <p><b>Lokasi:</b> {{ $barang->ruang->nama_ruang }}</p>
        <p><b>Tahun Masuk:</b> {{ $barang->tahun_perolehan }}</p>
        <p><b>Kondisi:</b> {{ $barang->keterangan }}</p>

        <hr>

        <h6>QR Code Barang</h6>

        <div class="p-3 bg-light d-inline-block">
            {!! QrCode::size(150)->generate(route('barang.scan', $barang->kode_barang)) !!}
        </div>

        <p class="mt-2 text-muted">
            Scan untuk melihat informasi barang.
        </p>

        <a href="{{ route('barang.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
</div>
@endsection
