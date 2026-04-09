@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">
                <i class="fa-solid fa-user-edit me-2"></i>
                Edit User
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- NAMA -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- NID -->
                    <div class="mb-3">
                        <label for="nid" class="form-label fw-bold">NID Karyawan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nid') is-invalid @enderror" 
                            id="nid" name="nid" value="{{ old('nid', $user->nid) }}" required 
                            placeholder="Contoh: 7503018JA">
                        @error('nid')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                            id="password" name="password" placeholder="Kosongkan untuk generate ulang dari NID">
                        <small class="text-muted d-block mt-2">
                            <i class="fa-solid fa-info-circle me-1"></i>
                            Jika dikosongkan, password akan di-generate dari NID
                        </small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password</label>
                        <input type="password" class="form-control" 
                            id="password_confirmation" name="password_confirmation">
                    </div>

                    <!-- ROLES -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Role</label>
                        <div class="border rounded p-3" style="background-color: #f9f9f9;">
                            @foreach ($roles as $role)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="roles[]" 
                                        value="{{ $role->name }}" id="role_{{ $role->name }}"
                                        {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_{{ $role->name }}">
                                        {{ ucfirst($role->name) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('roles')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- BUTTONS -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-save me-2"></i>
                            Update
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-times me-2"></i>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
