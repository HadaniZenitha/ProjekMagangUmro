@extends('layouts.dashboard')

@section('title', 'Edit PIC')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <form method="POST" action="{{ route('pic.update', $pic->id) }}">
            @csrf
            @method('PUT')

            {{-- Divisi --}}
            <div class="mb-3">
                <label class="form-label">Divisi</label>
                <select name="divisi_id" class="form-select" required>
                    @foreach($divisis as $d)
                        <option value="{{ $d->id }}"
                            {{ old('divisi_id', $pic->divisi_id) == $d->id ? 'selected' : '' }}>
                            {{ $d->nama_divisi }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- NID Pegawai (Readonly) --}}
            <div class="mb-3">
                <label class="form-label">NID Pegawai</label>
                <input type="text"
                       class="form-control"
                       value="{{ old('nid_pic', $pic->nid_pic) }}"
                       readonly>
            </div>

            {{-- Nama PIC --}}
            <div class="mb-3">
                <label class="form-label">Nama PIC</label>
                <input type="text"
                       name="nama_pic"
                       class="form-control"
                       value="{{ old('nama_pic', $pic->nama_pic) }}"
                       required>
            </div>

            {{-- Jabatan --}}
            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text"
                       name="jabatan"
                       class="form-control"
                       value="{{ old('jabatan', $pic->jabatan) }}">
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1"
                        {{ old('is_active', $pic->is_active) == 1 ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0"
                        {{ old('is_active', $pic->is_active) == 0 ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>

            {{-- Tombol --}}
            <div class="d-flex left-content-end mt-4">

                <button type="submit" 
                        class="btn btn-success me-2">
                    <i class="fa-solid fa-check me-1"></i> Update
                </button>

                <a href="{{ route('pic.index') }}" 
                   class="btn btn-secondary">
                    <i class="fa-solid fa-xmark me-1"></i> Batal
                </a>

            </div>

        </form>

    </div>
</div>
@endsection