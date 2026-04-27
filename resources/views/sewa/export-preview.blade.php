@extends('layouts.dashboard')

@section('title', 'Preview Excel Item Sewa')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Preview Data Item Sewa untuk Export Excel</h5>
    <div>
        <a href="{{ route('barang-sewa.exportExcel', request()->query()) }}" class="btn btn-success">
            <i class="fas fa-download"></i> Download Excel
        </a>
        <a href="{{ route('barang-sewa.index', request()->query()) }}" class="btn btn-secondary">
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