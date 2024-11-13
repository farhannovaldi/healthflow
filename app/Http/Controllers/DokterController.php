<?php
namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    // Menampilkan daftar dokter
    public function index()
    {
        $dokters = Dokter::all();
        return view('dokter.index', compact('dokters'));
    }

    // Menampilkan form untuk membuat dokter baru
    public function create()
    {
        return view('dokter.create');
    }

    // Menyimpan data dokter baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
        ]);

        Dokter::create($request->all());

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil ditambahkan');
    }

    // Menampilkan detail dokter
    public function show($id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('dokter.show', compact('dokter'));
    }

    // Menampilkan form untuk mengedit dokter
    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('dokter.edit', compact('dokter'));
    }

    // Memperbarui data dokter
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
        ]);

        $dokter = Dokter::findOrFail($id);
        $dokter->update($request->all());

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil diperbarui');
    }

    // Menghapus dokter
    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil dihapus');
    }
}
