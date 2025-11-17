@extends('layouts.admin')

@section('content')
<div class="p-4 p-md-5">
    <h2 class="fw-bold mb-4">Tambah Tahun Pelajaran Baru</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            {{-- Form mengarah ke route 'store' --}}
            <form action="{{ route('tahun-pelajaran.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="tahun_pelajaran" class="form-label">Tahun Pelajaran (Contoh: 2024/2025)</label>
                    <input type="text" class="form-control @error('tahun_pelajaran') is-invalid @enderror" id="tahun_pelajaran" name="tahun_pelajaran" value="{{ old('tahun_pelajaran') }}" required>
                    {{-- Tampilkan error validasi --}}
                    @error('tahun_pelajaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="Tidak Aktif" selected>Tidak Aktif</option>
                        <option value="Aktif">Aktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('tahun-pelajaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection