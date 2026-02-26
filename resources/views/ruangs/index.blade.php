@extends('layouts.dashboard')

@section('page-title', 'Master Ruang')

@section('title', 'Data Ruang')

@section('content')

<a href="{{ route('ruangs.create') }}" class="btn btn-primary mb-3">
    + Tambah Ruang
</a>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Kode</th>
            <th>Gedung</th>
            <th>Lantai</th>
            <th>Jenis</th>
            <th>Nama</th>
            <th>Status</th>
            <th width="200">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ruangs as $r)
        <tr>
            <td>{{ $r->kode_ruang }}</td>
            <td>{{ $r->lantai->gedung->nama_gedung }}</td>
            <td>{{ $r->lantai->kode_lantai }}</td>
            <td>{{ $r->jenisRuangan->nama_jenis_ruangan }}</td>
            <td>{{ $r->nama_ruang }}</td>
            <td>
                @if($r->is_active)
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Nonaktif</span>
                @endif
            </td>
            <td>
                <a href="{{ route('ruangs.edit', $r->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('ruangs.destroy', $r->id) }}"
                      method="POST"
                      style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus ruang?')"
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