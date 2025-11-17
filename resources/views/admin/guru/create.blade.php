@extends('layouts.admin')

@section('content')
<div class="p-4 p-md-5">
    <h2 class="fw-bold mb-4">Buat Akun Guru Baru</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('guru.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- NIPSN (UNTUK LOGIN) --}}
                <div class="mb-3">
                    <label for="nipsn" class="form-label">NIPSN (Untuk Login)</label>
                    <input type="text" class="form-control @error('nipsn') is-invalid @enderror" id="nipsn" name="nipsn" value="{{ old('nipsn') }}" required>
                    @error('nipsn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <hr class="my-4">

                {{-- PASSWORD --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Akun</button>
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection