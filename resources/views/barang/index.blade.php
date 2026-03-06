@extends('layouts.dashboard')

@section('page-title', 'Data Barang Inventaris')
@section('title', 'Data Barang Inventaris')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Data Barang Inventaris</h5>

    <div class="d-flex gap-2">
        <a href="{{ route('barang.create') }}" class="btn btn-warning">
            <i class="fa-solid fa-plus"></i> Tambah Barang
        </a>

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalImport">
            <i class="fas fa-file-excel"></i> Import Excel
        </button>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif


<div class="card shadow-sm border-0">

    <div class="table-responsive">
        <table class="table align-middle table-bordered mb-0">

            <thead class="table-light">
                <tr>
                    <th>Kode</th>
                    <th>PIC</th>
                    <th>Nama Barang</th>
                    <th>Lokasi</th>
                    <th>Tahun</th>
                    <th>Kondisi</th>
                    <th>QR Code</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($barangs as $b)
            <tr>

                <td>
                    <span class="badge bg-dark">
                        {{ $b->kode_barang }}
                    </span>
                </td>

                <td>{{ $b->pic->nama_pic ?? '-' }}</td>

                <td>{{ $b->nama_barang }}</td>

                <td>{{ $b->ruang->nama_ruang ?? '-' }}</td>

                <td>{{ $b->tahun_perolehan }}</td>

                <td>{{ $b->keterangan ?? '-' }}</td>

                <td>
                    {!! QrCode::size(70)->generate($b->kode_barang) !!}
                </td>

                <td>

                    <a href="{{ route('barang.show', $b->id) }}"
                       class="btn btn-info btn-sm">
                        <i class="fa-solid fa-eye"></i>
                    </a>

                    <a href="{{ route('barang.edit', $b->id) }}"
                       class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pen"></i>
                    </a>

                    <form action="{{ route('barang.destroy', $b->id) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button onclick="return confirm('Hapus barang ini?')"
                                class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="8" class="text-center text-muted">
                    Data barang belum tersedia
                </td>
            </tr>

            @endforelse

            </tbody>

        </table>
    </div>

</div>


{{-- Pagination --}}
<div class="mt-3">
    {{ $barangs->links() }}
</div>


{{-- MODAL IMPORT EXCEL --}}
<div class="modal fade" id="modalImport" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Import Data Barang dari Excel
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('barang.import') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Pilih File Excel</label>

                        <input type="file"
                               class="form-control"
                               name="file_excel"
                               accept=".xlsx,.xls,.csv"
                               required>

                        <small class="text-muted">
                            Format file: .xlsx, .xls, atau .csv
                        </small>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                            class="btn btn-primary">
                        Import
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

@endsection