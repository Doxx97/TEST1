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
                            <a href="{{ route('tahun-pelajaran.index') }}" class="list-group-item list-group-item-action bg-custom-green text-white border-0 ms-4 py-1 {{ request()->routeIs('tahun-pelajaran.*') ? 'active' : '' }}">
                                Tahun Pelajaran
                            </a>
                            <a href="{{ route('kelas.index') }}" class="list-group-item list-group-item-action bg-custom-green text-white border-0 ms-4 py-1 {{ request()->routeIs('kelas.*') ? 'active' : '' }}">
                                Kelas
                            </a>
                            <a href="{{ route('mapel.index') }}" class="list-group-item list-group-item-action bg-custom-green text-white border-0 ms-4 py-1 {{ request()->routeIs('mapel.*') ? 'active' : '' }}">
                                Mata Pelajaran
                            </a>
                            <a href="{{ route('guru.index') }}" class="list-group-item list-group-item-action bg-custom-green text-white border-0 ms-4 py-1 {{ request()->routeIs('guru.*') ? 'active' : '' }}">
                                Guru
                            </a>
                            <a href="{{ route('siswa.index') }}" class="list-group-item list-group-item-action bg-custom-green text-white border-0 ms-4 py-1 {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                                Siswa
                            </a>
                        </div>
                    </div>

                    <a href="#" class="list-group-item list-group-item-action bg-custom-green text-white border-0 fw-medium border-menu">
                        <i class="fas fa-user-tie me-3"></i> Wali Kelas
                    </a>
                </nav>

                <div class="mt-auto border-top border-secondary pt-3">
    
                    <a href="#" {{-- Ganti href jadi # --}}
                    class="list-group-item list-group-item-action bg-danger text-white border-0 fw-medium rounded"
                    data-bs-toggle="modal" data-bs-target="#logoutModal"> {{-- Tambahkan ini --}}
                        <i class="fas fa-sign-out-alt me-3"></i> Log Out
                    </a>

                    {{-- PERBAIKI ACTION DI BAWAH INI --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
        
        {{-- KONTEN UTAMA YANG SUDAH DI GABUNG --}}
        <main id="page-content-wrapper" class="bg-light min-vh-100">
            
            @yield('content')

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

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin logout dan memutus koneksi?
                </div>
                <div class="modal-footer">
                    {{-- Tombol Batal --}}
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    
                    {{-- Tombol Yakin (Tombol inilah yang akan men-submit form logout) --}}
                    <button type="button" class="btn btn-danger" onclick="document.getElementById('logout-form').submit();">
                        Ya, Logout
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>