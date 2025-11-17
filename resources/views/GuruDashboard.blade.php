<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SINILAI</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <style>
        /* CSS Kustom untuk menyesuaikan warna dan Sidebar */
        :root {
            --bs-custom-green: #658C58; /* Warna Hijau Gelap */
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

                <a class="navbar-brand text-white ms-auto me-0 fw-bold fs-4 text-uppercase" href="{{ route('guru.home') }}">SINILAI</a>
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
                    <a href="{{ route('guru.dashboard') }}" class="list-group-item list-group-item-action bg-custom-green text-white border-0 fw-medium border-menu">
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
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <div id="page-content-wrapper" class="bg-light min-vh-100">
        </div>
    </div> <template id="template-dashboard-default">
        <div class="p-4 p-md-5">
            <div class="p-5 shadow-sm rounded bg-white d-flex flex-column flex-md-row align-items-center justify-content-center" 
                style="min-height: calc(100vh - 100px); background-color: #EFEFEF;">
                
                <div class="me-md-5 mb-4 mb-md-0">
                    <div class="rounded-circle border border-secondary border-4 bg-white d-flex align-items-center justify-content-center" style="width: 192px; height: 192px;">
                        <i class="fas fa-user-circle text-black" style="font-size: 150px;"></i>
                    </div>
                </div>
                
                <div class="text-center text-md-start">
                    <p class="fs-4 fw-light text-black">Hi Guru, Welcome to</p>
                    <h1 class="display-5 fw-bold mt-1 text-black">SINILAI</h1>
                </div>
                
            </div>
        </div>
    </template>

    <template id="template-profile-guru">
        <div class="p-4 p-md-5">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('guru.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>

            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle border border-secondary border-4 mx-auto mb-3 bg-light d-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                                <i class="fas fa-user-circle text-black" style="font-size: 100px;"></i>
                            </div>
                            
                            <h5 class="card-title fw-bold">Indi Rahma Angely</h5>
                            <p class="text-secondary mb-1">Guru</p>
                            <p class="text-muted small">240533602458</p>

                            <button class="btn btn-sm btn-outline-success me-2" style="background-color: #E1F2E0; border-color: #8CCF8A;">Edit Foto</button>
                            <button class="btn btn-sm btn-outline-success" style="background-color: #E1F2E0; border-color: #8CCF8A;">Edit Profile</button>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-header bg-white fw-bold">Wali Kelas</div>
                        <div class="card-body">
                            <table class="table table-borderless table-sm mb-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-normal" style="width: 40%;">Kelas</td>
                                        <td>: 4</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-normal">Jumlah Siswa</td>
                                        <td>: 20</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body p-4">
                            <table class="table table-borderless table-sm mb-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-normal" style="width: 25%;">Nama</td>
                                        <td>: Indi Rahma Angely</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-normal">NIP</td>
                                        <td>: 2005171626281278</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-normal">NUPTK</td>
                                        <td>: 634724832483</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-normal">TTL</td>
                                        <td>: 30 Februari 2005</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-normal">Guru</td>
                                        <td>: Bahasa Indonesia</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-header bg-white fw-bold">
                            <i class="fas fa-chalkboard-teacher me-2"></i> Kelas Anda
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Kelas</th>
                                            <th>Mapel</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Kelas 1</td><td>B. Indonesia</td><td><span class="badge bg-success">Terkirim</span></td></tr>
                                        <tr><td>Kelas 2</td><td>B. Indonesia</td><td><span class="badge bg-success">Terkirim</span></td></tr>
                                        <tr><td>Kelas 3</td><td>B. Indonesia</td><td><span class="badge bg-success">Terkirim</span></td></tr>
                                        <tr><td>Kelas 4</td><td>B. Indonesia</td><td><span class="badge bg-success">Terkirim</span></td></tr>
                                        <tr><td>Kelas 5</td><td>B. Indonesia</td><td><span class="badge bg-success">Terkirim</span></td></tr>
                                        <tr><td>Kelas 6</td><td>B. Indonesia</td><td><span class="badge bg-success">Terkirim</span></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </template>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // ... (Kode toggle sidebar yang sudah ada) ...
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarWrapper = document.getElementById('sidebar-wrapper');
        const overlay = document.getElementById('sidebar-overlay');
        
        function toggleSidebar() {
            sidebarWrapper.classList.toggle('toggled');
            overlay.style.display = sidebarWrapper.classList.contains('toggled') ? 'block' : 'none';
        }

        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            toggleSidebar();
        });

        overlay.addEventListener('click', function() {
            toggleSidebar();
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth > 992 && sidebarWrapper.classList.contains('toggled')) {
                overlay.style.display = 'none';
            } else if (window.innerWidth <= 992 && sidebarWrapper.classList.contains('toggled')) {
                overlay.style.display = 'block';
            }
        });

        // ===========================================
        // LOGIKA SWITCH KONTEN DASHBOARD BARU
        // ===========================================
        const contentWrapper = document.getElementById('page-content-wrapper');
        const dashboardLink = document.querySelector('#sidebar-wrapper a.list-group-item');
        const templateDefault = document.getElementById('template-dashboard-default');
        const templateProfileGuru = document.getElementById('template-profile-guru');

        /**
         * Fungsi untuk memuat konten dari template
         * @param {HTMLElement} template - Elemen <template> yang akan dimuat.
         */
        function loadContent(template) {
            // Hapus konten lama
            contentWrapper.innerHTML = '';
            
            // Kloning dan tambahkan konten baru
            const clone = template.content.cloneNode(true);
            contentWrapper.appendChild(clone);
        }

        // 1. Muat konten default (sederhana) saat halaman pertama kali dimuat
        // loadContent(templateDefault); // Kita akan ganti ini agar langsung ke Profile Guru

        // 1. Muat konten Profil Guru saat halaman pertama kali dimuat (sesuai permintaan "saat dipencet")
        loadContent(templateProfileGuru);
        dashboardLink.classList.add('active'); // Tandai Dashboard sebagai aktif

        // 2. Event listener untuk link Dashboard
        dashboardLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Hapus kelas 'active' dari semua menu jika ada
            document.querySelectorAll('#sidebar-wrapper a.list-group-item').forEach(link => {
                link.classList.remove('active');
            });

            // Muat konten Profil Guru
            loadContent(templateProfileGuru);
            this.classList.add('active'); // Tambahkan kelas 'active' pada link yang diklik
            
            // Tutup sidebar di mobile setelah klik
            if (sidebarWrapper.classList.contains('toggled')) {
                toggleSidebar();
            }
        });

        // Opsional: Tambahkan logika untuk menu lainnya (e.g., Bahasa Indonesia)
        document.querySelector('#collapseBahasa a').addEventListener('click', function(e) {
             // Contoh: muat konten default jika menu lain diklik
             // loadContent(templateDefault);
        });
    });
</script>
</body>
</html>