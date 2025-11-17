<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SINILAI - Admin Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <style>
        /* CSS Kustom Anda */
        :root {
            --bs-custom-green: #658C58; 
        }
        .bg-custom-green {
            background-color: var(--bs-custom-green) !important;
        }
        #sidebar-wrapper {
            width: 250px; position: fixed; top: 0; left: -250px; height: 100%;
            z-index: 1050; transition: all 0.3s ease; padding-top: 56px; overflow-y: auto;
        }
        #sidebar-wrapper.toggled { left: 0; }
        #page-content-wrapper { width: 100%; padding-top: 56px; transition: all 0.3s ease; }
        #sidebar-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5); z-index: 1040; display: none;
        }
        .border-menu {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 0.5rem; margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>

    <div id="wrapper">
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-custom-green fixed-top shadow">
            <div class="container">
                <button class="btn p-2" id="sidebarToggle">
                    <i class="fas fa-bars fa-lg text-white"></i>
                </button>
                <a class="navbar-brand text-white ms-auto me-0 fw-bold fs-4 text-uppercase" href="{{ route('admin.dashboard') }}">SINILAI</a>
            </div>
        </nav>
        <div id="sidebar-overlay"></div>

        <div class="bg-custom-green text-white" id="sidebar-wrapper">
            <div class="p-3 d-flex flex-column h-100">
                
                <div class="d-flex align-items-center mb-4 border-menu">
                    <div class="p-2 me-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <img src="{{ asset('img/SD.png') }}" alt="Logo" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold">SINILAI</div>
                        <div class="text-sm">SD Aldenaire</div>
                    </div>
                </div>
                
                <nav class="list-group list-group-flush flex-grow-1">
                    {{-- Menu Admin --}}
                    <a href="{{ route('admin.dashboard') }}" 
                       class="list-group-item list-group-item-action bg-custom-green text-white border-0 fw-medium border-menu {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt me-3"></i> Dashboard
                    </a>
                    
                    <div class="border-menu">
                        <a class="list-group-item list-group-item-action bg-custom-green text-white border-0 fw-medium d-flex justify-content-between align-items-center" 
                            data-bs-toggle="collapse" href="#collapseMasterData" role="button" aria-expanded="true" aria-controls="collapseMasterData">
                            <span><i class="fas fa-database me-3"></i> Master Data</span>
                            <i class="fas fa-chevron-down small"></i>
                        </a>
                        <div class="collapse show" id="collapseMasterData">
                            <a href="#" class="list-group-item list-group-item-action bg-custom-green text-white border-0 ms-4 py-1">Tahun Pelajaran</a>
                            <a href="#" class="list-group-item list-group-item-action bg-custom-green text-white border-0 ms-4 py-1">Kelas</a>
                            <a href="#" class="list-group-item list-group-item-action bg-custom-green text-white border-0 ms-4 py-1">Mata Pelajaran</a>
                            <a href="#" class="list-group-item list-group-item-action bg-custom-green text-white border-0 ms-4 py-1">Guru</a>
                            <a href="#" class="list-group-item list-group-item-action bg-custom-green text-white border-0 ms-4 py-1">Siswa</a>
                        </div>
                    </div>

                    <a href="#" class="list-group-item list-group-item-action bg-custom-green text-white border-0 fw-medium border-menu">
                        <i class="fas fa-user-tie me-3"></i> Wali Kelas
                    </a>
                </nav>

                <div class="mt-auto border-top border-secondary pt-3">
                    <a href="{{ route('landing') }}" 
                       class="list-group-item list-group-item-action bg-danger text-white border-0 fw-medium rounded"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-3"></i> Log Out
                    </a>
                    <form id="logout-form" action="{{ route('landing') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        
        {{-- KONTEN UTAMA YANG SUDAH DI GABUNG --}}
        <main id="page-content-wrapper" class="bg-light min-vh-100">
            
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

        </main>
        
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script toggle sidebar Anda (Sudah benar)
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarWrapper = document.getElementById('sidebar-wrapper');
        const overlay = document.getElementById('sidebar-overlay');
        function toggleSidebar() {
            sidebarWrapper.classList.toggle('toggled');
            overlay.style.display = sidebarWrapper.classList.contains('toggled') ? 'block' : 'none';
        }
        sidebarToggle.addEventListener('click', function(e) { e.preventDefault(); toggleSidebar(); });
        overlay.addEventListener('click', function() { toggleSidebar(); });
    });
    </script>
</body>
</html>