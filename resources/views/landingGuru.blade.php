<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Guru - SINILAI</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">


</head>
<body>

<div class="container container-main shadow rounded">

<!-- KOTAK KIRI (Warna Hijau) -->
<div class="col-5 left-box d-flex justify-content-center align-items-center">
    <img src="{{ asset('img/SD.png') }}" alt="Logo SINILAI" class="img-fluid" style="max-width: 80%;">
</div>
<!-- KONTEN KANAN (Form Login Guru) -->
<div class="right-content">
    <h3 class="fw-bold">Selamat Datang di SINILAI</h3>
    <p class="text-secondary mb-4">Silahkan login menggunakan akun Guru Anda</p>

    <form method="POST" action="{{ route('guru.login.submit') }}">
        @csrf
        <div class="mb-3">
            <label for="nipsn" class="form-label">Nama atau NIPSN</label>
            <input type="text" class="form-control form-control-custom @error('nipsn') is-invalid @enderror" 
            id="nipsn" name="nipsn" placeholder="Masukkan Nama atau NIPSN" required>
            @error('nipsn')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control form-control-custom @error('password') is-invalid @enderror" 
            id="password" name="password" placeholder="Masukkan Password" required>
        </div>
        @error('password')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="true" id="rememberMe" name="rememberMe">
                <label class="form-check-label" for="rememberMe">
                    Ingat Saya
                </label>
            </div>
            <a href="#" class="forgot-password-link">Lupa Password?</a>
        </div>

        <button type="submit" class="btn btn-custom w-100">LOGIN</button>
        <p class="text-center mt-3 text-sm">Kembali ke <a href="{{ route('landing') }}" class="forgot-password-link">Pilih Peran</a></p>
    </form>
</div>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap%405.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>