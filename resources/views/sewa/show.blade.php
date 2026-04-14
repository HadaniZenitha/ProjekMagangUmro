@extends('layouts.dashboard')

@section('content')
<div class="container">

    <h2 class="mb-4">Detail Item</h2>

    <div class="row">

        <!-- KIRI: INFORMASI -->
        <div class="col-md-7">

            <div class="card shadow-sm">

                <div class="card-body">

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <b>Nama Item :</b> {{ $sewa->nama_barang }}
                        </li>

                        <li class="list-group-item">
                            <b>Kode Inventaris :</b>
                            <span class="badge bg-dark">{{ $sewa->kode_barang }}</span>
                        </li>

                        <li class="list-group-item">
                            <b>Lokasi :</b> {{ $sewa->ruang->nama_ruang ?? '-' }}
                        </li>

                        <li class="list-group-item">
                            <b>Tahun Masuk :</b> {{ $sewa->tahun }}
                        </li>

                        <li class="list-group-item">
                            <b>Kondisi :</b> {{ $sewa->kondisi ?? '-' }}
                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <!-- KANAN: QR CODE -->
        <div class="col-md-5">

            <div class="card shadow-sm text-center">

                <div class="card-body">

                    <h5 class="mb-3">QR Code Item</h5>

                    <!-- <div class="p-3 bg-light d-inline-block rounded">
                        {!! QrCode::size(180)->generate($sewa->kode_barang) !!}
                    </div> -->

                    <p class="mt-3 text-muted small">
                        Scan QR Code untuk melihat informasi Item.
                    </p>

                </div>

            </div>
        </div>
    </div>

<!-- BUTTONS OUTSIDE BORDER -->
<div class="mt-3 d-flex justify-content-between align-items-center gap-2">

    <a href="{{ route('barang-sewa.index') }}" class="btn btn-secondary px-3">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
    {{-- <a href="{{ route('barang-sewa.cetak', $sewa->id) }}" class="btn btn-primary px-3">
        <i class="fa-solid fa-print me-1"></i> Cetak Stiker
    </a> --}}

</div>
</div>

@endsection