@extends('layouts.dashboard')

@section('title', 'Master Data')

@section('content')
<div class="container">

    <h2>Master Kelompok Barang</h2>

    <a href="{{ route('kelompok.create') }}" class="btn btn-primary mb-3">
        + Tambah Kelompok
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Kode</th>
            <th>Nama Kelompok</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach($kelompoks as $k)
        <tr>
            <td>{{ $k->kode_kelompok }}</td>
            <td>{{ $k->nama_kelompok }}</td>
            <td>
                @if($k->is_active)
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Nonaktif</span>
                @endif
            </td>
            <td>
                <a href="{{ route('kelompok.show', $k->id) }}" class="btn btn-info btn-sm">
                    Detail
                </a>
                <a href="{{ route('kelompok.edit', $k->id) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('kelompok.destroy', $k->id) }}"
                      method="POST"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus kelompok ini?')"
                            class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $kelompoks->links() }}

</div>
@endsection
