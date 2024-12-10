<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data pasien dari database
        $pasiens = Pasien::all();

        // Kirim data ke view
        return view('pasien.index', compact('pasiens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk menambahkan pasien baru
        return view('pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
        ]);

        // Simpan data ke database
        Pasien::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data pasien berdasarkan ID
        $pasien = Pasien::findOrFail($id);

        // Tampilkan detail pasien
        return view('pasien.show', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data pasien berdasarkan ID
        $pasien = Pasien::findOrFail($id);

        // Tampilkan form edit
        return view('pasien.edit', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
        ]);

        // Cari data pasien dan perbarui
        $pasien = Pasien::findOrFail($id);
        $pasien->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data pasien
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil dihapus.');
    }
}
