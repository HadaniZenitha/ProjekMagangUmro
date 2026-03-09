@extends('layouts.dashboard')

@section('title', 'DASHBOARD UTAMA')

@section('content')

<div class="container-fluid">

{{-- ROW CARD DASHBOARD --}}
<div class="row g-3 mb-4 justify-content-center">

    {{-- BARIS 1: 3 KARTU --}}
    <div class="col-12 col-md-4">
        {{-- TOTAL BARANG --}}
        <div class="card border-0 shadow-sm h-100" style="border-left:5px solid #309FB0; min-height:140px;">
            <div class="card-body d-flex align-items-center p-4">
                <div class="bg-info bg-opacity-10 p-3 rounded-3 me-3">
                    <i class="fa-solid fa-box text-info fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1" style="font-size:12px;font-weight:700;letter-spacing:1px;">TOTAL BARANG</h6>
                    <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalBarang) }}</h2>
                    <small class="text-muted">Item terdata</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        {{-- TOTAL RUANG --}}
        <div class="card border-0 shadow-sm h-100" style="border-left:5px solid #F39C12; min-height:140px;">
            <div class="card-body d-flex align-items-center p-4">
                <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                    <i class="fa-solid fa-door-open text-warning fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1" style="font-size:12px;font-weight:700;letter-spacing:1px;">TOTAL RUANGAN</h6>
                    <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalRuang) }}</h2>
                    <small class="text-muted">Ruang aktif</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        {{-- BARANG RUSAK --}}
        <div class="card border-0 shadow-sm h-100" style="border-left:5px solid #E74C3C; min-height:140px;">
            <div class="card-body d-flex align-items-center p-4">
                <div class="bg-danger bg-opacity-10 p-3 rounded-3 me-3">
                    <i class="fa-solid fa-triangle-exclamation text-danger fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1" style="font-size:12px;font-weight:700;letter-spacing:1px;">BARANG RUSAK</h6>
                    <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalBarangRusak) }}</h2>
                    <small class="text-muted">Perlu perbaikan</small>
                </div>
            </div>
        </div>
    </div>

    {{-- BARIS 2: 2 KARTU --}}
    <div class="col-12 col-md-6">
        {{-- PERLU PERBAIKAN --}}
        <div class="card border-0 shadow-sm h-100" style="border-left:5px solid #8E44AD; min-height:140px;">
            <div class="card-body d-flex align-items-center p-4">
                <div class="bg-purple bg-opacity-10 p-3 rounded-3 me-3" style="background-color:rgba(142,68,173,0.1)">
                    <i class="fa-solid fa-screwdriver-wrench text-purple fs-3" style="color:#8E44AD"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1" style="font-size:12px;font-weight:700;letter-spacing:1px;">BARANG PERLU PERBAIKAN</h6>
                    <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalPerluPerbaikan) }}</h2>
                    <small class="text-muted">Menunggu perbaikan</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6">
        {{-- TOTAL BARANG KONDISI BAIK --}}
        <div class="card border-0 shadow-sm h-100" style="border-left:5px solid #28A745; min-height:140px;">
            <div class="card-body d-flex align-items-center p-4">
                <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                    <i class="fa-solid fa-circle-check text-success fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1" style="font-size:12px;font-weight:700;letter-spacing:1px;">TOTAL BARANG KONDISI BAIK</h6>
                    <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalBarangBaik) }}</h2>
                    <small class="text-muted">Jumlah barang dalam kondisi baik</small>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- BAGIAN BAWAH --}}
<div class="row g-4">

<div class="row g-3">

    {{-- KIRI: TABEL BARANG TERBARU --}}
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-dark">
                    <i class="fa-solid fa-clock-rotate-left me-2 text-info"></i>
                    Penambahan Terbaru
                </h6>
                <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-info fw-bold">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jenis</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th class="text-center">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barangTerbaru as $barang)
                            <tr>
                                <td class="fw-medium">{{ $barang->nama_barang }}</td>
                                <td>{{ $barang->subjenis->nama_subjenis ?? '-' }}</td>
                                <td>{{ $barang->ruang->nama_ruang ?? '-' }}</td>
                                <td>
                                    @if($barang->keterangan == 'Baik')
                                        <span class="badge bg-success">Baik</span>
                                    @elseif($barang->keterangan == 'Rusak')
                                        <span class="badge bg-danger">Rusak</span>
                                    @elseif($barang->keterangan == 'Perlu Perbaikan')
                                        <span class="badge bg-warning text-dark">Perlu Perbaikan</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $barang->created_at?->format('d M Y') ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada data barang.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- KANAN: AKSI CEPAT --}}
    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold text-dark">Aksi Cepat</h6>
            </div>
            <div class="card-body d-grid gap-2">
                <a href="{{ route('barang.index') }}" class="btn btn-outline-info text-dark fw-bold text-start">
                    <i class="fa-solid fa-plus me-2"></i> Tambah Inventaris
                </a>
                <a href="{{ route('ruangs.index') }}" class="btn btn-outline-warning text-dark fw-bold text-start">
                    <i class="fa-solid fa-door-open me-2"></i> Kelola Ruangan
                </a>
                <hr>
                <p class="small text-muted mb-0">
                    Sistem ini mempermudah monitoring aset secara real-time.
                </p>
            </div>
        </div>
    </div>

</div>

</div>
@endsection
