@extends('layouts.dashboard')

@section('title', 'Master Ruang')

@section('content')

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

                <thead class="table-light text-center">
                    <tr>
                        <th>Kode</th>
                        <th>Gedung</th>
                        <th>Lantai</th>
                        <th>Jenis</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th width="160">Aksi</th>
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

                        <td class="text-center">
                            @if($r->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>

                        <td class="text-center d-flex justify-content-center gap-2">
                            <div class="d-flex justify-content-center gap-2 flex-nowrap">

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
                                    onsubmit="return confirm('Hapus ruang ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </div>
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
       <div class="mt-3">
            {{ $ruangs->links('pagination::bootstrap-5') }}
        </div>


    </div>
</div>

@endsection