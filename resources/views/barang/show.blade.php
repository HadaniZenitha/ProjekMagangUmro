@extends('layouts.dashboard')

@section('content')
<div class="container">

    <h2 class="mb-4">Detail Barang</h2>

    {{-- INFORMASI --}}
    <ul class="list-group mb-4">

        <li class="list-group-item">
            <b>Nama Barang :</b> {{ $barang->nama_barang }}
        </li>

        <li class="list-group-item">
            <b>Kode Inventaris :</b>
            <span class="badge bg-dark">{{ $barang->kode_barang }}</span>
        </li>

        <li class="list-group-item">
            <b>Lokasi :</b> {{ $barang->ruang->nama_ruang ?? '-' }}
        </li>

        <li class="list-group-item">
            <b>Tahun Masuk :</b> {{ $barang->tahun_perolehan }}
        </li>

        <li class="list-group-item">
            <b>Kondisi :</b> {{ $barang->kondisi ?? '-' }}
        </li>

    </ul>

    {{-- QR CODE --}}
    <div class="mb-4">
        <h5>QR Code Barang</h5>

        <div class="p-3 bg-light d-inline-block rounded shadow-sm">
            {!! QrCode::size(150)->generate(route('barang.scan', $barang->kode_barang)) !!}
        </div>

        <p class="mt-2 text-muted">
            Scan QR Code untuk melihat informasi barang.
        </p>
    </div>

    {{-- BUTTON --}}
    <div class="d-flex left-content-end gap-2">

        <a href="{{ route('barang.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCetak">
            <i class="fa-solid fa-print me-1"></i> Cetak Stiker
        </button>

    </div>

</div>

{{-- ================= MODAL CETAK STIKER ================= --}}
<div class="modal fade" id="modalCetak" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Preview Stiker Inventaris</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">

                {{-- STIKER --}}
                <div id="stikerPreview" class="border p-3 rounded shadow-sm d-inline-block bg-white">

                    <h6 class="mb-2 fw-bold">{{ $barang->nama_barang }}</h6>

                    <p class="mb-1">
                        <b>Kode:</b> {{ $barang->kode_barang }}
                    </p>

                    <p class="mb-2">
                        <b>Lokasi:</b> {{ $barang->ruang->nama_ruang ?? '-' }}
                    </p>

                    {{-- QR CODE --}}
                    <div>
                        {!! QrCode::size(120)->generate(route('barang.scan', $barang->kode_barang)) !!}
                    </div>

                </div>

            </div>

            <div class="modal-footer d-flex justify-content-between">

                <button onclick="cetakStiker()" class="btn btn-primary">
                    <i class="fa-solid fa-print me-1"></i> Cetak Stiker
                </button>

                <a href="{{ route('barang.barcode', $barang->kode_barang) }}" target="_blank" class="btn btn-dark">
                    <i class="fa-solid fa-barcode me-1"></i> Cetak Barcode
                </a>

                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>

            </div>

        </div>
    </div>
</div>

{{-- ================= SCRIPT CETAK ================= --}}
<script>
function cetakStiker() {
    var printContents = document.getElementById('stikerPreview').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = `
        <html>
        <head>
            <title>Cetak Stiker</title>
            <style>
                body {
                    text-align: center;
                    font-family: Arial;
                    margin: 20px;
                }
            </style>
        </head>
        <body>
            ${printContents}
        </body>
        </html>
    `;

    window.print();
    document.body.innerHTML = originalContents;
    location.reload();
}
</script>

@endsection