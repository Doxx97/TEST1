<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Import semua Model yang baru kita buat
use App\Models\TahunPelajaran;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Nilai;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil tahun pelajaran (Sudah kita perbaiki)
        $selectedTahunId = $request->input('tahun_pelajaran', TahunPelajaran::latest()->first()->id ?? null);
        $allTahunPelajaran = TahunPelajaran::orderBy('tahun_pelajaran', 'desc')->get();

        
        // 2. Hitung 4 Kartu Statistik
        $jumlahGuru = Guru::count();
        $jumlahSiswa = Siswa::count();
        $jumlahMapel = Mapel::count();
        $jumlahKelas = Kelas::count(); // <-- INI DIA YANG ERROR


        // 3. Ambil Status Nilai
        $mataPelajaranList = Mapel::with('guru')->get();

        $statusNilai = $mataPelajaranList->map(function ($mapel) use ($selectedTahunId) {
            
            // Pastikan di migrasi Nilai, nama kolomnya 'mapels_id'
            $isTerkirim = Nilai::where('mapels_id', $mapel->id) 
                              ->where('tahun_pelajaran_id', $selectedTahunId) 
                              ->where('status', 'terkirim')
                              ->exists();

            $mapel->status = $isTerkirim ? 'Terkirim' : 'Belum Dikirim';
            return $mapel;
        });

        // 4. Kirim semua variabel ke View
        return view('admin.dashboard', [
            'jumlahGuru' => $jumlahGuru,
            'jumlahSiswa' => $jumlahSiswa,
            'jumlahMapel' => $jumlahMapel,
            'jumlahKelas' => $jumlahKelas, // <-- DAN DIKIRIM KE SINI
            'allTahunPelajaran' => $allTahunPelajaran,
            'selectedTahunId' => $selectedTahunId,
            'statusNilai' => $statusNilai,
        ]);
    }
}