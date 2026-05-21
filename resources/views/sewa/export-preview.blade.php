@extends('layouts.dashboard')

@section('title', 'Preview Excel Item Sewa')

@section('content')

<style>
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

    text-decoration: none;
}

.btn-green-fix{
    background: #198754;
    color: #fff;
}

.btn-gray-fix{
    background: #6c757d;
    color: #fff;
}

@media (min-width:768px){
    .btn-wrapper-fix{
        flex-direction: row;
        justify-content: flex-end;
    }

    .btn-custom-fix{
        width: auto;
    }
}
</style>

<div class="mb-4">

    <h5 class="fw-bold mb-2">
        Preview Item Sewa
    </h5>

    <div class="btn-wrapper-fix">

        <a href="{{ route('barang-sewa.exportExcel', request()->query()) }}"
           class="btn-custom-fix btn-green-fix">
            <i class="fas fa-download"></i> Download Excel
        </a>

        <a href="{{ route('barang-sewa.index', request()->query()) }}"
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
                        <th>Kode</th>
                        <th>PIC</th>
                        <th>Fungsi</th>
                        <th>Nama Item</th>
                        <th>Lokasi</th>
                        <th>Tahun</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $index => $d)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $d->kode_barang }}</td>
                        <td>{{ $d->pic->nama_pic ?? '-' }}</td>
                        <td>{{ $d->divisi->nama_divisi ?? '-' }}</td>
                        <td>{{ $d->nama_barang }}</td>
                        <td>{{ $d->ruang->nama_ruang ?? '-' }}</td>
                        <td class="text-center">{{ $d->tahun }}</td>

                        <td class="text-center">
                            @if($d->kondisi == 'Baik')
                                <span class="badge bg-success">Baik</span>
                            @elseif($d->kondisi == 'Perlu Perbaikan')
                                <span class="badge bg-warning text-dark">Perlu Perbaikan</span>
                            @else
                                <span class="badge bg-danger">Rusak</span>
                            @endif
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            Tidak ada data Item Sewa
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection