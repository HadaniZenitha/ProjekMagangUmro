@extends('layouts.dashboard')

@section('title', 'Master Kelompok Barang')

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

/* ===== BUTTON CLEAN (KECIL & RAPI) ===== */
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
        Master Kelompok Barang
    </h5>

    <a href="{{ route('kelompok.create') }}" 
       class="btn btn-warning btn-clean btn-mobile-full ms-md-auto mt-2 mt-md-0">
        <i class="fa-solid fa-plus me-1"></i> Tambah Kelompok
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
                    <th>Kode</th>
                    <th>Nama Kelompok</th>
                    <th>Status</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kelompoks as $k)
                <tr>

                    <td>{{ $k->kode_kelompok }}</td>

                    <td>{{ $k->nama_kelompok }}</td>

                    <td class="text-center">
                        @if($k->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </td>

                    <td class="text-center d-flex justify-content-center gap-2">
                        <a href="{{ route('kelompok.show', $k->id) }}"
                           class="btn btn-info btn-sm">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        <a href="{{ route('kelompok.edit', $k->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        <form action="{{ route('kelompok.destroy', $k->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Hapus kelompok ini?')"
                                    class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-3">
                        Belum ada data kelompok barang.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $kelompoks->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection