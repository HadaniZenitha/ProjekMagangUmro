@extends('layouts.dashboard')

@section('title', 'DASHBOARD UTAMA')

@section('content')
<div class="container-fluid">
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-left: 5px solid #309FB0 !important;">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="bg-info bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="fa-solid fa-box text-info fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1" style="font-size: 12px; font-weight: 700; letter-spacing: 1px;">TOTAL BARANG</h6>
                        <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalBarang) }}</h2>
                        <small class="text-muted">Item terdata</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-left: 5px solid #D4E157 !important;">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="fa-solid fa-door-open text-warning fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1" style="font-size: 12px; font-weight: 700; letter-spacing: 1px;">TOTAL RUANGAN</h6>
                        <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalRuang) }}</h2>
                        <small class="text-muted">Ruang aktif</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-left: 5px solid #1F6B76 !important;">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="fa-solid fa-hotel text-primary fs-3"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1" style="font-size: 12px; font-weight: 700; letter-spacing: 1px;">TOTAL GEDUNG</h6>
                        <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalGedung) }}</h2>
                        <small class="text-muted">Aset bangunan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold text-dark"><i class="fa-solid fa-clock-rotate-left me-2 text-info"></i>Penambahan Barang Terbaru</h6>
                    <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-info fw-bold">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3">Nama Barang</th>
                                    <th class="py-3">Jenis</th>
                                    <th class="py-3">Lokasi Ruang</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3 text-center">Tgl. Input</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($barangTerbaru as $barang)
                                <tr>
                                    <td class="fw-medium">{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->subjenis->nama_subjenis ?? '-' }}</td>
                                    <td>{{ $barang->ruang->nama_ruang ?? '-' }}</td>
                                    <td>
                                        @if($barang->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                        <span class="badge bg-danger">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $barang->created_at->format('d M Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center align-middle py-4 text-muted">Belum ada data barang yang terdaftar.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold text-dark">Aksi Cepat</h6>
                </div>
                <div class="card-body d-grid gap-2">
                    <a href="{{ route('barang.index') }}" class="btn btn-outline-info text-dark fw-bold py-2 text-start">
                        <i class="fa-solid fa-plus me-2"></i> Tambah Inventaris Baru
                    </a>
                    <a href="{{ route('ruangs.index') }}" class="btn btn-outline-warning text-dark fw-bold py-2 text-start">
                        <i class="fa-solid fa-door-open me-2"></i> Kelola Ruangan
                    </a>
                    <hr>
                    <p class="small text-muted mb-0">Sistem ini mempermudah monitoring aset PLN Nusantara Power secara real-time.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection