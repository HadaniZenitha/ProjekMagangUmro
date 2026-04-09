@extends('layouts.dashboard')

@section('title', 'Edit PIC')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Edit PIC</h5>
    <a href="{{ route('pic.index') }}">
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form method="POST" action="{{ route('pic.update', $pic->id) }}">
            @csrf
            @method('PUT')

            {{-- Divisi --}}
            <div class="mb-3">
                <label class="form-label">Fungsi</label>
                <select name="divisi_id" class="form-control" required>
                    @foreach($divisis as $d)
                        <option value="{{ $d->id }}"
                            {{ $pic->divisi_id == $d->id ? 'selected' : '' }}>
                            {{ $d->nama_divisi }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            {{-- Nama PIC --}}
            <div class="mb-3">
                <label class="form-label">Nama PIC <span class="text-danger">*</span></label>
                <input type="text"
                       name="nama_pic"
                       class="form-control"
                       value="{{ old('nama_pic', $pic->nama_pic) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">NID Pegawai <span class="text-danger">*</span></label>
                <input type="text"
                       name="nid_pic"
                       class="form-control"
                       value="{{ old('nid_pic', $pic->nid_pic) }}"
                       readonly>
            </div>

            {{-- Jabatan --}}
            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text"
                       name="jabatan"
                       class="form-control"
                       value="{{ old('jabatan', $pic->jabatan) }}">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">No. HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $pic->no_hp) }}" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" value="{{ old('email', $pic->email) }}" class="form-control">
                </div>
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
                <button type="submit" class="btn btn-warning">
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