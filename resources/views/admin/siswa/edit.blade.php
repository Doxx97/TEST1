@extends('layouts.admin')

@section('content')
<div class="p-4 p-md-5">
    <h2 class="fw-bold mb-4">Edit Data Siswa</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="nisn" class="form-label">NISN (Opsional)</label>
                    <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn) }}">
                    @error('nisn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="kelas_id" class="form-label">Kelas</label>
                    <select class="form-select @error('kelas_id') is-invalid @enderror" id="kelas_id" name="kelas_id" required>
                        <option value="" disabled>-- Pilih Kelas --</option>
                        @foreach ($semuaKelas as $kelas)
                            <option value="{{ $kelas->id }}" {{ old('kelas_id', $siswa->kelas_id) == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection