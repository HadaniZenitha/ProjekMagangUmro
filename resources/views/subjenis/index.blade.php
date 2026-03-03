@extends('layouts.dashboard')

@section('title', 'Master Sub Jenis Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Master Sub Jenis Barang</h5>
    <a href="{{ route('subjenis.create') }}" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Tambah Sub Jenis
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
                        <th>Nama Sub Jenis</th>
                        <th>Jenis Barang</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjenis as $s)
                    <tr>
                        <td>{{ $s->kode_subjenis }}</td>
                        <td>{{ $s->nama_subjenis }}</td>
                        <td>{{ $s->jenis->nama_jenis }}</td>
                        <td>
                            <a href="{{ route('subjenis.show', $s->id) }}"
                               class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('subjenis.edit', $s->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('subjenis.destroy', $s->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus sub jenis ini?')"
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

        <div class="mt-3">
            {{ $subjenis->links() }}
        </div>

    </div>
</div>

@endsection