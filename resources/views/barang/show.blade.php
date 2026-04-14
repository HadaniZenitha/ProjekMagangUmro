@extends('layouts.dashboard')

@section('title', 'Detail Item Inventaris')

<style>
    /* ===== BUTTON CLEAN ===== */
.btn-clean{
    border-radius:8px;
    font-weight:500;
    font-size:14px;
    padding:6px 12px;
    box-shadow:none;
    transition:all 0.2s ease;
}

/* ===== WARNA SAMA ===== */
.btn-warning.btn-clean{
    background-color:#facc15;
    border:none;
    color:#000;
}

.btn-warning.btn-clean:hover{
    background-color:#fbbf24;
}

/* BATAL = MERAH */
.btn-danger.btn-clean{
    background-color:#ef4444;
    border:none;
    color:#fff;
}

.btn-danger.btn-clean:hover{
    background-color:#dc2626;
}

.btn-secondary.btn-clean{
    background-color:#e5e7eb;
    border:none;
    color:#000;
}

/* HOVER */
.btn-clean:hover{
    transform:translateY(-1px);
}

/* MOBILE */
@media (max-width: 768px){
    .btn-mobile-full{
        width:100%;
        text-align:center;
    }
}
</style>

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Detail Inventaris</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('barang.index') }}" class="btn btn-secondary btn-clean shadow-sm">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-5">
            <div class="card border-0 shadow-sm mb-4 text-center">
                <div class="card-header bg-white py-3 text-start">
                    <h6 class="fw-bold mb-0">Foto Barang</h6>
                </div>
                <div class="card-body">
                    @if ($barang->foto)
                        <img src="{{ asset('storage/' . $barang->foto) }}" 
                             class="img-fluid rounded shadow-sm" 
                             style="max-height: 300px; width: 100%; object-fit: cover;">
                    @else
                        <div class="bg-light border rounded d-flex flex-column align-items-center justify-content-center" style="height: 250px;">
                            <i class="fa-solid fa-image fa-3x text-muted mb-2"></i>
                            <p class="text-muted small">Foto tidak tersedia</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4 py-4 text-center">
                <h6 class="fw-bold mb-3">QR Code Identifikasi</h6>
                <div class="p-3 bg-white d-inline-block rounded border shadow-sm mb-2 mx-auto">
                    {!! QrCode::size(150)->generate(route('barang.scan', $barang->kode_barang)) !!}
                </div>
                <p class="text-muted small mb-0 px-3">Gunakan untuk tracking aset secara cepat.</p>
            </div>
        </div>

        <div class="col-lg-8 col-md-7">
            @if(!$barang->is_active)
            <div class="alert alert-danger border-0 shadow-sm mb-4">
                <h6 class="fw-bold"><i class="fa-solid fa-circle-exclamation me-2"></i>Barang Nonaktif</h6>
                <p class="mb-0 small italic">"{{ $barang->catatan_nonaktif ?? 'Tidak ada catatan alasan penonaktifan.' }}"</p>
            </div>
            @endif

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0">Informasi Teknis</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-4 text-muted small text-uppercase fw-bold">Kode Barang</label>
                        <div class="col-sm-8 text-dark fw-bold text-primary">{{ $barang->kode_barang }}</div>
                    </div>
                    <hr class="opacity-50">
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-4 text-muted small text-uppercase fw-bold">Nama Barang</label>
                        <div class="col-sm-8 text-dark">{{ $barang->nama_barang }}</div>
                    </div>
                    <hr class="opacity-50">
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-4 text-muted small text-uppercase fw-bold">Lokasi & PIC</label>
                        <div class="col-sm-8 text-dark">
                            <span class="d-block text-capitalize">{{ $barang->ruang->nama_ruang ?? '-' }}</span>
                            <span class="small text-muted">Oleh: {{ $barang->pic->nama_pic ?? '-' }} - 
                                @if($barang->pic->is_active)
								            <span class="badge-status bg-status-aktif">PIC Aktif</span>
								        @else
								            <span class="badge-status bg-status-nonaktif">PIC Nonaktif</span>
								@endif
                            </span>
                        </div>
                    </div>
                    <hr class="opacity-50">
                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-4 text-muted small text-uppercase fw-bold">Status Kondisi</label>
                        <div class="col-sm-8">
                            <span class="badge rounded-pill bg-{{ $barang->kondisi == 'baik' ? 'success' : ($barang->kondisi == 'perlu perbaikan' ? 'warning' : 'danger') }} px-3">
                                {{ ucfirst($barang->kondisi) }}
                            </span>
                            <span class="badge rounded-pill bg-{{ $barang->is_active ? 'info' : 'secondary' }} text-white px-3">
                                {{ $barang->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>Riwayat Perubahan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle">
                            <thead class="table-light">
                                <tr class="small text-uppercase text-muted">
                                    <th style="width: 180px;">Tanggal</th>
                                    <th>Kondisi</th>
                                    <th>Tahun</th>
                                    <th>Catatan Perubahan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($barang->barangHistories->sortByDesc('tanggal_perubahan') as $history)
                                <tr>
                                    <td class="small text-dark">
                                        {{ $history->tanggal_perubahan->format('d/m/Y H:i') }} WIB
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $history->kondisi == 'baik' ? 'success' : ($history->kondisi == 'perlu perbaikan' ? 'warning' : 'danger') }} py-1 px-2" style="font-size: 0.7rem;">
                                            {{ strtoupper($history->kondisi) }}
                                        </span>
                                    </td>
                                    <td class="fw-bold text-dark small">
                                        {{ $history->tahun_perolehan ?? '-' }}
                                    </td>
                                    <td class="small">
                                        {{ $history->catatan ?? '-' }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted small py-4">
                                        Belum ada riwayat perubahan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection