@extends('layouts.admin')

@section('content')
<div class="p-4 p-md-5">
    <h2 class="fw-bold mb-4">Edit Tahun Pelajaran</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            {{-- Form mengarah ke route 'update' --}}
            <form action="{{ route('tahun-pelajaran.update', $tahunPelajaran->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Wajib untuk form Edit --}}
                
                <div class="mb-3">
                    <label for="tahun_pelajaran" class="form-label">Tahun Pelajaran (Contoh: 2024/2025)</label>
                    <input type="text" class="form-control @error('tahun_pelajaran') is-invalid @enderror" id="tahun_pelajaran" name="tahun_pelajaran" value="{{ old('tahun_pelajaran', $tahunPelajaran->tahun_pelajaran) }}" required>
                    @error('tahun_pelajaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="Tidak Aktif" {{ $tahunPelajaran->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        <option value="Aktif" {{ $tahunPelajaran->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Data</button>
                <a href="{{ route('tahun-pelajaran.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection