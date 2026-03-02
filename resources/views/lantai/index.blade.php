@extends('layouts.dashboard')

@section('title', 'Master Lantai')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Master Lantai</h5>
    <a href="{{ route('lantai.create') }}" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Tambah Lantai
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
                <thead class="table-light">
                    <tr>
                        <th>Gedung</th>
                        <th>Kode Lantai</th>
                        <th>Nama Lantai</th>
                        <th>Status</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lantais as $l)
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
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus lantai ini?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection