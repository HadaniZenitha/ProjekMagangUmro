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

        /* ===== TABLE ===== */
        .table td {
            vertical-align: middle;
        }

        /* ===== AKSI BUTTON ===== */
        .aksi-group {
            display: flex;
            justify-content: center;
            gap: 6px;
            flex-wrap: wrap;
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

            @if(!auth()->user()->hasRole('user'))
                <a href="{{ route('barang-sewa.create') }}" class="btn btn-warning btn-pro btn-mobile">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Item
                </a>
            @endif
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

                    {{-- SEARCH --}}
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
                    </div>

                    {{-- FILTER --}}
                    <div class="row g-3 mt-2 align-items-end">

                        {{-- RUANG --}}
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

                        {{-- PIC --}}
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

                        {{-- STATUS --}}
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label small fw-semibold mb-1">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>

                        {{-- TAHUN --}}
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

                        {{-- BUTTON --}}
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
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light text-center">
                        <tr class="small text-uppercase text-muted">
                            <th>Kode</th>
                            <th>PIC</th>
                            <th>Fungsi</th>
                            <th>Nama Item</th>
                            <th>Lokasi</th>
                            <th>Tahun</th>
                            <th>Kondisi</th>
                            <th width="130">Aksi</th>
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

                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-3">
            {{ $data->links('pagination::bootstrap-5') }}
        </div>

    </div>

@endsection