@extends('layouts.dashboard')

@section('title', 'Master Fungsi')

@section('content')

<style>
/* ===== CARD STYLE (SaaS CLEAN) ===== */
.custom-card{
    border-radius:14px;
    background:#ffffff;
    padding:20px;
    border:1px solid #eaeaea;
    box-shadow:0 4px 12px rgba(0,0,0,0.04);
}

/* ===== BUTTON CLEAN (Kecil & Elegan) ===== */
.btn-clean{
    border-radius:8px;
    font-weight:500;
    font-size:14px;
    padding:6px 12px;
    box-shadow:none;
    transition:all 0.2s ease;
}

/* WARNA LEBIH SOFT */
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

/* FULL WIDTH MOBILE */
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
        Master Fungsi
    </h5>

    <a href="{{ route('divisi.create') }}" 
       class="btn btn-warning btn-clean btn-mobile-full ms-md-auto mt-2 mt-md-0">
        <i class="fa-solid fa-plus me-1"></i> Tambah Fungsi
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
                    <th>Nama Fungsi</th>
                    <th>Status</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($divisis as $d)
                <tr>
                    <td>{{ $d->kode_divisi }}</td>
                    <td>{{ $d->nama_divisi }}</td>

                    <td class="text-center">
                        @if($d->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </td>

                    <td class="text-center d-flex justify-content-center gap-2">
                        <a href="{{ route('divisi.show', $d->id) }}" class="btn btn-info btn-sm">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        <a href="{{ route('divisi.edit', $d->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        <form action="{{ route('divisi.destroy', $d->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus divisi ini?')" 
                                    class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-3">
                        Belum ada data fungsi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $divisis->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection