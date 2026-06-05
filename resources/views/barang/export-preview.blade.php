@extends('layouts.dashboard')

@section('title', 'Preview Excel Item Inventarisasi')

@section('content')

<style>
/* ===== BUTTON FIX ===== */
.btn-wrapper-fix{
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.btn-custom-fix{
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;

    width: 100%;
    padding: 12px;

    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;

    text-decoration: none;
}

/* warna */
.btn-green-fix{
    background: #198754;
    color: #fff;
}

.btn-gray-fix{
    background: #6c757d;
    color: #fff;
}

/* desktop */
@media (min-width:768px){
    .header-box{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-wrapper-fix{
        flex-direction: row;
        justify-content: flex-end;
    }

    .btn-custom-fix{
        width: auto;
        padding: 10px 18px;
    }
}
</style>

<div class="header-box mb-4">

    <h5 class="fw-bold mb-2">
        Preview item Inventarisasi
    </h5>

    <div class="btn-wrapper-fix">

        <a href="{{ route('barang.exportExcel', request()->query()) }}"
           class="btn-custom-fix btn-green-fix">
            <i class="fas fa-download"></i> Download Excel
        </a>

        <a href="{{ route('barang.index', request()->query()) }}"
           class="btn-custom-fix btn-gray-fix">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

    </div>

</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Kode Item</th>
                        <th>Nama Item</th>
                        <th>Fungsi</th>
                        <th>Ruang</th>
                        <th>PIC</th>
                        <th>Tahun Perolehan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $barang)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td  class="text-center">{{ $barang->divisi->nama_divisi ?? '-' }}</td>
                        <td class="text-center">{{ $barang->ruang->nama_ruang ?? '-' }}</td>
                        <td>{{ $barang->pic->nama_pic ?? '-' }}</td>
                        <td class="text-center">{{ $barang->tahun_perolehan }}</td>
                        <td class="text-center">
                            <span class="badge {{ $barang->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $barang->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data Item</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection