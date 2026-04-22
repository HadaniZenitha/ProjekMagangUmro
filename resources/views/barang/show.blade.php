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

    .avatar-sm-text {
        width: 24px;
        height: 24px;
        background: #f0f2f5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.01);
    }

    /* Menghilangkan border terakhir agar tidak double dengan card */
    .table tbody tr:last-child td {
        border-bottom: none;
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
            <a href="{{ route('barang.cetak', $barang->id) }}" target="_blank"
                    class="btn btn-success btn-clean shadow-sm">
                    <i class="fa-solid fa-print"></i> Cetak Stiker
            </a>
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
                    {!! QrCode::size(150)->generate(url('/scan-redirect/' . $barang->kode_barang)) !!}
                    {{-- {!! QrCode::size(150)->generate(route('barang.scan', $barang->kode_barang)) !!} --}}
                </div>
                <p class="text-muted small mb-0 px-3">Gunakan untuk tracking aset secara cepat.</p>
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
                            <img src="{{ asset('storage/' . $barang->foto) }}" class="img-fluid rounded shadow-sm"
                                style="max-height: 300px; width: 100%; object-fit: cover;">
                        @else
                            <div class="bg-light border rounded d-flex flex-column align-items-center justify-content-center"
                                style="height: 250px;">
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

            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h6 class="fw-bold mb-0">
                        <i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>
                        Riwayat Perubahan & Mutasi
                    </h6>
                </div>
            
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr class="small text-uppercase fw-bold text-muted">
                                <th class="ps-3" style="width: 130px;">Tanggal</th>
                                <th>PIC (Lama → Baru)</th>
                                <th style="width: 120px;">Kondisi</th>
                                <th class="d-none d-lg-table-cell">Admin</th>
                                <th>Detail Perubahan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barang->barangHistories->sortByDesc('tanggal_perubahan') as $history)
                            <tr>
                                <!-- Tanggal -->
                                <td class="ps-3">
                                    <span class="fw-medium text-dark d-block" style="font-size: 0.9rem;">
                                        {{ $history->tanggal_perubahan->format('d M Y') }}
                                    </span>
                                    <small class="text-muted" style="font-size: 0.8rem;">
                                        {{ $history->tanggal_perubahan->format('H:i') }} WIB
                                    </small>
                                </td>
                            
                                <!-- PIC (Lama → Baru) -->
                                <td>
                                    @if($history->pic_id_baru)
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <span class="badge bg-light text-muted border fw-normal small">
                                                {{ $history->picLama->nama_pic ?? 'Awal' }}
                                            </span>
                                            <i class="fa-solid fa-arrow-right-long text-primary small"></i>
                                            <span class="badge bg-white text-primary border border-primary fw-semibold small">
                                                {{ $history->picBaru->nama_pic ?? '—' }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-muted small italic">—</span>
                                    @endif
                                </td>
                            
                                <!-- Kondisi -->
                                <td>
                                    @php
                                        $color = $history->kondisi == 'baik' ? 'success' : ($history->kondisi == 'perlu perbaikan' ? 'warning' : 'danger');
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <span class="badge rounded-pill bg-{{ $color }}" style="width: 8px; height: 8px; padding: 0; margin-right: 8px;"></span>
                                        <span class="badge rounded-pill text-{{ $color }}">
                                            {{ strtoupper($history->kondisi) }}
                                        </span>
                                    </div>
                                </td>
                            
                                <!-- Admin -->
                                <td class="d-none d-lg-table-cell">
                                    <div class="d-flex align-items-center small text-muted">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 24px; height: 24px;">
                                            <i class="fa-solid fa-user-gear" style="font-size: 0.7rem;"></i>
                                        </div>
                                        {{ $history->user->name ?? 'System' }}
                                    </div>
                                </td>
                            
                                <!-- Detail Perubahan -->
                                <td class="small text-muted">
                                    @php
                                        $catatanArr = explode(', ', $history->catatan);
                                        $filteredCatatan = array_filter($catatanArr, function($item) {
                                            return stripos($item, 'PIC') === false;
                                        });
                                        $outputCatatan = implode(', ', $filteredCatatan);
                                        $cleanOutput = trim(str_replace('Perubahan:', '', $outputCatatan));
                                    @endphp
                                    @if($cleanOutput && $cleanOutput != "")
                                        {{ $cleanOutput }}
                                    @else
                                        <span class="text-muted opacity-50 italic">Hanya pergantian PIC</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="py-3">
                                        <i class="fa-solid fa-folder-open fa-3x mb-3 text-light"></i>
                                        <p class="text-muted mb-0">Belum ada riwayat perubahan.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            {{-- <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold mb-0">
                        <i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>Riwayat Perubahan & Mutasi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle">
                            <thead class="table-light">
                                <tr class="small text-uppercase text-muted">
                                    <th style="width: 150px;">Tanggal</th>
                                    <th>PIC (Lama → Baru)</th>
                                    <th>Kondisi</th>
                                    <th>Admin</th>
                                    <th>Detail Perubahan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($barang->barangHistories->sortByDesc('tanggal_perubahan') as $history)
                                <tr>
                                    <td class="small text-dark">
                                        {{ $history->tanggal_perubahan->format('d/m/Y H:i') }}
                                    </td>
                                    <td>
                                        @if($history->pic_id_baru)
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="text-muted small">{{ $history->picLama->nama_pic ?? 'Awal' }}</span>
                                                <i class="fa-solid fa-arrow-right text-primary" style="font-size: 0.7rem;"></i>
                                                <span class="fw-bold small">{{ $history->picBaru->nama_pic ?? '-' }}</span>
                                            </div>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $history->kondisi == 'baik' ? 'success' : ($history->kondisi == 'perlu perbaikan' ? 'warning' : 'danger') }} py-1 px-2" style="font-size: 0.65rem;">
                                            {{ strtoupper($history->kondisi) }}
                                        </span>
                                    </td>
                                    <td class="small">
                                        <i class="fa-solid fa-user-check me-1 text-secondary"></i>
                                        {{ $history->user->name ?? 'System' }}
                                    </td>
                                    <td class="small">
                                        <div class="text-muted italic">
                                            {{ $history->catatan ?? '-' }}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted small py-4">
                                        Belum ada riwayat perubahan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
@endsection