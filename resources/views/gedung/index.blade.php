@extends('layouts.dashboard')

@section('title', 'Master Gedung')

@section('content')

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
                <thead class="table-light text-center">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Gedung</th>
                        <th>Status</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($gedungs as $g)
                    <tr>
                        <td>{{ $g->kode_gedung }}</td>
                        <td>{{ $g->nama_gedung }}</td>

                        <td class="text-center">
                            @if($g->is_active)
                                <span class="badge bg-success">
                                    <i class="fa-solid fa-circle-check me-1"></i> Aktif
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    <i class="fa-solid fa-circle-xmark me-1"></i> Nonaktif
                                </span>
                            @endif
                        </td>

                        <td class="text-center d-flex justify-content-center gap-2">
                            <a href="{{ route('gedung.show', $g->id) }}" class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('gedung.edit', $g->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('gedung.destroy', $g->id) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus gedung ini?')" 
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">
                            Belum ada data gedung.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $gedungs->links('pagination::bootstrap-5') }}
        </div>


    </div>
</div>

@endsection