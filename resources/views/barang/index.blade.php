@extends('layouts.dashboard')

@section('title', 'Data Barang Inventaris')

@section('content')

<a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">
    + Tambah Barang
</a>

<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalImport">
        <i class="fas fa-file-excel"></i> Import Excel
</button>

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-bordered">
            <tr>
                <th>Kode</th>
                <th>PIC Penanggung Jawab</th>
                <th>Nama Barang</th>
                <th>Lokasi</th>
                <th>Tahun</th>
                <th>Kondisi</th>
                <th>QR Code</th>
                <th>Aksi</th>
            </tr>

            @foreach($barangs as $b)
            <tr>
                <td>{{ $b->kode_barang }}</td>
                <td>{{ $b->pic->nama_pic ?? '-'}}</td>
                <td>{{ $b->nama_barang }}</td>
                <td>{{ $b->ruang->nama_ruang }}</td>
                <td>{{ $b->tahun_perolehan }}</td>
                <td>{{ $b->keterangan }}</td>
                <td>
                    {!! QrCode::size(80)->generate($b->kode_barang) !!}
                </td>
                <td>
                    <a href="{{ route('barang.show', $b->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('barang.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('barang.destroy', $b->id) }}"
                      method="POST"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus barang ini?')"
                            class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
                </td>
            </tr>
            @endforeach
        </table>

    </div>
</div>

<!-- Modal Import Excel -->
<div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="modalImportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalImportLabel">Import Data Barang dari Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('barang.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file_excel" class="form-label">Pilih File Excel</label>
                        <input type="file" class="form-control" id="file_excel" name="file_excel" accept=".xlsx,.xls,.csv" required>
                        <small class="text-muted">Format: .xlsx, .xls, atau .csv</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
