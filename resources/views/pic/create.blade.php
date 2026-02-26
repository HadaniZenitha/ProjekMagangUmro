@extends('layouts.dashboard')

@section('title', 'Tambah PIC')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <form method="POST" action="{{ route('pic.store') }}">
            @csrf

            <div class="mb-3">
                <label>Divisi</label>
                <select name="divisi_id" class="form-control" required>
                    @foreach($divisis as $d)
                        <option value="{{ $d->id }}">
                            {{ $d->nama_divisi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Nama PIC</label>
                <input type="text" name="nama_pic"
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label>NID Pegawai</label>
                <input type="text"
                    name="nid_pic"
                    class="form-control"
                    maxlength="10"
                    placeholder="12345678AB"
                    required>
                <small class="text-muted">
                    Format: 8 angka + 2 huruf
                </small>
            </div>

            <div class="mb-3">
                <label>Jabatan</label>
                <input type="text" name="jabatan"
                       class="form-control">
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