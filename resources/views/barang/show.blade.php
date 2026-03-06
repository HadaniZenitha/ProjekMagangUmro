@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Detail Barang</h2>

<<<<<<< HEAD
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
=======
    <ul class="list-group">
        <li class="list-group-item">
            <b>Nama Barang:</b> {{ $barang->nama_barang }}
        </li>

        <li class="list-group-item">
            <b>Kode Inventaris:</b> 
            <span class="badge bg-dark">{{ $barang->kode_barang }}</span>
        </li>
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44

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

        <div class="p-3 bg-light d-inline-block rounded">
            {!! QrCode::size(150)->generate(route('barang.scan', $barang->kode_barang)) !!}
        </div>

        <p class="mt-2 text-muted">
            Scan QR Code untuk melihat informasi barang.
        </p>
    </div>

<<<<<<< HEAD
        <div class="mt-3">
            <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>

=======
    <div class="mt-3">
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>Kembali
        </a>
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
    </div>
</div>
@endsection