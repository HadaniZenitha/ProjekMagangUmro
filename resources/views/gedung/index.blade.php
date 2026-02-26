@extends('layouts.dashboard')

@section('title', 'Master Gedung')
@section('page-title', 'Master Data Gedung')

@section('content')

<a href="{{ route('gedung.create') }}" class="btn btn-primary mb-3">
    + Tambah Gedung
</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Kode</th>
            <th>Nama Gedung</th>
            <th>Status</th>
            <th width="220">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($gedungs as $g)
        <tr>
            <td>{{ $g->kode_gedung }}</td>
            <td>{{ $g->nama_gedung }}</td>
            <td>
                @if($g->is_active)
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Nonaktif</span>
                @endif
            </td>
            <td>
                <a href="{{ route('gedung.show', $g->id) }}"
                   class="btn btn-info btn-sm">Detail</a>

                <a href="{{ route('gedung.edit', $g->id) }}"
                   class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('gedung.destroy', $g->id) }}"
                      method="POST"
                      style="display:inline-block">
                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Hapus gedung ini?')"
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
