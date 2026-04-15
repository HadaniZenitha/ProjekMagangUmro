@extends('layouts.dashboard')

@section('page-title', 'Data Item Sewa')
@section('title', 'Data Item Sewa')

@section('content')

<style>
    /* ===== GLOBAL STYLE ===== */
    .custom-card {
        border-radius: 14px;
        background: #ffffff;
        border: 1px solid #eaeaea;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
    }

    .filter-card {
        border-radius: 12px;
        border: 1px solid #eee;
    }

    /* ===== BUTTONS ===== */
    .btn-pro {
        border-radius: 8px;
        font-weight: 500;
        padding: 6px 14px;
        transition: all 0.2s ease;
    }

    .btn-pro:hover {
        transform: translateY(-1px);
    }

    /* ===== TABLE & BADGE ===== */
    .table td { vertical-align: middle; }
    
    .badge-status {
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 12px;
    }

    /* ===== MOBILE RESPONSIVE ===== */
    @media (max-width: 768px) {
        .btn-mobile-full { width: 100%; text-align: center; }
        .table td, .table th { font-size: 13px; }
    }
</style>

<div class="container-fluid">

            @if(!auth()->user()->hasRole('user'))
                <a href="{{ route('barang-sewa.create') }}" class="btn btn-warning btn-pro btn-mobile">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Item
                </a>
            @endif
        </div>

    <form method="GET" action="{{ route('barang-sewa.index') }}">
        <div class="card filter-card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    {{-- Search --}}
                    <div class="col-lg-12">
                        <label class="form-label small fw-bold">Cari Item</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fa-solid fa-magnifying-glass text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" 
                                   placeholder="Cari kode atau nama barang..." value="{{ request('search') }}">
                        </div>
                    </div>

                    {{-- Dropdown Filters --}}
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small fw-bold">Ruangan</label>
                        <select name="ruang" class="form-select">
                            <option value="">Semua Ruangan</option>
                            @foreach($ruangs as $r)
                                <option value="{{ $r->id }}" {{ request('ruang') == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama_ruang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <label class="form-label small fw-bold">PIC</label>
                        <select name="pic" class="form-select">
                            <option value="">Semua PIC</option>
                            @foreach($pics as $p)
                                <option value="{{ $p->id }}" {{ request('pic') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_pic }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <label class="form-label small fw-bold">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <label class="form-label small fw-bold">Rentang Tahun</label>
                        <div class="input-group">
                            <input type="number" name="tahun_awal" class="form-control" 
                                   value="{{ request('tahun_awal', date('Y') - 4) }}">
                            <span class="input-group-text"> s/d </span>
                            <input type="number" name="tahun_akhir" class="form-control" 
                                   value="{{ request('tahun_akhir', date('Y')) }}">
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="col-lg-2 col-md-12 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary btn-pro w-100">
                            <i class="fa-solid fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('barang-sewa.index') }}" class="btn btn-secondary btn-pro w-100">
                            <i class="fa-solid fa-rotate-left"></i> Reset
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="card custom-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="text-center small text-uppercase fw-bold text-muted">
                        <th width="100">Kode</th>
                        <th class="text-start">Nama Item</th>
                        <th class="d-none d-md-table-cell">PIC</th>
                        <th class="d-none d-md-table-cell">Lokasi</th>
                        <th>Tahun</th>
                        <th>Kondisi</th>
                        <th>QR Code</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $d)
                        <tr>
                            <td class="text-center">
                                <span class="badge bg-dark">{{ $d->kode_barang }}</span>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $d->nama_barang }}</div>
                                <div class="small text-muted d-md-none">
                                    {{ $d->ruang->nama_ruang ?? '-' }} | {{ $d->pic->nama_pic ?? '-' }}
                                </div>
                                <div class="small text-primary d-none d-md-block">{{ $d->fungsi ?? '-' }}</div>
                            </td>
                            <td class="d-none d-md-table-cell text-center">{{ $d->pic->nama_pic ?? '-' }}</td>
                            <td class="d-none d-md-table-cell text-center">{{ $d->ruang->nama_ruang ?? '-' }}</td>
                            <td class="text-center fw-semibold">{{ $d->tahun }}</td>
                            <td class="text-center">
                                @if($d->kondisi == 'Baik')
                                    <span class="badge bg-success badge-status">Baik</span>
                                @elseif($d->kondisi == 'Perlu Perbaikan')
                                    <span class="badge bg-warning text-dark badge-status">Perlu Perbaikan</span>
                                @else
                                    <span class="badge bg-danger badge-status">Rusak</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="bg-light p-1 d-inline-block border rounded">
                                    {!! QrCode::size(45)->generate($d->kode_barang) !!}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('barang-sewa.show', $d->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('barang-sewa.edit', $d->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('barang-sewa.destroy', $d->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus barang ini?')" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $d)
                            <tr>
                                <td>
                                    <span class="badge bg-dark">{{ $d->kode_barang }}</span>
                                </td>

                                <td>{{ $d->pic->nama_pic ?? '-' }}</td>
                                <td>{{ $d->fungsi ?? '-' }}</td>
                                <td>{{ $d->nama_barang }}</td>
                                <td>{{ $d->ruang->nama_ruang ?? '-' }}</td>
                                <td class="fw-semibold">{{ $d->tahun }}</td>

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
                                <td class="text-center">
                                    <div class="aksi-group">

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
                                    <i class="fa-solid fa-box-open fa-2x mb-2 d-block"></i>
                                    Data Item sewa belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                @endforelse
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="small text-muted">
            Menampilkan {{ $data->firstItem() }} sampai {{ $data->lastItem() }} dari {{ $data->total() }} data
        </div>
        <div>
            {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>

@endsection