<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINILAI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container container-main shadow rounded d-flex">
    
    <!-- KOTAK KIRI -->
    <div class="col-5 left-box d-flex justify-content-center align-items-center">
        <img src="{{ asset('img/SD.png') }}" alt="Logo SINILAI" class="img-fluid" style="max-width: 80%;">
    </div>
    <!-- KONTEN KANAN -->
   <div class="right-content">
    <h3 class="fw-bold">Selamat Datang di SINILAI</h3>
    <p class="text-secondary">Silahkan pilih anda login sebagai apa</p>

    @if(session('error'))
        <div class="alert alert-danger py-2 mt-3">{{ session('error') }}</div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger py-2 mt-3">
            Peran belum dipilih. Silahkan coba lagi.
        </div>
    @endif

    <!-- PERBAIKAN 1: Form action diarahkan ke route POST -->
    <form action="{{ route('login.role.submit') }}" method="POST">
        @csrf
        
        <select class="form-select select-box mt-3" name="role" aria-label="Pilih Peran">
            <option value="" selected disabled>Pilih Peran</option>
            <!-- PERBAIKAN 2: VALUE disamakan dengan switch case di Controller -->
            <option value="guru">Guru</option>
            <option value="wali">Wali Murid</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit" class="btn btn-custom mt-4">Konfirmasi</button>
    </form>
</div>
</div>

</body>
</html>