@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Master Divisi</h2>

    <a href="{{ route('divisi.create') }}" class="btn btn-primary mb-3">
        + Tambah Divisi
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Divisi</th>
                <th>Status</th>
                <th width="200">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($divisis as $d)
            <tr>
                <td>{{ $d->kode_divisi }}</td>
                <td>{{ $d->nama_divisi }}</td>
                <td>
                    @if($d->is_active)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-danger">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('divisi.show', $d->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('divisi.edit', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('divisi.destroy', $d->id) }}"
                          method="POST"
                          style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus divisi ini?')" class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
