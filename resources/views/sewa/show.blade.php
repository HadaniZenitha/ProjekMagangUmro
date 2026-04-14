@extends('layouts.dashboard')

@section('title', 'Detail Item Sewa')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Detail Item</h4>

        <a href="{{ route('barang-sewa.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">

        <!-- QR CODE (MOBILE FIRST) -->
        <div class="col-lg-5 order-1 order-lg-2">
            <div class="card border-0 shadow-sm text-center mb-4">
                <div class="card-header bg-white py-3 text-start">
                    <h6 class="fw-bold mb-0">QR Code Item</h6>
                </div>

                <div class="card-body">
                    <div class="p-3 bg-white border rounded shadow-sm d-inline-block mb-3">
                        {!! QrCode::size(160)->generate($sewa->kode_barang) !!}
                    </div>

                    <p class="text-muted small mb-0">
                        Scan untuk melihat detail item secara cepat.
                    </p>
                </div>
            </div>
        </div>

        <!-- INFORMASI STYLE CLEAN -->
        <div class="col-lg-7 order-2 order-lg-1">
            <div class="card border-0 shadow-sm">
                
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0">Informasi Teknis</h6>
                </div>

                <div class="card-body">

                    <!-- KODE -->
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-4 text-muted small text-uppercase fw-bold">Kode Item</label>
                        <div class="col-sm-8 text-dark fw-bold text-primary">
                            {{ $sewa->kode_barang }}
                        </div>
                    </div>

                    <hr class="opacity-50">

                    <!-- NAMA -->
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-4 text-muted small text-uppercase fw-bold">Nama Item</label>
                        <div class="col-sm-8 text-dark">
                            {{ $sewa->nama_barang }}
                        </div>
                    </div>

                    <hr class="opacity-50">

                    <!-- LOKASI -->
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-4 text-muted small text-uppercase fw-bold">Lokasi</label>
                        <div class="col-sm-8 text-dark">
                            {{ $sewa->ruang->nama_ruang ?? '-' }}
                        </div>
                    </div>

                    <hr class="opacity-50">

                    <!-- TAHUN -->
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-4 text-muted small text-uppercase fw-bold">Tahun Masuk</label>
                        <div class="col-sm-8 text-dark fw-semibold">
                            {{ $sewa->tahun }}
                        </div>
                    </div>

                    <hr class="opacity-50">

                    <!-- KONDISI -->
                    @php
                        $kondisi = strtolower($sewa->kondisi);
                        $warna = match($kondisi) {
                            'baik' => 'success',
                            'perlu perbaikan' => 'warning',
                            'rusak' => 'danger',
                            default => 'secondary'
                        };
                    @endphp

                    <div class="row mb-2 align-items-center">
                        <label class="col-sm-4 text-muted small text-uppercase fw-bold">Status Kondisi</label>
                        <div class="col-sm-8">
                            <span class="badge rounded-pill bg-{{ $warna }} px-3">
                                {{ ucfirst($sewa->kondisi ?? '-') }}
                            </span>

                            <span class="badge rounded-pill bg-info text-white px-3">
                                Aktif
                            </span>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>
@endsection