@extends('layouts.dashboard')

@section('content')
<div class="container">

    <h2 class="mb-3">Master Kelompok Barang</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('kelompok.create') }}" 
           class="btn btn-primary shadow-sm">
            <i class="fa-solid fa-plus me-2"></i> Tambah Kelompok
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
                        <th>Nama Kelompok</th>
                        <th>Status</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelompoks as $k)
                    <tr>
                        <td>{{ $k->kode_kelompok }}</td>
                        <td>{{ $k->nama_kelompok }}</td>
                        <td>
                            @if($k->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
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
                                  style="display:inline-block">
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
                        <td colspan="4" class="text-center py-3 text-muted">
                            Belum ada data kelompok barang yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $kelompoks->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
@endsection