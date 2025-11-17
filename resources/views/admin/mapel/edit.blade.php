@extends('layouts.admin')

@section('content')
<div class="p-4 p-md-5">
    <h2 class="fw-bold mb-4">Edit Mata Pelajaran</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Mata Pelajaran</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $mapel->nama) }}" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <label for="guru_id" class="form-label">Guru Pengampu</label>
                    <select class="form-select @error('guru_id') is-invalid @enderror" id="guru_id" name="guru_id" required>
                        <option value="" disabled>-- Pilih Guru --</option>
                        @foreach ($semuaGuru as $guru)
                            <option value="{{ $guru->id }}" {{ old('guru_id', $mapel->guru_id) == $guru->id ? 'selected' : '' }}>
                                {{ $guru->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('guru_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('mapel.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection