@extends('layouts.dashboard')

@section('title', 'Master Kelompok Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Master Kelompok Barang</h5>
    <a href="{{ route('kelompok.create') }}" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Tambah Kelompok
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
                        <th>Nama Kelompok</th>
                        <th>Status</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kelompoks as $k)
                    <tr>

                        <td>{{ $k->kode_kelompok }}</td>

                        <td>{{ $k->nama_kelompok }}</td>

                        <td class="text-center">
                            @if($k->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>

                        <td class="text-center d-flex justify-content-center gap-2">
                            <a href="{{ route('kelompok.show', $k->id) }}"
                               class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('kelompok.edit', $k->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('kelompok.destroy', $k->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus kelompok ini?')"
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">
                            Belum ada data kelompok barang.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $kelompoks->links('pagination::bootstrap-5') }}
        </div>


    </div>
</div>

@endsection