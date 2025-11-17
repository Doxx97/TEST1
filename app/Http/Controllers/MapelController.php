<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Guru; // <-- PENTING: Import Model Guru
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        // Ambil data mapel DAN data guru yang terkait (Eager Loading)
        $semuaMapel = Mapel::with('guru')->orderBy('nama', 'asc')->paginate(10);
        return view('admin.mapel.index', compact('semuaMapel'));
    }

    public function create()
    {
        // Ambil daftar guru untuk mengisi dropdown
        $semuaGuru = Guru::orderBy('nama', 'asc')->get();
        return view('admin.mapel.create', compact('semuaGuru'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:mapels',
            'guru_id' => 'required|exists:gurus,id', // Pastikan guru_id ada di tabel gurus
        ]);

        Mapel::create($validated);
        return redirect()->route('mapel.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit(Mapel $mapel)
    {
        // Ambil daftar guru untuk dropdown
        $semuaGuru = Guru::orderBy('nama', 'asc')->get();
        return view('admin.mapel.edit', compact('mapel', 'semuaGuru'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:mapels,nama,' . $mapel->id,
            'guru_id' => 'required|exists:gurus,id',
        ]);

        $mapel->update($validated);
        return redirect()->route('mapel.index')->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel)
    {
        try {
            $mapel->delete();
            return redirect()->route('mapel.index')->with('success', 'Mata pelajaran berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('mapel.index')->with('error', 'Gagal menghapus, mapel mungkin terhubung ke data nilai.');
        }
    }
}