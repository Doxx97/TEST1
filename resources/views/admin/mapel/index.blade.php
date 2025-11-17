@extends('layouts.admin')

@section('content')
<div class="p-4 p-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Master Data Mata Pelajaran</h2>
        <a href="{{ route('mapel.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Mapel
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
                        <th>Nama Mata Pelajaran</th>
                        <th>Guru Pengampu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($semuaMapel as $index => $mapel)
                        <tr>
                            <td>{{ $semuaMapel->firstItem() + $index }}</td>
                            <td>{{ $mapel->nama }}</td>
                            {{-- Tampilkan nama guru dari relasi 'guru' --}}
                            <td>{{ $mapel->guru->nama ?? 'Belum diatur' }}</td>
                            <td>
                                <a href="{{ route('mapel.edit', $mapel->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('mapel.destroy', $mapel->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">Belum ada data mata pelajaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">{{ $semuaMapel->links() }}</div>
        </div>
    </div>
</div>
@endsection