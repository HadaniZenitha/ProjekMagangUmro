@extends('layouts.dashboard')

@section('content')
<div class="container">

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
                <thead class="table-light">
                    <tr>
                        <th>Gedung</th>
                        <th>Kode Lantai</th>
                        <th>Nama Lantai</th>
                        <th>Status</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lantais as $l)
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
                        <td>
                            <a href="{{ route('lantai.show', $l->id) }}" 
                               class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('lantai.edit', $l->id) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('lantai.destroy', $l->id) }}"
                                  method="POST"
                                  style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus lantai ini?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-3 text-muted">
                            Belum ada data lantai yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection