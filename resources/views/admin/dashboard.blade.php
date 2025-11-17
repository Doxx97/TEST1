{{-- Beri tahu Blade untuk memakai layout 'admin' yang baru kita buat --}}
@extends('layouts.admin')

{{-- Mulai bagian "content" (ini akan mengisi @yield('content')) --}}
@section('content')

<div class="p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold">Selamat Datang, Admin !</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
            
                    {{-- Filter Tahun Pelajaran --}}
                    <form id="filterTahun" action="{{ route('admin.dashboard') }}" method="GET">
                        <select name="tahun_pelajaran" class="form-select" onchange="document.getElementById('filterTahun').submit();">
                            
                            {{-- Data ini harus dikirim dari Controller --}}
                            @foreach($allTahunPelajaran as $tahun)
                                <option value="{{ $tahun->id }}" {{ $tahun->id == $selectedTahunId ? 'selected' : '' }}>
                                    {{ $tahun->tahun_pelajaran }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            
                {{-- Stats Cards --}}
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
                    <div class="col">
                        <div class="card text-white h-100 shadow-sm" style="background-color: #9DDAA1;">
                            <div class="card-body">
                                <h5 class="card-title fs-6">Jumlah Guru</h5>
                                <p class="card-text fs-3 fw-bold">{{ $jumlahGuru }} Guru</p>
                            </div> 
                        </div>
                    </div>

                    <div class="col">
                        <div class="card text-white h-100 shadow-sm" style="background-color: #9DBBDA">
                            <div class="card-body">
                                <h5 class="card-title fs-6">Jumlah Siswa</h5>
                                <p class="card-text fs-3 fw-bold">{{ $jumlahSiswa }} Siswa</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card text-white h-100 shadow-sm" style="background-color: #CFCF10">
                            <div class="card-body">
                                <h5 class="card-title fs-6">Jumlah Mapel</h5>
                                <p class="card-text fs-3 fw-bold">{{ $jumlahMapel }} Mapel</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card text-white h-100 shadow-sm" style="background-color: #CF1A10">
                            <div class="card-body">
                                <h5 class="card-title fs-6">Jumlah Kelas</h5>
                                <p class="card-text fs-3 fw-bold">{{ $jumlahKelas }} Kelas</p>
                            </div>
                        </div>
                    </div>
                </div>
            
                {{-- Tabel Status Nilai --}}
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h3 class="card-title mb-0 fw-bold">Status Nilai</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="ps-4">NO</th>
                                        <th scope="col">Mata Pelajaran</th>
                                        <th scope="col">Guru</th>
                                        <th scope="col">Status Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @forelse($statusNilai as $index => $mapel)
                                        <tr>
                                            <td class="ps-4">{{ $index + 1 }}</td>
                                            <td>{{ $mapel->nama }}</td>
                                            <td>{{ $mapel->guru->nama ?? 'Belum ada guru' }}</td>
                                            <td>
                                                @if($mapel->status == 'Terkirim')
                                                    <span class="badge rounded-pill bg-success-subtle text-success-emphasis px-3 py-2">
                                                        Terkirim
                                                    </span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger-subtle text-danger-emphasis px-3 py-2">
                                                        Belum Dikirim
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center p-4">Data mata pelajaran tidak ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection