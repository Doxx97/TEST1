<?php

namespace App\Http\Controllers;

use App\Models\TahunPelajaran; // Model sudah di-import otomatis
use Illuminate\Http\Request;

class TahunPelajaranController extends Controller
{
    /**
     * Menampilkan daftar tahun pelajaran. (READ)
     */
    public function index()
    {
        // Ambil semua data, urutkan, dan bagi per 10 data per halaman
        $semuaTahun = TahunPelajaran::orderBy('tahun_pelajaran', 'desc')->paginate(10);
        
        // Kirim data ke view di folder admin/tahun_pelajaran/index.blade.php
        return view('admin.tahun_pelajaran.index', compact('semuaTahun'));
    }

    /**
     * Menampilkan form tambah baru. (CREATE PAGE)
     */
    public function create()
    {
        return view('admin.tahun_pelajaran.create');
    }

    /**
     * Menyimpan data baru. (CREATE ACTION)
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $validated = $request->validate([
            'tahun_pelajaran' => 'required|string|max:10|unique:tahun_pelajarans', // Pastikan unik
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        // 2. Simpan ke database
        TahunPelajaran::create($validated);

        // 3. Kembali ke halaman daftar dengan pesan sukses
        return redirect()->route('tahun-pelajaran.index')->with('success', 'Tahun pelajaran berhasil ditambahkan.');
    }

    /**
     * Menampilkan data yang tidak terpakai.
     * Kita tidak pakai ini, jadi biarkan kosong atau hapus.
     */
    public function show(TahunPelajaran $tahunPelajaran)
    {
        //
    }

    /**
     * Menampilkan form edit. (UPDATE PAGE)
     */
    public function edit(TahunPelajaran $tahunPelajaran)
    {
        // $tahunPelajaran otomatis diambil berdasarkan ID di URL
        return view('admin.tahun_pelajaran.edit', compact('tahunPelajaran'));
    }

    /**
     * Menyimpan data yang di-update. (UPDATE ACTION)
     */
    public function update(Request $request, TahunPelajaran $tahunPelajaran)
    {
        // 1. Validasi data
        $validated = $request->validate([
            // Pastikan unik, KECUALI untuk ID dia sendiri
            'tahun_pelajaran' => 'required|string|max:10|unique:tahun_pelajarans,tahun_pelajaran,' . $tahunPelajaran->id,
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        // 2. Update data
        $tahunPelajaran->update($validated);

        // 3. Kembali ke halaman daftar
        return redirect()->route('tahun-pelajaran.index')->with('success', 'Tahun pelajaran berhasil diperbarui.');
    }

    /**
     * Menghapus data. (DELETE)
     */
    public function destroy(TahunPelajaran $tahunPelajaran)
    {
        try {
            $tahunPelajaran->delete();
            return redirect()->route('tahun-pelajaran.index')->with('success', 'Tahun pelajaran berhasil dihapus.');
        } catch (\Exception $e) {
            // Tangkap error jika data terhubung ke tabel lain (Foreign Key)
            return redirect()->route('tahun-pelajaran.index')->with('error', 'Gagal menghapus data, mungkin masih terhubung dengan data nilai atau data lain.');
        }
    }
}