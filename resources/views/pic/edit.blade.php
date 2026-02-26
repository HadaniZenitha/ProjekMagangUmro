@extends('layouts.dashboard')

@section('title', 'Tambah PIC')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <form method="POST" action="{{ route('pic.update', $pic->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Divisi</label>
                <select name="divisi_id" class="form-control" required>
                    @foreach($divisis as $d)
                        <option value="{{ $d->id }}" @readonly(true)>
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
                       value="{{ old('nid_pic', $pic->nid_pic) }}">
            </div>

            <div class="mb-3">
                <label>Nama PIC</label>
                <input type="text" name="nama_pic"
                       class="form-control" required>
                       value="{{ old('nama_pic', $pic->nama_pic) }}"
            </div>

            <div class="mb-3">
                <label>Jabatan</label>
                <input type="text" name="jabatan"
                       class="form-control">
                       value="{{ old('jabatan', $pic->jabatan) }}"
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="is_active" class="form-control">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('pic.index') }}" 
               class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>
@endsection