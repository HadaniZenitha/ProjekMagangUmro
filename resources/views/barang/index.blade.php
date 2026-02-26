@extends('layouts.dashboard')

@section('title', 'Data Barang Inventaris')

@section('content')

<a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">
    + Tambah Barang
</a>

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

@endsection
