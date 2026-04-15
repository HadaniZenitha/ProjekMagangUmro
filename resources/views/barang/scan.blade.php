@extends('layouts.dashboard')

@section('title', 'Detail Item Inventaris')

<style>
.btn-clean{
    border-radius:8px;
    font-weight:500;
    font-size:14px;
    padding:6px 12px;
    box-shadow:none;
    transition:all 0.2s ease;
}

.btn-warning.btn-clean{
    background-color:#facc15;
    border:none;
    color:#000;
}
.btn-warning.btn-clean:hover{
    background-color:#fbbf24;
}

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

.btn-success.btn-clean{
    background-color:#22c55e;
    border:none;
    color:#fff;
}
.btn-success.btn-clean:hover{
    background-color:#16a34a;
}

.btn-clean:hover{
    transform:translateY(-1px);
}

@media (max-width: 768px){
    .btn-mobile-full{
        width:100%;
        text-align:center;
    }
}
</style>

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h4 class="fw-bold mb-0">Detail Inventaris</h4>

        <div class="d-flex gap-2 flex-wrap">

            <!-- ✅ TOMBOL CETAK -->
            <a href="{{ route('barang.stiker', $barang->id) }}" 
               target="_blank"
               class="btn btn-success btn-clean shadow-sm">
                <i class="fa-solid fa-print"></i> Cetak Stiker
            </a>

            <a href="{{ route('barang.index') }}" 
               class="btn btn-secondary btn-clean shadow-sm">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>

        </div>
    </div>

    <div class="row">

        <!-- FOTO + QR -->
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

                <p class="text-muted small mb-0 px-3">
                    Gunakan untuk tracking aset secara cepat.
                </p>
            </div>

        </div>

        <!-- DETAIL -->
        <div class="col-lg-8 col-md-7">

            @if(!$barang->is_active)
            <div class="alert alert-danger border-0 shadow-sm mb-4">
                <h6 class="fw-bold">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    Barang Nonaktif
                </h6>
                <p class="mb-0 small italic">
                    "{{ $barang->catatan_nonaktif ?? 'Tidak ada catatan alasan penonaktifan.' }}"
                </p>
            </div>
            @endif

            <!-- INFO -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0">Informasi Teknis</h6>
                </div>

                <div class="card-body">

                    <div class="row mb-3">
                        <label class="col-sm-4 text-muted small fw-bold">Kode Barang</label>
                        <div class="col-sm-8 fw-bold text-primary">
                            {{ $barang->kode_barang }}
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <label class="col-sm-4 text-muted small fw-bold">Nama Barang</label>
                        <div class="col-sm-8">
                            {{ $barang->nama_barang }}
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <label class="col-sm-4 text-muted small fw-bold">Lokasi & PIC</label>
                        <div class="col-sm-8">
                            <div>{{ $barang->ruang->nama_ruang ?? '-' }}</div>

                            <small class="text-muted">
                                {{ $barang->pic->nama_pic ?? '-' }}
                                -
                                @if(optional($barang->pic)->is_active)
                                    <span class="badge bg-success">PIC Aktif</span>
                                @else
                                    <span class="badge bg-secondary">PIC Nonaktif</span>
                                @endif
                            </small>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <label class="col-sm-4 text-muted small fw-bold">Status</label>
                        <div class="col-sm-8">

                            <span class="badge bg-{{ $barang->kondisi == 'baik' ? 'success' : ($barang->kondisi == 'perlu perbaikan' ? 'warning' : 'danger') }}">
                                {{ ucfirst($barang->kondisi) }}
                            </span>

                            <span class="badge bg-{{ $barang->is_active ? 'info' : 'secondary' }}">
                                {{ $barang->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>

                        </div>
                    </div>

                </div>
            </div>

            <!-- HISTORY -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0">Riwayat Perubahan</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-sm table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kondisi</th>
                                    <th>Tahun</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($barang->barangHistories->sortByDesc('tanggal_perubahan') as $history)
                                <tr>
                                    <td>{{ $history->tanggal_perubahan->format('d/m/Y H:i') }}</td>

                                    <td>
                                        <span class="badge bg-{{ $history->kondisi == 'baik' ? 'success' : ($history->kondisi == 'perlu perbaikan' ? 'warning' : 'danger') }}">
                                            {{ $history->kondisi }}
                                        </span>
                                    </td>

                                    <td>{{ $history->tahun_perolehan ?? '-' }}</td>
                                    <td>{{ $history->catatan ?? '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Belum ada riwayat
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