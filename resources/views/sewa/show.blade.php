@extends('layouts.dashboard')

@section('title', 'Detail Item Sewa')

<style>
    /* ===== BUTTON CLEAN ===== */
    .btn-clean {
        border-radius: 8px;
        font-weight: 500;
        font-size: 14px;
        padding: 6px 12px;
        box-shadow: none;
        transition: all 0.2s ease;
    }

    .btn-success.btn-clean {
        background-color: #22c55e;
        border: none;
        color: #fff;
    }

    .btn-success.btn-clean:hover {
        background-color: #16a34a;
    }

    .btn-secondary.btn-clean {
        background-color: #e5e7eb;
        border: none;
        color: #000;
    }

    .btn-secondary.btn-clean:hover {
        background-color: #d1d5db;
    }

    .btn-clean:hover {
        transform: translateY(-1px);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.01);
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    /* ===== HEADER FLEX FIX ===== */
    .header-detail {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .action-btn {
        display: flex;
        gap: 10px;
    }

    /* MOBILE */
    @media (max-width:768px) {

        .header-detail {
            flex-direction: column;
            align-items: flex-start;
        }

        .action-btn {
            width: 100%;
            flex-direction: column;
        }

        .action-btn .btn {
            width: 100%;
            justify-content: center;
            display: flex;
            align-items: center;
            gap: 8px;
        }
    }
</style>

@section('content')
    <div class="container-fluid">

        <!-- HEADER -->
        <div class="header-detail mb-4">

            <h4 class="fw-bold mb-0">Detail Item Sewa</h4>

            <div class="action-btn">

                {{-- OPTIONAL CETAK --}}
                {{--
                <a href="{{ route('barang-sewa.cetak', $sewa->id) }}" target="_blank"
                    class="btn btn-success btn-clean shadow-sm">
                    <i class="fa-solid fa-print"></i> Cetak Stiker
                </a>
                --}}

                <a href="{{ route('barang-sewa.index') }}" class="btn btn-secondary btn-clean shadow-sm">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row">

            <!-- LEFT -->
            <div class="col-lg-4 col-md-5">

                <!-- FOTO -->
                <div class="card border-0 shadow-sm mb-4 text-center">

                    <div class="card-header bg-white py-3 text-start">
                        <h6 class="fw-bold mb-0">Foto Item</h6>
                    </div>

                    <div class="card-body">

                        @if ($sewa->foto)
                            <img src="{{ asset('storage/' . $sewa->foto) }}" class="img-fluid rounded shadow-sm"
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

                <!-- QR -->
                <div class="card border-0 shadow-sm mb-4 py-4 text-center">

                    <h6 class="fw-bold mb-3">QR Code Identifikasi</h6>

                    <div class="p-3 bg-white d-inline-block rounded border shadow-sm mb-2 mx-auto">
                        {!! QrCode::size(150)->generate($sewa->kode_barang) !!}
                    </div>

                    <p class="text-muted small mb-0 px-3">
                        Gunakan untuk tracking item secara cepat.
                    </p>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="col-lg-8 col-md-7">

                <!-- INFO -->
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">
                        <h6 class="fw-bold mb-0">Informasi Teknis</h6>
                    </div>

                    <div class="card-body">

                        <!-- KODE -->
                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-4 text-muted small text-uppercase fw-bold">
                                Kode Item
                            </label>

                            <div class="col-sm-8 text-dark fw-bold text-primary">
                                {{ $sewa->kode_barang }}
                            </div>
                        </div>

                        <hr class="opacity-50">

                        <!-- NAMA -->
                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-4 text-muted small text-uppercase fw-bold">
                                Nama Item
                            </label>

                            <div class="col-sm-8 text-dark">
                                {{ $sewa->nama_barang }}
                            </div>
                        </div>

                        <hr class="opacity-50">

                        <!-- LOKASI -->
                        <div class="row mb-3 align-items-center">

                            <label class="col-sm-4 text-muted small text-uppercase fw-bold">
                                Lokasi & PIC
                            </label>

                            <div class="col-sm-8 text-dark">

                                <span class="d-block text-capitalize">
                                    {{ $sewa->ruang->nama_ruang ?? '-' }}
                                </span>

                                <span class="small text-muted">
                                    Oleh: {{ $sewa->pic->nama_pic ?? '-' }} -

                                    @if($sewa->pic && $sewa->pic->is_active)
                                        <span class="badge-status bg-status-aktif">PIC Aktif</span>
                                    @else
                                         <span class="badge-status bg-status-nonaktif">PIC Nonaktif</span>
                                    @endif
                                </span>

                            </div>
                        </div>

                        <hr class="opacity-50">

                        <!-- TAHUN -->
                        <div class="row mb-3 align-items-center">

                            <label class="col-sm-4 text-muted small text-uppercase fw-bold">
                                Tahun Masuk
                            </label>

                            <div class="col-sm-8 text-dark fw-semibold">
                                {{ $sewa->tahun }}
                            </div>

                        </div>

                        <hr class="opacity-50">

                        <!-- KONDISI -->
                        @php
                            $kondisi = strtolower($sewa->kondisi);

                            $warna = match ($kondisi) {
                                'baik' => 'success',
                                'perlu perbaikan' => 'warning',
                                'rusak' => 'danger',
                                default => 'secondary'
                            };
                        @endphp

                        <div class="row mb-2 align-items-center">

                            <label class="col-sm-4 text-muted small text-uppercase fw-bold">
                                Status Kondisi
                            </label>

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

                <!-- RIWAYAT -->
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
                                    <th class="ps-3" style="width:130px;">Tanggal</th>
                                    <th>PIC (Lama → Baru)</th>
                                    <th style="width:120px;">Kondisi</th>
                                    <th class="d-none d-lg-table-cell">Admin</th>
                                    <th>Detail Perubahan</th>
                                </tr>
                            </thead>

                            <tbody>

                               @forelse(($sewa->histories ?? collect())->sortByDesc('tanggal_perubahan') as $history)
                                    <tr>

                                        <!-- TANGGAL -->
                                        <td class="ps-3">

                                            <span class="fw-medium text-dark d-block" style="font-size:0.9rem;">
                                                {{ $history->tanggal_perubahan->format('d M Y') }}
                                            </span>

                                            <small class="text-muted" style="font-size:0.8rem;">
                                                {{ $history->tanggal_perubahan->format('H:i') }} WIB
                                            </small>

                                        </td>

                                        <!-- PIC -->
                                        <td>

                                            @if($history->pic_id_baru)

                                                <div class="d-flex align-items-center gap-2 flex-wrap">

                                                    <span class="badge bg-light text-muted border fw-normal small">
                                                        {{ $history->picLama->nama_pic ?? 'Awal' }}
                                                    </span>

                                                    <i class="fa-solid fa-arrow-right-long text-primary small"></i>

                                                    <span
                                                        class="badge bg-white text-primary border border-primary fw-semibold small">
                                                        {{ $history->picBaru->nama_pic ?? '—' }}
                                                    </span>

                                                </div>

                                            @else

                                                <span class="text-muted small italic">—</span>

                                            @endif

                                        </td>

                                        <!-- KONDISI -->
                                        <td>

                                            @php
                                                $color = $history->kondisi == 'baik'
                                                    ? 'success'
                                                    : ($history->kondisi == 'perlu perbaikan'
                                                        ? 'warning'
                                                        : 'danger');
                                            @endphp

                                            <span class="badge rounded-pill text-{{ $color }}">
                                                {{ strtoupper($history->kondisi) }}
                                            </span>

                                        </td>

                                        <!-- ADMIN -->
                                        <td class="d-none d-lg-table-cell">

                                            <div class="d-flex align-items-center small text-muted">

                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2"
                                                    style="width:24px; height:24px;">

                                                    <i class="fa-solid fa-user-gear" style="font-size:0.7rem;"></i>

                                                </div>

                                                {{ $history->user->name ?? 'System' }}

                                            </div>

                                        </td>

                                        <!-- DETAIL -->
                                        <td class="small text-muted">

                                            @php
                                                $catatanArr = explode(', ', $history->catatan);

                                                $filteredCatatan = array_filter($catatanArr, function ($item) {
                                                    return stripos($item, 'PIC') === false;
                                                });

                                                $outputCatatan = implode(', ', $filteredCatatan);

                                                $cleanOutput = trim(str_replace('Perubahan:', '', $outputCatatan));
                                            @endphp

                                            @if($cleanOutput && $cleanOutput != "")
                                                {{ $cleanOutput }}
                                            @else
                                                <span class="text-muted opacity-50 italic">
                                                    Hanya pergantian PIC
                                                </span>
                                            @endif

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="text-center py-5">

                                            <div class="py-3">
                                                <i class="fa-solid fa-folder-open fa-3x mb-3 text-light"></i>

                                                <p class="text-muted mb-0">
                                                    Belum ada riwayat perubahan.
                                                </p>
                                            </div>

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
@endsection