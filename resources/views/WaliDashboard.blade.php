<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SiNilai SD Aldenaire Admin (Bootstrap 5)</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <style>
        /* CSS Kustom untuk menyesuaikan warna dan Sidebar */
        :root {
            --bs-custom-green: #558B2F; /* Warna Hijau Gelap */
        }
        .bg-custom-green {
            background-color: var(--bs-custom-green) !important;
        }
        .text-custom-green {
            color: var(--bs-custom-green) !important;
        }
        
        /* Gaya untuk Sidebar */
        #sidebar-wrapper {
            width: 250px; /* Lebar Sidebar */
            position: fixed;
            top: 0;
            left: -250px; /* Awalnya tersembunyi */
            height: 100%;
            z-index: 1050; /* Lebih tinggi dari navbar */
            transition: all 0.3s ease;
            padding-top: 56px; /* Tinggi Navbar */
            overflow-y: auto;
        }

        /* Sidebar terbuka */
        #sidebar-wrapper.toggled {
            left: 0;
        }
        
        /* Konten utama */
        #page-content-wrapper {
            width: 100%;
            padding-top: 56px; /* Tinggi Navbar */
            transition: all 0.3s ease;
        }

        /* Geser konten utama saat sidebar terbuka (Opsional, lebih umum di desktop) */
        /* .toggled #page-content-wrapper {
             margin-left: 250px;
        } */
        
        /* Overlay untuk mobile */
        #sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }

        .border-menu {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 0.5rem;
            margin-bottom: 0.5rem;
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

                <a class="navbar-brand text-white ms-auto me-0 fw-bold fs-4 text-uppercase" href="#">SINILAI</a>
            </div>
        </nav>
        <div id="sidebar-overlay"></div>

        <div class="bg-custom-green text-white" id="sidebar-wrapper">
            <div class="p-3 d-flex flex-column h-100">
                
                <div class="d-flex align-items-center mb-4 border-menu">
                    <div class="p-2 me-2">
                        <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fas fa-graduation-cap text-custom-green"></i>
                        </div>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold">SiNilai</div>
                        <div class="text-sm">SD Aldenaire</div>
                    </div>
                </div>
                
                <nav class="list-group list-group-flush flex-grow-1">
                    <a href="#" class="list-group-item list-group-item-action bg-custom-green text-white border-0 fw-medium border-menu">
                        <i class="fas fa-clock me-3"></i> Dashboard
                    </a>
                    
                    <div class="border-menu">
                        <a class="list-group-item list-group-item-action bg-custom-green text-white border-0 fw-medium d-flex justify-content-between align-items-center" 
                           data-bs-toggle="collapse" href="#collapseBahasa" role="button" aria-expanded="false" aria-controls="collapseBahasa">
                            <span><i class="fas fa-book me-3"></i> Bahasa Indonesia</span>
                            <i class="fas fa-chevron-down small"></i>
                        </a>
                        <div class="collapse" id="collapseBahasa">
                            <a href="#" class="list-group-item list-group-item-action bg-custom-green text-white border-0 ms-4 py-1">Kelas 1</a>
                            <a href="#" class="list-group-item list-group-item-action bg-custom-green text-white border-0 ms-4 py-1">Kelas 2</a>
                        </div>
                    </div>

                    <div class="border-menu">
                        <a class="list-group-item list-group-item-action bg-custom-green text-white border-0 fw-medium d-flex justify-content-between align-items-center" 
                           data-bs-toggle="collapse" href="#collapseWaliKelas" role="button" aria-expanded="false" aria-controls="collapseWaliKelas">
                            <span><i class="fas fa-user-tie me-3"></i> Wali Kelas</span>
                            <i class="fas fa-chevron-down small"></i>
                        </a>
                        <div class="collapse" id="collapseWaliKelas">
                            <a href="#" class="list-group-item list-group-item-action bg-custom-green text-white border-0 ms-4 py-1">Daftar Guru</a>
                            <a href="#" class="list-group-item list-group-item-action bg-custom-green text-white border-0 ms-4 py-1">Atur Jadwal</a>
                        </div>
                    </div>
                </nav>

                <div class="mt-auto border-top border-secondary pt-3">
    
                    <a href="{{ route('logout') }}" {{-- <-- GANTI INI --}}
                    class="list-group-item list-group-item-action bg-danger text-white border-0 fw-medium rounded"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-3"></i> Log Out
                    </a>

                    {{-- PERBAIKI ACTION DI BAWAH INI --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div id="page-content-wrapper" class="bg-light min-vh-100">
            <div class="p-4 p-md-5">
                
                <div class="p-5 shadow-sm rounded bg-white d-flex flex-column flex-md-row align-items-center justify-content-center" 
                     style="min-height: calc(100vh - 100px); background-color: #EFEFEF;">
                    
                    <div class="me-md-5 mb-4 mb-md-0">
                        <div class="rounded-circle border border-secondary border-4 bg-white d-flex align-items-center justify-content-center" style="width: 192px; height: 192px;">
                            <i class="fas fa-user-circle text-black" style="font-size: 150px;"></i>
                        </div>
                    </div>
                    
                    <div class="text-center text-md-start">
                        <p class="fs-4 fw-light text-black">Hi user Welcome to</p>
                        <h1 class="display-5 fw-bold mt-1 text-black">SINILAI</h1>
                    </div>
                    
                </div>
            </div>
        </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarWrapper = document.getElementById('sidebar-wrapper');
            const overlay = document.getElementById('sidebar-overlay');

            function toggleSidebar() {
                sidebarWrapper.classList.toggle('toggled');
                overlay.style.display = sidebarWrapper.classList.contains('toggled') ? 'block' : 'none';
            }

            // 1. Toggle saat tombol garis tiga diklik
            sidebarToggle.addEventListener('click', function(e) {
                e.preventDefault();
                toggleSidebar();
            });

            // 2. Tutup sidebar saat overlay di mobile diklik
            overlay.addEventListener('click', function() {
                toggleSidebar();
            });

            // 3. Tambahkan logika responsif (opsional, untuk menyembunyikan overlay di desktop)
            window.addEventListener('resize', function() {
                if (window.innerWidth > 992 && sidebarWrapper.classList.contains('toggled')) {
                    overlay.style.display = 'none';
                } else if (window.innerWidth <= 992 && sidebarWrapper.classList.contains('toggled')) {
                    overlay.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>