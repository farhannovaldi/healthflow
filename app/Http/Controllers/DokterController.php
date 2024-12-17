<?php
namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Dokter::query(); // Menggunakan model Eloquent

            // Pencarian
            if (!empty($request->search['value'])) {
                $search = $request->search['value'];
                $query->where('nama', 'like', "%$search%")
                    ->orWhere('spesialis', 'like', "%$search%")
                    ->orWhere('telepon', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            }

            // Total data sebelum filter
            $totalData = Dokter::count();

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

        return view('dokter.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk menambahkan Dokter baru
        return view('dokter.create');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data Dokter berdasarkan ID
        $Dokter = Dokter::findOrFail($id);

        // Tampilkan detail Dokter
        return view('dokter.show', compact('dokter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data Dokter berdasarkan ID
        $Dokter = Dokter::findOrFail($id);

        // Tampilkan form edit
        return view('dokter.edit', compact('dokter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        Dokter::create($validated);

        return response()->json(['message' => 'Data dokter berhasil ditambahkan!']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $dokter = Dokter::findOrFail($id);
        $dokter->update($validated);

        return response()->json(['message' => 'Data dokter berhasil diperbarui!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data Dokter
        $Dokter = Dokter::findOrFail($id);
        $Dokter->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil dihapus.');
    }
}
