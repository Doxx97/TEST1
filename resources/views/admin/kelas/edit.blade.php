@extends('layouts.admin')

@section('content')
<div class="p-4 p-md-5">
    <h2 class="fw-bold mb-4">Edit Kelas</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('kelas.update', $kela->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_kelas" class="form-label">Nama Kelas</label>
                    <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas', $kela->nama_kelas) }}" required>
                    @error('nama_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection