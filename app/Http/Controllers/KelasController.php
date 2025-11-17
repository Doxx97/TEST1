<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $semuaKelas = Kelas::orderBy('nama_kelas', 'asc')->paginate(10);
        return view('admin.kelas.index', compact('semuaKelas'));
    }

    public function create()
    {
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:50|unique:kelas',
        ]);

        Kelas::create($validated);
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kela) // Nama variabel harus $kela
    {
        return view('admin.kelas.edit', ['kela' => $kela]);
    }

    public function update(Request $request, Kelas $kela) // Nama variabel harus $kela
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:50|unique:kelas,nama_kelas,' . $kela->id,
        ]);

        $kela->update($validated);
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kela) // Nama variabel harus $kela
    {
        try {
            $kela->delete();
            return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->with('error', 'Gagal menghapus, kelas mungkin digunakan oleh data siswa.');
        }
    }
}