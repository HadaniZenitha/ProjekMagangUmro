@extends('layouts.dashboard')

@section('title', 'Master PIC')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-body">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Master PIC</h4>

            <a href="{{ route('pic.create') }}" 
               class="btn btn-primary btn-sm">
                <i class="fa-solid fa-plus me-1"></i> Tambah PIC
            </a>
        </div>

        <!-- Alert -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle">

                <thead class="table-light">
                    <tr>
                        <th>Nama PIC</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pics as $p)
                    <tr>

                        <td>{{ $p->nama_pic }}</td>

                        <td>{{ $p->divisi->nama_divisi ?? '-' }}</td>

                        <td>{{ $p->jabatan }}</td>

                        <td>
                            @if($p->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>

                        <td>

                            <!-- Edit -->
                            <a href="{{ route('pic.edit', $p->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('pic.destroy', $p->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Yakin hapus PIC ini?')"
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">
                            Belum ada data PIC.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <!-- Pagination -->
        @if(method_exists($pics, 'hasPages') && $pics->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-3">

            <small class="text-muted">
                Menampilkan {{ $pics->firstItem() }} 
                sampai {{ $pics->lastItem() }} 
                dari {{ $pics->total() }} data
            </small>

            {{ $pics->links('pagination::bootstrap-5') }}

        </div>
        @endif

    </div>
</div>

@endsection