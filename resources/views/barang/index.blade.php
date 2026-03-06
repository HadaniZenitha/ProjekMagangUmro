@extends('layouts.dashboard')

@section('page-title', 'Data Barang Inventaris')
@section('title', 'Data Barang Inventaris')

@section('content')

<<<<<<< HEAD
<div class="container">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Data Barang Inventaris</h4>

    <a href="{{ route('barang.create') }}" 
       class="btn btn-primary shadow-sm">
        <i class="fa-solid fa-plus me-2"></i> Tambah Barang
    </a>
=======
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Data Barang Inventaris</h5>
    <a href="{{ route('barang.create') }}" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Tambah Barang
    </a>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalImport">
        <i class="fas fa-file-excel"></i> Import Excel
    </button>
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalImport">
        <i class="fas fa-file-excel"></i> Import Excel
    </button>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="table-responsive">
<<<<<<< HEAD
            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light text-center">
                    <tr>
                        <th>Kode</th>
                        <th>PIC</th>
                        <th>Nama Barang</th>
                        <th>Lokasi</th>
                        <th>Tahun</th>
                        <th>Kondisi</th>
                        <th>QR Code</th>
                        <th width="230">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($barangs as $b)
                    <tr>

                        <td>{{ $b->kode_barang }}</td>

                        <td>
                            @if($b->pic)
                                {{ $b->pic->nama_pic }}
                            @else
                                <span class="text-muted">
                                    <i class="fa-solid fa-circle-chevron-down me-1"></i>
                                    Belum dipilih
                                </span>
                            @endif
                        </td>

                        <td>{{ $b->nama_barang }}</td>

                        <td>{{ $b->ruang->nama_ruang ?? '-' }}</td>

                        <td>{{ $b->tahun_perolehan }}</td>

                        <td class="text-center">

                            @if($b->keterangan == 'Baik')
                                <span class="badge bg-success">
                                    <i class="fa-solid fa-circle-check me-1"></i> Baik
                                </span>

                            @elseif($b->keterangan == 'Perlu Perbaikan')
                                <span class="badge bg-warning text-dark">
                                    <i class="fa-solid fa-screwdriver-wrench me-1"></i> Perlu Perbaikan
                                </span>

                            @elseif($b->keterangan == 'Rusak')
                                <span class="badge bg-danger">
                                    <i class="fa-solid fa-circle-xmark me-1"></i> Rusak
                                </span>

                            @else
                                <span class="badge bg-secondary">
                                    {{ $b->keterangan }}
                                </span>
                            @endif

                        </td>

                        <td class="text-center">
                            {!! QrCode::size(80)->generate($b->kode_barang) !!}
                        </td>

                        <td class="text-center">

                            <a href="{{ route('barang.show', $b->id) }}" 
                               class="btn btn-info btn-sm text-white">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('barang.edit', $b->id) }}" 
                               class="btn btn-warning btn-sm text-dark">
=======
            <table class="table align-middle table-bordered">
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
                    @foreach($barangs as $b)
                    <tr>
                        <td>
                            <span class="badge bg-dark">
                                {{ $b->kode_barang }}
                            </span>
                        </td>
                        <td>{{ $b->pic->nama_pic ?? '-' }}</td>
                        <td>{{ $b->nama_barang }}</td>
                        <td>{{ $b->ruang->nama_ruang }}</td>
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
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('barang.destroy', $b->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
<<<<<<< HEAD

                                <button onclick="return confirm('Hapus barang ini?')"
=======
                                <button onclick="return confirm('Hapus barang ini?')" 
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
<<<<<<< HEAD

                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-3">
                            Belum ada data barang.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <!-- INFO DATA + PAGINATION -->
        <div class="d-flex flex-column align-items-center mt-3">

            <div class="text-muted mb-2">
                Menampilkan {{ $barangs->firstItem() }} - {{ $barangs->lastItem() }}
                dari {{ $barangs->total() }} data
            </div>

            <div>
                {{ $barangs->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>
</div>


</div>

=======
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
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
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
@endsection
