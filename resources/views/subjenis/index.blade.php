@extends('layouts.dashboard')

@section('title', 'Master Data')

@section('content')
<div class="container">

    <h2>Master Sub Jenis Barang</h2>

    <a href="{{ route('subjenis.create') }}" class="btn btn-primary mb-3">
        + Tambah Sub Jenis
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Kode</th>
            <th>Nama Sub Jenis</th>
            <th>Jenis Barang</th>
            <th>Aksi</th>
        </tr>

        @foreach($subjenis as $s)
        <tr>
            <td>{{ $s->kode_subjenis }}</td>
            <td>{{ $s->nama_subjenis }}</td>
            <td>{{ $s->jenis->nama_jenis }}</td>
            <td>
                <a href="{{ route('subjenis.edit', $s->id) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>
                
                <a href="{{ route('subjenis.show', $s->id) }}"
                    class="btn btn-info btn-sm">
                    Detail
                </a>

                <form action="{{ route('subjenis.destroy', $s->id) }}"
                      method="POST"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus sub jenis ini?')"
                            class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $subjenis->links() }}

</div>
@endsection
