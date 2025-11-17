<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SINILAI - Login Wali</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-custom-green: #658C58; 
        }
        .bg-custom-green {
            background-color: var(--bs-custom-green) !important;
        }
        body {
            background-color: #f0f2f5;
        }
    </style>
</head>
<body>
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-custom-green text-white text-center p-3">
                    <h4 class="fw-bold mb-0">LOGIN WALI</h4>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    <form action="{{ route('wali.login.submit') }}" method="POST">
                        @csrf
                        
                        @error('nisn_siswa')
                            <div class="alert alert-danger p-2 small">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="mb-3">
                            <label for="nisn_siswa" class="form-label">NISN Siswa (ID Wali)</label>
                            <input type="text" class="form-control" id="nisn_siswa" name="nisn_siswa" value="{{ old('nisn_siswa') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn bg-custom-green text-white fw-bold">Login</button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('landing') }}" class="text-decoration-none small">Kembali ke Halaman Utama</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>