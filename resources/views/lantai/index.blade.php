@extends('layouts.dashboard')

@section('page-title', 'Master Data Lantai')

@section('content')

<a href="{{ route('lantai.create') }}" class="btn btn-primary mb-3">
    + Tambah Lantai
</a>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Gedung</th>
            <th>Kode Lantai</th>
            <th>Nama Lantai</th>
            <th>Status</th>
            <th width="220">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lantais as $l)
        <tr>
            <td>{{ $l->gedung->nama_gedung }}</td>
            <td>{{ $l->kode_lantai }}</td>
            <td>{{ $l->nama_lantai ?? '-' }}</td>
            <td>
                @if($l->is_active)
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Nonaktif</span>
                @endif
            </td>
            <td>
                <a href="{{ route('lantai.show', $l->id) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('lantai.edit', $l->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('lantai.destroy', $l->id) }}"
                      method="POST"
                      style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus lantai ini?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
