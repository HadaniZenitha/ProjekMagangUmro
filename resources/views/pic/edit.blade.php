@extends('layouts.dashboard')

@section('title', 'Edit PIC')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Edit PIC</h5>
    <a href="{{ route('pic.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form method="POST" action="{{ route('pic.update', $pic->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Divisi</label>
                <select name="divisi_id" class="form-control" required>
                    @foreach($divisis as $d)
                        <option value="{{ $d->id }}"
                            {{ $pic->divisi_id == $d->id ? 'selected' : '' }}>
                            {{ $d->nama_divisi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">NID Pegawai</label>
                <input type="text"
                       class="form-control"
                       value="{{ old('nid_pic', $pic->nid_pic) }}"
                       readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama PIC</label>
                <input type="text"
                       name="nama_pic"
                       class="form-control"
                       value="{{ old('nama_pic', $pic->nama_pic) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text"
                       name="jabatan"
                       class="form-control"
                       value="{{ old('jabatan', $pic->jabatan) }}">
            </div>

            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-control">
                    <option value="1" {{ $pic->is_active ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0" {{ !$pic->is_active ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-warning">
                    <i class="fa-solid fa-save"></i> Update
                </button>
                <a href="{{ route('pic.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection