@extends('layouts.dashboard')

<<<<<<< HEAD
=======
@section('title', 'Master Gedung')

>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
@section('content')
<div class="container">

<<<<<<< HEAD
    <h2 class="mb-3">Master Gedung</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('gedung.create') }}" 
           class="btn btn-primary shadow-sm">
            <i class="fa-solid fa-plus me-2"></i> Tambah Gedung
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
                        <th width="120">Kode</th>
                        <th>Nama Gedung</th>
                        <th width="120">Status</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($gedungs as $g)
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
                               class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('gedung.edit', $g->id) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

=======
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Master Gedung</h5>
    <a href="{{ route('gedung.create') }}" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Tambah Gedung
    </a>
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
                               class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('gedung.edit', $g->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                            <form action="{{ route('gedung.destroy', $g->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
<<<<<<< HEAD

=======
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                                <button onclick="return confirm('Hapus gedung ini?')"
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
<<<<<<< HEAD

                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-3 text-muted">
                            Belum ada data gedung yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $gedungs->links() }}
            </div>

        </div>
    </div>

</div>
=======
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
@endsection