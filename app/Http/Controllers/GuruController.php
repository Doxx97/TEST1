<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    // ... (fungsi index(), create(), store() Anda sudah benar) ...
    
    public function index()
    {
        $semuaGuru = Guru::orderBy('nama', 'asc')->paginate(10);
        return view('admin.guru.index', compact('semuaGuru'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        // 3. VALIDASI BARU (Tambahkan 'nuptk' dan 'email' jika ada di form)
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nipsn' => 'required|string|max:20|unique:gurus,nipsn', 
            'nuptk' => 'nullable|string|max:20|unique:gurus,nuptk', // Asumsi Anda menambah ini di form
            'email' => 'required|email|max:255|unique:gurus,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        Guru::create($validated);
        
        return redirect()->route('guru.index')->with('success', 'Akun guru berhasil dibuat.');
    }

    public function edit(Guru $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }


    /**
     * Menyimpan guru LAMA (Update)
     * INI ADALAH FUNGSI YANG DIPERBAIKI
     */
    public function update(Request $request, Guru $guru)
    {
        // 6. VALIDASI UPDATE BARU (Gunakan $guru->nipsn atau $guru->getKey())
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nipsn' => 'required|string|max:20|unique:gurus,nipsn,' . $guru->getKey(), // <-- PERBAIKAN
            'nuptk' => 'nullable|string|max:20|unique:gurus,nuptk,' . $guru->getKey(), // <-- PERBAIKAN (jika ada)
            'email' => 'required|email|max:255|unique:gurus,email,' . $guru->getKey(), // <-- PERBAIKAN
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // 7. LOGIKA UPDATE PASSWORD (JIKA DIISI)
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // 8. UPDATE DATA
        $guru->update($validated);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        try {
            $guru->delete();
            return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('guru.index')->with('error', 'Gagal menghapus, guru mungkin terhubung ke data mapel.');
        }
    }
}