@extends('layouts.dashboard')

@section('title', 'Master Ruang')

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

/* ===== BUTTON CLEAN ===== */
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
</style>

<!-- ===== BAGIAN YANG DIPERBAIKI ===== -->
<div class="mb-3 d-flex flex-md-row flex-column align-items-md-center">
    
    <h5 class="fw-semibold mb-2 mb-md-0">
        Master Ruang
    </h5>

    <a href="{{ route('ruangs.create') }}" 
       class="btn btn-warning btn-clean btn-mobile-full ms-md-auto mt-2 mt-md-0">
        <i class="fa-solid fa-plus me-1"></i> Tambah Ruang
    </a>

</div>
<!-- ===== END PERBAIKAN ===== -->

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="custom-card">

    <div class="table-responsive">
        <table class="table align-middle table-bordered">

                <thead class="table-light text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Gedung</th>
                        <th>Lantai</th>
                        <th>Jenis Ruangan</th>
                        <th>Nama Ruangan</th>
                        <th>Penanggung Jawab</th>
                        <th>Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($ruangs as $r)
                    <tr>
                        <td>{{ $loop->iteration + ($ruangs->currentPage() - 1) * $ruangs->perPage() }}</td>
                        <td>{{ $r->kode_ruang }}</td>
                        <td>{{ $r->lantai->gedung->nama_gedung ?? '-' }}</td>
                        <td>{{ $r->lantai->kode_lantai ?? '-' }}</td>
                        <td>{{ $r->jenisRuangan->nama_jenis_ruangan ?? '-' }}</td>
                        <td>{{ $r->nama_ruang }}</td>
                        <td>
                                @if($r->pic)
                                    <span class="badge bg-primary">
                                        {{ $r->pic->nama_pic }}
                                    </span>
                                    @if($r->pic->jabatan)
                                        <br><small class="text-muted">{{ $r->pic->jabatan }}</small>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">Tidak Ada PIC Default</span>
                                @endif
                        </td>
                        <td class="text-center">
                            @if($r->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2 flex-nowrap">

                            <a href="{{ route('ruangs.show', $r->id) }}"
                               class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('ruangs.edit', $r->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('ruangs.destroy', $r->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus ruang ini?')">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-3">
                            Belum ada data ruang yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
       <div class="mt-3">
            {{ $ruangs->links('pagination::bootstrap-5') }}
        </div>

</div>

@endsection