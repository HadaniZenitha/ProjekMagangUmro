@extends('layouts.dashboard')

@section('page-title', 'Detail Barang Sewa')
@section('title', 'Detail Barang Sewa')

@section('content')

<div class="container-fluid">

    <h5 class="fw-bold mb-4">Detail Barang Sewa</h5>

    <div class="row">

        {{-- INFORMASI --}}
        <div class="col-md-8">

            <div class="card border shadow-sm">
                <div class="card-body">

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item">
                            <b>Nama Barang :</b> {{ $data->nama_barang }}
                        </li>

                        <li class="list-group-item">
                            <b>Kode Barang :</b> 
                            <span class="badge bg-dark">{{ $data->kode_barang }}</span>
                        </li>

                        <li class="list-group-item">
                            <b>PIC :</b> {{ $data->pic->nama_pic ?? '-' }}
                        </li>

                        <li class="list-group-item">
                            <b>Lokasi :</b> {{ $data->ruang->nama_ruang ?? '-' }}
                        </li>

                        <li class="list-group-item">
                            <b>Fungsi :</b> {{ $data->fungsi ?? '-' }}
                        </li>

                        <li class="list-group-item">
                            <b>Tahun :</b> {{ $data->tahun }}
                        </li>

                        <li class="list-group-item">
                            <b>Kondisi :</b>
                            @if($data->kondisi == 'Baik')
                                <span class="badge bg-success">Baik</span>
                            @elseif($data->kondisi == 'Perlu Perbaikan')
                                <span class="badge bg-warning text-dark">Perlu Perbaikan</span>
                            @else
                                <span class="badge bg-danger">Rusak</span>
                            @endif
                        </li>

                    </ul>

                </div>
            </div>

            {{-- BUTTON (DI LUAR CARD, JARAK RAPI) --}}
            <div class="mt-3 d-flex left-content-end gap-2">

                <a href="{{ route('barang-sewa.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>

                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fa-solid fa-print me-1"></i> Cetak Stiker
                </button>

            </div>

        </div>

        {{-- QR CODE --}}
        <div class="col-md-4 text-center">

            <div class="card border shadow-sm">
                <div class="card-body">

                    <h6 class="fw-bold mb-3">QR Code</h6>

                    <div class="p-3 bg-light rounded d-inline-block shadow-sm">
                        {!! QrCode::size(180)->generate($data->kode_barang) !!}
                    </div>

                    <p class="mt-3 text-muted small">
                        Scan QR Code untuk melihat detail barang
                    </p>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection