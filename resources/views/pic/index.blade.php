@extends('layouts.dashboard')

@section('title', 'Master Karyawan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Master Karyawan</h5>
    <a href="{{ route('pic.create') }}" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Tambah Karyawan
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
                        <th>Nama</th>
                        <th>Fungsi</th>
                        <th>Jabatan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center"width="220" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pics as $p)
                    <tr>
                        <td>{{ $p->nama_pic }}</td>
                        <td>{{ $p->divisi->nama_divisi ?? '-' }}</td>
                        <td>{{ $p->jabatan }}</td>

                        <td class="text-center">
                            @if($p->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>

                        <td class="text-center d-flex justify-content-center gap-2">
                            <a href="{{ route('pic.edit', $p->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('pic.destroy', $p->id) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus karyawan ini?')" 
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">
                            Belum ada data karyawan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $pics->links('pagination::bootstrap-5') }}
        </div>


    </div>
</div>

@endsection