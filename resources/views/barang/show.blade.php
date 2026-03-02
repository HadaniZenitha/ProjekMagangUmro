@extends('layouts.dashboard')

@section('title', 'Detail Barang')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <h4 class="mb-3">{{ $barang->nama_barang }}</h4>

        <p>
            <b>Kode Inventaris:</b> 
            {{ $barang->kode_barang }}
        </p>

        <p>
            <b>Lokasi:</b> 
            {{ $barang->ruang->nama_ruang }}
        </p>

        <p>
            <b>Tahun Masuk:</b> 
            {{ $barang->tahun_perolehan }}
        </p>

        <p>
            <b>Status:</b>

            @if($barang->keterangan == 'Baik')
                <span class="badge bg-success">Baik</span>

            @elseif($barang->keterangan == 'Perlu Perbaikan')
                <span class="badge bg-warning text-dark">Perlu Perbaikan</span>

            @elseif($barang->keterangan == 'Rusak')
                <span class="badge bg-danger">Rusak</span>

            @else
                <span class="badge bg-secondary">{{ $barang->keterangan }}</span>
            @endif
        </p>

        <hr>

        <h6>QR Code Barang</h6>

        <div class="p-3 bg-light d-inline-block rounded">
            {!! QrCode::size(150)->generate(route('barang.scan', $barang->kode_barang)) !!}
        </div>

        <p class="mt-2 text-muted">
            Scan QR Code untuk melihat informasi barang.
        </p>

        <div class="mt-3">
            <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>

    </div>
</div>
@endsection