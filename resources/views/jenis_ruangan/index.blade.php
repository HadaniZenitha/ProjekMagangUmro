@extends('layouts.dashboard')

@section('page-title', 'Master Jenis Ruangan')

@section('title', 'Data Jenis Ruangan')

@section('content')

<a href="{{ route('jenis-ruangan.create') }}" class="btn btn-primary mb-3">
    + Tambah Jenis Ruangan
</a>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Kode</th>
            <th>Nama Jenis Ruangan</th>
            <th>Status</th>
            <th width="220">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jenisRuangans as $j)
        <tr>
            <td>{{ $j->kode_jenis_ruangan }}</td>
            <td>{{ $j->nama_jenis_ruangan }}</td>
            <td>
                @if($j->is_active)
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Nonaktif</span>
                @endif
            </td>
            <td>
                <a href="{{ route('jenis-ruangan.show', $j->id) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('jenis-ruangan.edit', $j->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('jenis-ruangan.destroy', $j->id) }}"
                      method="POST"
                      style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus jenis ruangan ini?')"
                            class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection