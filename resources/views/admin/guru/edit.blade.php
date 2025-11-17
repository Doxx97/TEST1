@extends('layouts.admin')

@section('content')
<div class="p-4 p-md-5">
    <h2 class="fw-bold mb-4">Edit Akun Guru</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('guru.update', $guru->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $guru->nama) }}" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- NIPSN (UNTUK LOGIN) --}}
                <div class="mb-3">
                    <label for="nipsn" class="form-label">NIPSN (Untuk Login)</label>
                    <input type="text" class="form-control @error('nipsn') is-invalid @enderror" id="nipsn" name="nipsn" value="{{ old('nipsn', $guru->nipsn) }}" required>
                    @error('nipsn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $guru->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <hr class="my-4">
                
                <p class="text-muted">Ubah Password (Opsional)</p>
                {{-- PASSWORD (OPSIONAL) --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Akun</button>
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection