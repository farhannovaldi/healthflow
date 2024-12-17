<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Pasien::query(); // Menggunakan model Eloquent

            // Pencarian
            if (!empty($request->search['value'])) {
                $search = $request->search['value'];
                $query->where('nama', 'like', "%$search%")
                    ->orWhere('alamat', 'like', "%$search%")
                    ->orWhere('telepon', 'like', "%$search%");
            }

            // Total data sebelum filter
            $totalData = Pasien::count();

            // Pagination dan sorting
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;
            $columnIndex = $request->order[0]['column'] ?? 0; // Index kolom untuk sorting
            $columnName = $request->columns[$columnIndex]['data'] ?? 'id'; // Nama kolom untuk sorting
            $columnSortOrder = $request->order[0]['dir'] ?? 'asc'; // Urutan sorting

            $data = $query
                ->orderBy($columnName, $columnSortOrder)
                ->skip($start)
                ->take($length)
                ->get();

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => $totalData,
                'recordsFiltered' => $query->count(),
                'data' => $data
            ]);
        }

        return view('pasien.index');
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
        return response()->json(['message' => 'Data dokter berhasil ditambahkan!']);
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


        return response()->json(['message' => 'Data pasien berhasil diperbarui!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Hapus data Dokter
            $pasien = Pasien::findOrFail($id);
            $pasien->delete();

            // Respons dalam format JSON jika request datang dari AJAX
            return response()->json(['success' => true, 'message' => 'Data pasien berhasil dihapus.']);
        } catch (\Exception $e) {
            // Respons jika terjadi kesalahan
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }
}
