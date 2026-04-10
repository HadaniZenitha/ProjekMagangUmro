@extends('layouts.dashboard')

@section('title', 'Master Karyawan')

@section('content')

<style>
/* ===== CARD CLEAN ===== */
.custom-card{
    border-radius:14px;
    background:#ffffff;
    padding:20px;
    border:1px solid #eaeaea;
    box-shadow:0 4px 12px rgba(0,0,0,0.04);
}

/* ===== BUTTON CLEAN (KECIL & ELEGAN) ===== */
.btn-clean{
    border-radius:8px;
    font-weight:500;
    font-size:14px;
    padding:6px 12px;
    box-shadow:none;
    transition:all 0.2s ease;
}

/* WARNA SOFT */
.btn-warning.btn-clean{
    background-color:#facc15;
    border:none;
    color:#000;
}

/* HOVER HALUS */
.btn-clean:hover{
    transform:translateY(-1px);
    background-color:#fbbf24;
}

/* MOBILE */
@media (max-width: 768px){
    .btn-mobile-full{
        width:100%;
        text-align:center;
    }
}

.pic-toolbar .search-form {
    width: 100%;
}

.pic-toolbar .search-input {
    min-width: 0;
}

@media (min-width: 768px){
    .pic-toolbar .search-form {
        width: auto;
    }

    .pic-toolbar .search-input {
        width: 320px;
    }
}
</style>

<!-- ===== BAGIAN YANG DIPERBAIKI ===== -->
<div class="mb-3 d-flex flex-md-row flex-column align-items-md-center gap-2 pic-toolbar">
    <form action="{{ route('pic.index') }}" method="GET" class="d-flex flex-column flex-md-row gap-2 mb-2 mb-md-0 search-form">
        <input
            type="text"
            name="search"
            class="form-control search-input"
            placeholder="Search "
            value="{{ request('search') }}"
        >
        <button type="submit" class="btn btn-primary btn-clean">
            <i class="fa-solid fa-magnifying-glass me-1"></i> Cari
        </button>
        @if(request('search'))
            <a href="{{ route('pic.index') }}" class="btn btn-secondary btn-clean">Reset</a>
        @endif
    </form>

    <div class="d-flex gap-2 ms-md-auto mt-2 mt-md-0 flex-column flex-md-row">
        <button class="btn btn-success btn-clean btn-mobile-full" data-bs-toggle="modal" data-bs-target="#modalImportPic">
            <i class="fas fa-file-excel me-1"></i> Import Excel
        </button>

        <a href="{{ route('pic.create') }}" 
           class="btn btn-warning btn-clean btn-mobile-full">
            <i class="fa-solid fa-plus me-1"></i> Tambah Karyawan
        </a>
    </div>

</div>
<!-- ===== END PERBAIKAN ===== -->

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('warning'))
<div class="alert alert-warning alert-dismissible fade show">
    <strong>{{ session('warning') }}</strong>

    @if(session('import_errors'))
        <button class="btn btn-sm btn-outline-dark mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#errorDetailsPic">
            <i class="fas fa-eye"></i> Lihat Detail Error
        </button>

        <div class="collapse mt-3" id="errorDetailsPic">
            <div class="table-responsive">
                <table class="table table-sm table-bordered mb-0">
                    <thead>
                        <tr>
                            <th width="80">Baris</th>
                            <th>NID</th>
                            <th>Alasan Gagal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('import_errors') as $error)
                        <tr>
                            <td class="text-center">{{ $error['row'] }}</td>
                            <td>{{ $error['nid'] }}</td>
                            <td><small class="text-danger">{{ $error['reason'] }}</small></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="custom-card">

    <div class="table-responsive">
        <table class="table align-middle table-bordered">
            <thead class="table-light text-center">
                <tr>
                    <th width="70">No</th>
                    <th>NID</th>
                    <th>Nama</th>
                    <th>Fungsi</th>
                    <!-- <th>Jabatan</th> -->
                    <th>Jabatan Lengkap</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" width="220">Aksi</th>
                </tr>
            </thead>
    
            <tbody>
                @forelse($pics as $p)
                <tr>
                    <td class="text-center">{{ $pics->firstItem() + $loop->index }}</td>
                    <td>{{ $p->nid_pic }}</td>
                    <td>{{ $p->nama_pic }}</td>
                    <td>{{ $p->divisi->nama_divisi ?? '-' }}</td>
                    {{-- <td>{{ $p->jabatan }}</td> --}}
                    <td>{{ $p->jabatan_lengkap ?? '-' }}</td>

                    <td class="text-center">
                        @if($p->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </td>

                    <td class="text-center d-flex justify-content-center gap-2">
                        <a href="{{ route('pic.edit', $p->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        <form action="{{ route('pic.destroy', $p->id) }}" 
                              method="POST" 
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Hapus karyawan ini?')" 
                                    class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-3">
                        Belum ada data karyawan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $pics->links('pagination::bootstrap-5') }}
    </div>

</div>

<div class="modal fade" id="modalImportPic" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-file-excel me-2"></i>
                    Import Data PIC dari Excel
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('pic.import') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih File Excel</label>
                        <input type="file" class="form-control" name="file_excel" accept=".xlsx,.xls,.csv" required>
                        <small class="text-muted">
                            Header wajib: NID, NAMA_LENGKAP, BIDANG, JABATAN_LENGKAP
                        </small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success btn-clean">
                        <i class="fas fa-upload"></i> Import Data
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection