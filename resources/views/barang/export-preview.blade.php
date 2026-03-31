@extends('layouts.dashboard')

@section('title', 'Preview Excel Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Preview Data Barang untuk Export Excel</h5>
    <div>
        <a href="{{ route('barang.exportExcel', request()->query()) }}" class="btn btn-success">
            <i class="fas fa-download"></i> Download Excel
        </a>
        <a href="{{ route('barang.index', request()->query()) }}" class="btn btn-secondary">
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
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Divisi</th>
                        <th>Ruang</th>
                        <th>PIC</th>
                        <th>Tahun Perolehan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $barang)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->divisi->nama_divisi ?? '-' }}</td>
                        <td>{{ $barang->ruang->nama_ruang ?? '-' }}</td>
                        <td>{{ $barang->pic->nama_pic ?? '-' }}</td>
                        <td class="text-center">{{ $barang->tahun_perolehan }}</td>
                        <td>
                            <span class="badge {{ $barang->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $barang->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center">Tidak ada data barang</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection