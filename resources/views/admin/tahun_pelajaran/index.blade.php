{{-- Ini akan otomatis mengambil cangkang dari layouts/admin.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="p-4 p-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Master Data Tahun Pelajaran</h2>
        {{-- Tombol "Tambah" mengarah ke route 'create' --}}
        <a href="{{ route('tahun-pelajaran.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Data
        </a>
    </div>

    {{-- Tampilkan pesan sukses/error jika ada --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tahun Pelajaran</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop data dari Controller --}}
                    @forelse ($semuaTahun as $index => $tahun)
                        <tr>
                            {{-- Nomor urut otomatis --}}
                            <td>{{ $semuaTahun->firstItem() + $index }}</td>
                            <td>{{ $tahun->tahun_pelajaran }}</td>
                            <td>
                                @if($tahun->status == 'Aktif')
                                    <span class="badge bg-success">{{ $tahun->status }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $tahun->status }}</span>
                                @endif
                            </td>
                            <td>
                                {{-- Tombol Edit --}}
                                <a href="{{ route('tahun-pelajaran.edit', $tahun->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                
                                {{-- Tombol Hapus (Wajib pakai form) --}}
                                <form action="{{ route('tahun-pelajaran.destroy', $tahun->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data tahun pelajaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            {{-- Link Paginasi (jika data lebih dari 10) --}}
            <div class="mt-3">
                {{ $semuaTahun->links() }}
            </div>
        </div>
    </div>
</div>
@endsection