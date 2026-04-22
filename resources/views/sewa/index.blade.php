@extends('layouts.dashboard')

@section('page-title', 'Data Item Sewa')
@section('title', 'Data Item Sewa')

@section('content')

<style>
/* ===== CARD ===== */
.filter-card {
    border-radius: 12px;
    border: 1px solid #eee;
}

/* ===== BUTTON ===== */
.btn-pro {
    border-radius: 8px;
    font-weight: 500;
    padding: 6px 14px;
}

/* HEADER TETAP TENGAH */
.table-fix th {
    text-align: center;
}

/* ISI RATA KIRI */
.table-fix td {
    text-align: left;
    vertical-align: middle;
}

/* ===== WIDTH KOLOM (PENTING BANGET) ===== */
.col-kode   { width: 90px; }
.col-pic    { width: 200px; }
.col-fungsi { width: 180px; }
.col-nama   { width: 160px; }
.col-lokasi { width: 150px; }
.col-tahun  { width: 80px; }
.col-kondisi{ width: 120px; }
.col-aksi   { width: 130px; }

/* ===== TEXT CONTROL ===== */
.text-wrap {
    white-space: normal;
    word-break: break-word;
}

/* ===== AKSI BUTTON ===== */
.aksi-group {
    display: flex;
    justify-content: center;
    gap: 6px;
}

.aksi-group .btn {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* ===== BUTTON COLOR FIX ===== */
.btn-info {
    background-color: #0dcaf0;
    border: none;
}

.btn-warning {
    background-color: #ffc107;
    border: none;
    color: #000;
}

.btn-danger {
    background-color: #dc3545;
    border: none;
}

/* ===== MOBILE ===== */
@media (max-width: 768px) {
    .btn-mobile {
        width: 100%;
    }
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

            <button class="btn btn-success btn-pro btn-mobile" data-bs-toggle="modal" data-bs-target="#modalImport">
                <i class="fas fa-file-excel"></i> Import Excel
            </button>
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

                    <div class="col-lg-auto col-md-6 d-flex">
                        <button class="btn btn-primary btn-pro w-100">
                            <i class="fa-solid fa-filter me-1"></i> Filter
                        </button>
                    </div>

                    <div class="col-lg-auto col-md-6 d-flex">
                        <a href="{{ route('barang-sewa.index') }}" class="btn btn-secondary btn-pro w-100">
                            <i class="fa-solid fa-rotate-left me-1"></i> Reset
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </form>

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 table-fix">

                <thead class="table-light">
                    <tr class="small text-uppercase text-muted">
                        <th class="col-kode">Kode</th>
                        <th class="col-pic">PIC</th>
                        <th class="col-fungsi">Fungsi</th>
                        <th class="col-nama">Nama Item</th>
                        <th class="col-lokasi">Lokasi</th>
                        <th class="col-tahun">Tahun</th>
                        <th class="col-kondisi">Kondisi</th>
                        <th class="col-aksi">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $d)
                    <tr>

                        {{-- KODE --}}
                        <td class="text-center">
                            <span class="badge bg-dark">
                                {{ $d->kode_barang }}
                            </span>
                        </td>

                        {{-- PIC --}}
                        <td>
                            {{ $d->pic->nama_pic ?? '-' }}
                        </td>

                        {{-- FUNGSI --}}
                        <td>
                            {{ $d->divisi->nama_divisi ?? '-' }}
                        </td>

                        {{-- NAMA ITEM --}}
                        <td>
                            {{ $d->nama_barang }}
                        </td>

                        {{-- LOKASI --}}
                        <td>
                            {{ $d->ruang->nama_ruang ?? '-' }}
                        </td>

                        {{-- TAHUN --}}
                        <td class="text-center fw-semibold">
                            {{ $d->tahun }}
                        </td>

                        {{-- KONDISI --}}
                        <td>
                            @if($d->kondisi == 'Baik')
                                <span class="badge bg-success">Baik</span>
                            @elseif($d->kondisi == 'Perlu Perbaikan')
                                <span class="badge bg-warning text-dark">Perlu Perbaikan</span>
                            @else
                                <span class="badge bg-danger">Rusak</span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td>
                            <div class="d-flex justify-content-center gap-1">

                                <a href="{{ route('barang-sewa.show', $d->id) }}" class="btn btn-info btn-sm">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                @if(!auth()->user()->hasRole('user'))
                                    <a href="{{ route('barang-sewa.edit', $d->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <form action="{{ route('barang-sewa.destroy', $d->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Hapus barang ini?')" class="btn btn-danger btn-sm">
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
                            Data Item sewa belum tersedia
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

    {{-- PAGINATION --}}
    <div class="mt-3">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection