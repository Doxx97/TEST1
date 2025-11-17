<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas; // <-- Tambahkan ini
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil siswa DAN data kelasnya (Eager Loading)
        $semuaSiswa = Siswa::with('kelas')->orderBy('nama', 'asc')->paginate(10);
        return view('admin.siswa.index', compact('semuaSiswa'));
    }

    public function create()
    {
        // Ambil daftar kelas untuk dropdown
        $semuaKelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        return view('admin.siswa.create', compact('semuaKelas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'nullable|string|max:15|unique:siswas',
            'kelas_id' => 'required|exists:kelas,id', // Pastikan kelas_id ada di tabel kelas
        ]);

        Siswa::create($validated);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        // Ambil daftar kelas untuk dropdown
        $semuaKelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        return view('admin.siswa.edit', compact('siswa', 'semuaKelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'nullable|string|max:15|unique:siswas,nisn,' . $siswa->id,
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa->update($validated);
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        try {
            $siswa->delete();
            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('siswa.index')->with('error', 'Gagal menghapus, siswa mungkin terhubung ke data nilai.');
        }
    }
}