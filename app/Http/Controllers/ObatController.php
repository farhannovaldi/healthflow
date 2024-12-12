<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Obat::query(); // Menggunakan model Eloquent

            // Pencarian
            if (!empty($request->search['value'])) {
                $search = $request->search['value'];
                $query->where('nama_obat', 'like', "%$search%")
                    ->orWhere('jenis', 'like', "%$search%")
                    ->orWhere('stok', 'like', "%$search%")
                    ->orWhere('dosis', 'like', "%$search%")
                    ->orWhere('harga', 'like', "%$search%");
            }

            // Total data sebelum filter
            $totalData = Obat::count();

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

        return view('obat.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk menambahkan obat baru
        return view('obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'jenis' => 'required|string',
            'stok' => 'required|string',
            'dosis' => 'required|string',
            'harga' => 'required|int',
        ]);

        // Simpan data ke database
        Obat::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data obat berdasarkan ID
        $obat = Obat::findOrFail($id);

        // Tampilkan detail obat
        return view('obat.show', compact('obat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data obat berdasarkan ID
        $obat = Obat::findOrFail($id);

        // Tampilkan form edit
        return view('obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'jenis' => 'required|string',
            'stok' => 'required|string',
            'dosis' => 'required|string',
            'harga' => 'required|int',
        ]);

        // Cari data obat dan perbarui
        $obat = Obat::findOrFail($id);
        $obat->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('obat.index')->with('success', 'Data obat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data obat
        $obat = Obat::findOrFail($id);
        $obat->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus.');
    }
}
