@extends('layouts.dashboard')

@section('content')
<div class="container">

    <h2 class="mb-3">Master Sub Jenis Barang</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('subjenis.create') }}" 
           class="btn btn-primary shadow-sm">
            <i class="fa-solid fa-plus me-2"></i> Tambah Sub Jenis
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Sub Jenis</th>
                        <th>Jenis Barang</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjenis as $s)
                    <tr>
                        <td>{{ $s->kode_subjenis }}</td>
                        <td>{{ $s->nama_subjenis }}</td>
                        <td>{{ $s->jenis->nama_jenis ?? '-' }}</td>
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
                                  style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus sub jenis ini?')"
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-3 text-muted">
                            Belum ada data sub jenis barang yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $subjenis->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
@endsection