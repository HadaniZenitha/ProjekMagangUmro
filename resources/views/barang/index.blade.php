@extends('layouts.dashboard')

@section('title', 'Data Barang Inventaris')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Data Barang Inventaris</h5>
    <a href="{{ route('barang.create') }}" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Tambah Barang
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="table-responsive">
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
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection