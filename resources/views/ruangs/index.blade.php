@extends('layouts.dashboard')

<<<<<<< HEAD
=======
@section('title', 'Master Ruang')

>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
@section('content')
<div class="container">

<<<<<<< HEAD
    <h2 class="mb-3">Master Ruang</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('ruangs.create') }}" class="btn btn-primary shadow-sm">
            <i class="fa-solid fa-plus me-2"></i> Tambah Ruang
        </a>
    </div>
=======
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Master Ruang</h5>
    <a href="{{ route('ruangs.create') }}" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Tambah Ruang
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
                        <th>Gedung</th>
                        <th>Lantai</th>
                        <th>Jenis</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ruangs as $r)
                    <tr>
                        <td>{{ $r->kode_ruang }}</td>
                        <td>{{ $r->lantai->gedung->nama_gedung }}</td>
                        <td>{{ $r->lantai->kode_lantai }}</td>
                        <td>{{ $r->jenisRuangan->nama_jenis_ruangan }}</td>
                        <td>{{ $r->nama_ruang }}</td>
                        <td>
                            @if($r->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('ruangs.show', $r->id) }}"
                               class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('ruangs.edit', $r->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('ruangs.destroy', $r->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus ruang ini?')"
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

    </div>
</div>
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Gedung</th>
                            <th>Lantai</th>
                            <th>Jenis</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($ruangs as $r)
                        <tr>

                            <td>{{ $r->kode_ruang }}</td>

                            <td>{{ $r->lantai->gedung->nama_gedung ?? '-' }}</td>

                            <td>{{ $r->lantai->kode_lantai ?? '-' }}</td>

                            <td>{{ $r->jenisRuangan->nama_jenis_ruangan ?? '-' }}</td>

                            <td>{{ $r->nama_ruang }}</td>

                            <td>
                                @if($r->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Nonaktif</span>
                                @endif
                            </td>

                            <td>

                                <a href="{{ route('ruangs.show', $r->id) }}"
                                   class="btn btn-info btn-sm">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="{{ route('ruangs.edit', $r->id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <form action="{{ route('ruangs.destroy', $r->id) }}"
                                      method="POST"
                                      style="display:inline-block">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Hapus ruang ini?')"
                                            class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">
                                Belum ada data ruang yang terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{-- Pagination --}}
            @if(method_exists($ruangs, 'hasPages') && $ruangs->hasPages())

            <div class="mt-3 text-center">

                <small class="text-muted d-block mb-2">
                    Menampilkan {{ $ruangs->firstItem() }}
                    sampai {{ $ruangs->lastItem() }}
                    dari {{ $ruangs->total() }} data
                </small>

                <div class="d-flex justify-content-center">
                    {{ $ruangs->links('pagination::bootstrap-5') }}
                </div>

            </div>

            @endif

        </div>
    </div>

</div>
@endsection