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

<<<<<<< HEAD
<div class="table-responsive">

<table class="table table-bordered align-middle">

<thead class="table-light">
<tr>
    <th>Nama PIC</th>
    <th>Divisi</th>
    <th>Jabatan</th>
    <th>Status</th>
    <th width="200">Aksi</th>
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
=======
        <div class="table-responsive">
            <table class="table align-middle table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pics as $p)
                    <tr>
                        <td>{{ $p->nama_pic }}</td>
                        <td>{{ $p->divisi->nama_divisi ?? '-' }}</td>
                        <td>{{ $p->jabatan }}</td>
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf

<a href="{{ route('pic.edit', $p->id) }}" class="btn btn-warning btn-sm">
<i class="fa-solid fa-pen"></i>
</a>

<<<<<<< HEAD
<form action="{{ route('pic.destroy', $p->id) }}"
      method="POST"
      style="display:inline-block">

@csrf
@method('DELETE')

<button onclick="return confirm('Hapus PIC ini?')" 
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
=======
                        <td>
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
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf

        {{-- Pagination --}}
        @if(method_exists($pics,'hasPages') && $pics->hasPages())
        <div class="mt-3 text-center">
            <small class="text-muted d-block mb-2">
                Menampilkan {{ $pics->firstItem() }} 
                sampai {{ $pics->lastItem() }} 
                dari {{ $pics->total() }} data
            </small>

            <div class="d-flex justify-content-center">
                {{ $pics->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif

    </div>
</div>


{{-- Pagination --}}
@if(method_exists($pics,'hasPages') && $pics->hasPages())

<div class="mt-3 text-center">

<small class="text-muted d-block mb-2">
Menampilkan {{ $pics->firstItem() }}
sampai {{ $pics->lastItem() }}
dari {{ $pics->total() }} data
</small>

<div class="d-flex justify-content-center">
{{ $pics->links('pagination::bootstrap-5') }}
</div>

</div>

@endif


</div>
</div>

@endsection