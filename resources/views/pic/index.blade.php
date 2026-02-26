@extends('layouts.dashboard')

@section('title', 'Data PIC')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <a href="{{ route('pic.create') }}" class="btn btn-primary mb-3">
            + Tambah PIC
        </a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pics as $p)
                <tr>
                    <td>{{ $p->nama_pic }}</td>
                    <td>{{ $p->divisi->nama_divisi }}</td>
                    <td>{{ $p->jabatan }}</td>
                    <td>
                        {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
                    </td>
                    <td>
                        <a href="{{ route('pic.edit', $p->id) }}" 
                           class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('pic.destroy', $p->id) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin hapus PIC ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection