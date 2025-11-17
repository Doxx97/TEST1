@extends('layouts.admin')

@section('content')
<div class="p-4 p-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Master Data Guru</h2>
        <a href="{{ route('guru.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Guru
        </a>
    </div>

    @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>NUPTK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($semuaGuru as $index => $guru)
                        <tr>
                            <td>{{ $semuaGuru->firstItem() + $index }}</td>
                            <td>{{ $guru->nama }}</td>
                            <td>{{ $guru->nip ?? '-' }}</td>
                            <td>{{ $guru->nuptk ?? '-' }}</td>
                            <td>
                                {{-- PERBAIKI INI: ganti $guru->id menjadi $guru->nipsn --}}
                                <a href="{{ route('guru.edit', $guru->nipsn) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                
                                {{-- PERBAIKI INI: ganti $guru->id menjadi $guru->nipsn --}}
                                <form action="{{ route('guru.destroy', $guru->nipsn) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">Belum ada data guru.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">{{ $semuaGuru->links() }}</div>
        </div>
    </div>
</div>
@endsection