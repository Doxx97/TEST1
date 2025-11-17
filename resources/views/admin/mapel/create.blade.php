@extends('layouts.admin')

@section('content')
<div class="p-4 p-md-5">
    <h2 class="fw-bold mb-4">Tambah Mapel Baru</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('mapel.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Mata Pelajaran</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <label for="guru_id" class="form-label">Guru Pengampu</label>
                    <select class="form-select @error('guru_id') is-invalid @enderror" id="guru_id" name="guru_id" required>
                        <option value="" disabled selected>-- Pilih Guru --</option>
                        {{-- Loop semua guru dari Controller --}}
                        @foreach ($semuaGuru as $guru)
                            <option value="{{ $guru->id }}" {{ old('guru_id') == $guru->id ? 'selected' : '' }}>
                                {{ $guru->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('guru_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('mapel.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection