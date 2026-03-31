@extends('layouts.dashboard')

@section('title', 'Master Jenis Ruangan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Master Jenis Ruangan</h5>
    <a href="{{ route('jenis-ruangan.create') }}" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Tambah Jenis Ruangan
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
                        <th>Nama Jenis Ruangan</th>
                        <th>Status</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jenisRuangans as $j)
                    <tr>
                        <td>{{ $j->kode_jenis_ruangan }}</td>
                        <td>{{ $j->nama_jenis_ruangan }}</td>

                        <td class="text-center">
                            @if($j->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>

                        <td class="text-center d-flex justify-content-center gap-2">
                            <a href="{{ route('jenis-ruangan.show', $j->id) }}" 
                               class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('jenis-ruangan.edit', $j->id) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('jenis-ruangan.destroy', $j->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus jenis ruangan ini?')"
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">
                            Belum ada data jenis ruangan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $jenisRuangans->links('pagination::bootstrap-5') }}
        </div>


    </div>
</div>

@endsection