@extends('layouts.dashboard')

<<<<<<< HEAD
=======
@section('title', 'Master Lantai')

>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
@section('content')
<div class="container">

<<<<<<< HEAD
    <h2 class="mb-3">Master Lantai</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('lantai.create') }}" 
           class="btn btn-primary shadow-sm">
            <i class="fa-solid fa-plus me-2"></i> Tambah Lantai
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
=======
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Master Lantai</h5>
    <a href="{{ route('lantai.create') }}" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Tambah Lantai
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
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                <thead class="table-light">
                    <tr>
                        <th>Gedung</th>
                        <th>Kode Lantai</th>
                        <th>Nama Lantai</th>
                        <th>Status</th>
<<<<<<< HEAD
                        <th width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($lantais as $l)
=======
                        <th width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lantais as $l)
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                    <tr>
                        <td>{{ $l->gedung->nama_gedung ?? '-' }}</td>
                        <td>{{ $l->kode_lantai }}</td>
                        <td>{{ $l->nama_lantai ?? '-' }}</td>
                        <td>
                            @if($l->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
<<<<<<< HEAD

                        <td>
                            <a href="{{ route('lantai.show', $l->id) }}" 
=======
                        <td>
                            <a href="{{ route('lantai.show', $l->id) }}"
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                               class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

<<<<<<< HEAD
                            <a href="{{ route('lantai.edit', $l->id) }}" 
=======
                            <a href="{{ route('lantai.edit', $l->id) }}"
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('lantai.destroy', $l->id) }}"
                                  method="POST"
<<<<<<< HEAD
                                  style="display:inline-block">
                                @csrf
                                @method('DELETE')

=======
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus lantai ini?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
<<<<<<< HEAD

                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-3 text-muted">
                            Belum ada data lantai yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $lantais->links() }}
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