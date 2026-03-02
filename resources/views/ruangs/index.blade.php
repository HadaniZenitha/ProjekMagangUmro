@extends('layouts.dashboard')

@section('page-title', 'Master Ruang')
@section('title', 'Master Ruang')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Master Ruang</h4>

        <a href="{{ route('ruangs.create') }}" 
           class="btn btn-primary shadow-sm">
            <i class="fa-solid fa-plus me-2"></i> Tambah Ruang
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered align-middle">
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
                               class="btn btn-info btn-sm text-white">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('ruangs.edit', $r->id) }}" 
                               class="btn btn-warning btn-sm text-dark">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('ruangs.destroy', $r->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus ruang?')"
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-3 text-muted">
                            Belum ada data ruang yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection