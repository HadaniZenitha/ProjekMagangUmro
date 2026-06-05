@extends('layouts.dashboard')

@section('page-title', 'Data Item Sewa')
@section('title', 'Data Item Sewa')

@section('content')

<style>
.filter-card {
    border-radius: 12px;
    border: 1px solid #eee;
}

.btn-pro {
    border-radius: 8px;
    font-weight: 500;
    padding: 6px 14px;
}

/* ===== TABLE EXCEL STYLE ===== */
.table-excel {
    border: 1px solid #dee2e6;
}

.table-excel th {
    background: #f8f9fa;
    text-align: center;
    font-size: 15px; /* 🔥 diperbesar */
    font-weight: 700;
}

.table-excel td {
    font-size: 14.5px; /* 🔥 diperbesar */
    vertical-align: middle;
}

/* ===== BADGE KODE ===== */
.kode-badge {
    background: #212529;
    color: #fff;
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    display: inline-block;
}

/* ===== KONDISI TEXT ONLY ===== */
.kondisi-baik
.kondisi-perbaikan
.kondisi-rusak  {
    color: #000;
    font-weight: 600;
}

.aksi-group .btn {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}


    /* ===== TABLE & BADGE ===== */
    .table td { vertical-align: middle; }
    
    .badge-status {
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 12px;
    }

/* ===== BUTTON COLOR FIX ===== */
.btn-info { background-color: #0dcaf0; border: none; }
.btn-warning { background-color: #ffc107; border: none; color: #000; }
.btn-danger { background-color: #dc3545; border: none; }

    .btn-pro {
        border-radius: 8px;
        font-weight: 500;
        padding: 7px 16px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.25s ease;
        border: none;
    }

    .btn-pro:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
    }

    .btn-pro:active {
        transform: translateY(0);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-icon {
        align-items: center;
        justify-content: center;
        display: inline-flex;
        padding: 0px;
        width: 38px;
        height: 38px;
        flex-shrink: 0;
    }

    .btn-icon i {
        margin-right: 0 !important;
        line-height: 1;
    }

    .action-btn {
        display: flex;
        gap: 8px;
        flex-wrap: nowrap;
        justify-content: center;
    }
</style>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
        <h5 class="fw-bold mb-0">Data Item Sewa</h5>

        <div class="d-flex flex-wrap gap-2">
            @if(!auth()->user()->hasRole('user'))
                <a href="{{ route('barang-sewa.create') }}" class="btn btn-warning btn-pro btn-mobile">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Item
                </a>
            @endif

            <!-- <button class="btn btn-success btn-pro btn-mobile" data-bs-toggle="modal" data-bs-target="#modalImport">
                <i class="fas fa-file-excel"></i> Import Excel
            </button> -->
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- FILTER --}}
    <form method="GET" action="{{ route('barang-sewa.index') }}">
        <div class="card filter-card shadow-sm mb-3">
            <div class="card-body">
                <div class="row g-3 align-items-end">

                    <div class="col-lg-6">
                        <label class="form-label small fw-semibold mb-1">Cari Item</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="fa-solid fa-magnifying-glass text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari kode / nama barang..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex">
                        <a href="{{ route('barang-sewa.exportPreview', request()->query()) }}"
                            class="btn btn-info btn-pro w-100">
                            <i class="fa-solid fa-eye"></i> Preview Excel
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex">
                        <a href="{{ route('barang-sewa.exportPdf', request()->query()) }}"
                            class="btn btn-danger btn-pro w-100">
                            <i class="fa-regular fa-file-pdf"></i> Export PDF
                        </a>
                    </div>

                </div>

                <div class="row g-3 mt-2 align-items-end">

                    <div class="col-lg-2 col-md-6">
                        <label class="form-label small fw-semibold mb-1">Ruangan</label>
                        <select name="ruang" class="form-select">
                            <option value="">Semua</option>
                            @foreach($ruangs as $r)
                                <option value="{{ $r->id }}" {{ request('ruang') == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama_ruang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <label class="form-label small fw-semibold mb-1">PIC</label>
                        <select name="pic" class="form-select">
                            <option value="">Semua</option>
                            @foreach($pics as $p)
                                <option value="{{ $p->id }}" {{ request('pic') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_pic }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <label class="form-label small fw-semibold mb-1">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small fw-semibold mb-1">Tahun</label>
                        <div class="input-group">
                            <input type="number" name="tahun_awal" class="form-control text-center"
                                value="{{ request('tahun_awal', date('Y') - 4) }}">
                            <span class="input-group-text">-</span>
                            <input type="number" name="tahun_akhir" class="form-control text-center"
                                value="{{ request('tahun_akhir', date('Y')) }}">
                        </div>
                    </div>

                    {{-- FILTER --}}
                    <div class="col-lg-auto col-md-4 d-flex">
                        <button type="submit" class="btn btn-primary btn-pro w-100">
                            <i class="fa-solid fa-filter"></i> Filter
                        </button>
                    </div>

                    {{-- RESET --}}
                    <div class="col-lg-auto col-md-4 d-flex">
                        <a href="{{ route('barang-sewa.index') }}" class="btn btn-secondary btn-pro w-100">
                            <i class="fa-solid fa-rotate-left"></i> Reset
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </form>

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-excel mb-0">

                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>PIC</th>
                            <th>Fungsi</th>
                            <th>Nama Item</th>
                            <th>Lokasi</th>
                            <th>Tahun</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $d)
                        <tr>

                        {{-- KODE --}}
                        <td class="text-left">
                            <span class="badge bg-dark">
                                {{ $d->kode_barang }}
                            </span>
                        </td>

                            <td>{{ $d->pic->nama_pic ?? '-' }}</td>
                            <td>{{ $d->divisi->nama_divisi ?? '-' }}</td>
                            <td>{{ $d->nama_barang }}</td>
                            <td>{{ $d->ruang->nama_ruang ?? '-' }}</td>

                            <td class="text-left">{{ $d->tahun }}</td>

                            <td class="text-left">
                                @if($d->kondisi == 'Baik')
                                    <span class="kondisi-baik">Baik</span>
                                @elseif($d->kondisi == 'Perlu Perbaikan')
                                    <span class="kondisi-perbaikan">Perlu Perbaikan</span>
                                @else
                                    <span class="kondisi-rusak">Rusak</span>
                                @endif
                            </td>

                            <td class="text-left">
                                <div class="action-btn">

                                    <a href="{{ route('barang-sewa.show', $d->id) }}" class="btn btn-info btn-sm btn-pro btn-icon" title="Lihat Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    @if(!auth()->user()->hasRole('user'))
                                        <a href="{{ route('barang-sewa.edit', $d->id) }}" class="btn btn-warning btn-sm btn-pro btn-icon" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <form action="{{ route('barang-sewa.destroy', $d->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Hapus barang ini?')" class="btn btn-danger btn-sm btn-pro btn-icon" title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                Tidak ada data Item Sewa
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">

        <div class="text-muted small">
            Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries
        </div>

</div>

@endsection