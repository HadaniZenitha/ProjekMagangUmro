@extends('layouts.dashboard')

@section('page-title', 'Data Item Sewa')
@section('title', 'Data Item Sewa')

@section('content')

    <div class="container-fluid">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
            <h5 class="fw-bold mb-0">Data Barang Sewa</h5>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('barang-sewa.create') }}" class="btn btn-warning btn-pro">
                    <i class="fa-solid fa-plus"></i> Tambah Barang
                </a>
            </div>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        {{-- FORM FILTER --}}
        <form method="GET" action="{{ route('barang.index') }}">
            <div class="card mb-3 shadow-sm border-0">
                <div class="card-body">

                    {{-- 🔹 ROW 1: SEARCH + EXPORT --}}
                    <div class="row g-3 align-items-end">

                        {{-- SEARCH --}}
                        <div class="col-lg-6 col-md-12">
                            <label class="form-label small fw-semibold mb-1">Cari Barang</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="fa-solid fa-magnifying-glass text-muted"></i>
                                </span>
                                <input type="text" name="search" class="form-control"
                                    placeholder="Cari kode / nama barang..." value="{{ request('search') }}">
                            </div>
                        </div>
                    </div>

                    {{-- 🔹 ROW 2: FILTER --}}
                    <div class="row g-3 mt-2 align-items-end">

                        {{-- RUANGAN --}}
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label small fw-semibold mb-1">Ruangan</label>
                            <select name="ruang" class="form-select select2">
                                <option value="">Semua Ruangan</option>
                                @foreach($ruangs as $r)
                                    <option value="{{ $r->id }}" {{ request('ruang') == $r->id ? 'selected' : '' }}>
                                        {{ $r->nama_ruang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- PIC --}}
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label small fw-semibold mb-1">PIC</label>
                            <select name="pic" class="form-select select2">
                                <option value="">Semua PIC</option>
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

                        {{-- RANGE TAHUN --}}
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label small fw-semibold mb-1">Tahun</label>
                            <div class="input-group">
                                <input type="number" name="tahun_awal" class="form-control text-center" placeholder="2020"
                                    value="{{ request('tahun_awal', date('Y') - 4) }}">

                                <span class="input-group-text bg-light fw-bold">-</span>

                                <input type="number" name="tahun_akhir" class="form-control text-center" placeholder="2025"
                                    value="{{ request('tahun_akhir', date('Y')) }}">
                            </div>
                        </div>

                        {{-- FILTER --}}
                        <div class="col-lg-auto col-md-6 d-flex">
                            <button class="btn btn-primary btn-pro px-3 w-100 w-lg-auto">
                                <i class="fa-solid fa-filter me-1"></i> Filter
                            </button>
                        </div>
                        {{-- RESET --}}
                        <div class="col-lg-auto col-md-6 d-flex">
                            <a href="{{ route('barang.index') }}" class="btn btn-secondary btn-pro w-100">
                                <i class="fa-solid fa-rotate-left me-1"></i> Reset
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        {{-- TABEL DATA --}}

        {{-- TABEL --}}
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Kode</th>
                            <th>PIC</th>
                            <th>Fungsi</th>
                            <th>Nama Barang</th>
                            <th>Lokasi</th>
                            <th>Tahun</th>
                            <th>Kondisi</th>
                            <th>QR</th>
                            <th width="120">Aksi</th>
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

                                <td>{{ $d->tahun }}</td>

                                <td>
                                    @if($d->kondisi == 'Baik')
                                        <span class="badge bg-success">Baik</span>
                                    @elseif($d->kondisi == 'Perlu Perbaikan')
                                        <span class="badge bg-warning text-dark">Perlu Perbaikan</span>
                                    @else
                                        <span class="badge bg-danger">Rusak</span>
                                    @endif
                                </td>

                                <td class="qr-box">
                                    {!! QrCode::size(60)->generate($d->kode_barang) !!}
                                </td>

                                <td class="text-center">
                                   <div class="d-flex justify-content-center flex-nowrap gap-1">

                                        {{-- LIHAT --}}
                                        <a href="{{ route('barang-sewa.show', $d->id) }}" class="btn btn-info btn-sm btn-pro">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        {{-- EDIT --}}
                                        <a href="{{ route('barang-sewa.edit', $d->id) }}"
                                            class="btn btn-warning btn-sm btn-pro">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form action="{{ route('barang-sewa.destroy', $d->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Hapus barang ini?')"
                                                class="btn btn-danger btn-sm btn-pro">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    <i class="fa-solid fa-box-open fa-2x mb-2 d-block"></i>
                                    Data barang sewa belum tersedia
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