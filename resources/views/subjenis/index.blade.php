@extends('layouts.dashboard')

<<<<<<< HEAD
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

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th width="120">Kode</th>
                        <th>Nama Sub Jenis</th>
                        <th>Jenis Barang</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($subjenis as $s)
                    <tr>
                        <td class="text-center">{{ $s->kode_subjenis }}</td>
                        <td>{{ $s->nama_subjenis }}</td>
                        <td>{{ $s->jenis->nama_jenis ?? '-' }}</td>

                        <td class="text-center">

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
                                  class="d-inline">
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
        </div>

        <!-- Info data + Pagination -->
        <div class="d-flex flex-column align-items-center mt-3">

            <div class="text-muted mb-2">
                Menampilkan {{ $subjenis->firstItem() }} - {{ $subjenis->lastItem() }}
                dari {{ $subjenis->total() }} data
            </div>

            <div>
                {{ $subjenis->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>
</div>

=======
@section('title', 'Master Sub Jenis Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Master Sub Jenis Barang</h5>
    <a href="{{ route('subjenis.create') }}" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Tambah Sub Jenis
    </a>
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table align-middle table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Sub Jenis</th>
                        <th>Jenis Barang</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjenis as $s)
                    <tr>
                        <td>{{ $s->kode_subjenis }}</td>
                        <td>{{ $s->nama_subjenis }}</td>
                        <td>{{ $s->jenis->nama_jenis }}</td>
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
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus sub jenis ini?')"
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $subjenis->links() }}
        </div>

    </div>
</div>

@endsection