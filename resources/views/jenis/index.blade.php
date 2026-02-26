@extends('layouts.dashboard')

@section('title', 'Master Data')

@section('content')
<div class="container">

    <h2>Master Jenis Barang</h2>

    <a href="{{ route('jenis.create') }}" class="btn btn-primary mb-3">
        + Tambah Jenis
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Kode</th>
            <th>Nama Jenis</th>
            <th>Kelompok</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach($jenis as $j)
        <tr>
            <td>{{ $j->kode_jenis }}</td>
            <td>{{ $j->nama_jenis }}</td>
            <td>{{ $j->kelompok->nama_kelompok }}</td>
            <td>
                @if($j->is_active)
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Nonaktif</span>
                @endif
            </td>
            <td>
                <a href="{{ route('jenis.show', $j->id) }}" class="btn btn-info btn-sm">
                    Detail
                </a>
                <a href="{{ route('jenis.edit', $j->id) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('jenis.destroy', $j->id) }}"
                      method="POST"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus jenis ini?')"
                            class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $jenis->links() }}

</div>
@endsection
