<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasienvisit;
use App\Models\Pasien;
use App\Models\Dokter;

class PasienvisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Pasienvisit::with(['pasien', 'dokter']);

            // Pencarian
            if (!empty($request->search['value'])) {
                $search = $request->search['value'];
                $query->whereHas('pasien', function ($q) use ($search) {
                    $q->where('nama', 'like', "%$search%");
                })->orWhereHas('dokter', function ($q) use ($search) {
                    $q->where('nama', 'like', "%$search%");
                })->orWhere('keluhan', 'like', "%$search%")
                    ->orWhere('diagnosis', 'like', "%$search%");
            }

            // Total data sebelum filter
            $totalData = Pasienvisit::count();

            // Pagination dan sorting
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;
            $columnIndex = $request->order[0]['column'] ?? 0;
            $columnName = $request->columns[$columnIndex]['data'] ?? 'id';
            $columnSortOrder = $request->order[0]['dir'] ?? 'asc';

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
        $pasien = Pasien::all(); // Mengambil se    mua data pasien
        $dokter = Dokter::all(); // Pastikan data dokter juga disediakan
        return view('pasienvisit.index', compact('pasien', 'dokter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pasien = Pasien::all();
        $dokter = Dokter::all();
        return view('pasienvisit.create', compact('pasien', 'dokter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'tindakan' => 'nullable|string',
        ]);

        Pasienvisit::create($validatedData);

        return response()->json(['message' => 'Data kunjungan pasien berhasil ditambahkan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pasienVisit = PasienVisit::with(['pasien', 'dokter'])->findOrFail($id);
        return response()->json($pasienVisit);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pasienvisit = Pasienvisit::findOrFail($id);
        $pasien = Pasien::all();
        $dokter = Dokter::all();

        return view('pasienvisit.edit', compact('pasienvisit', 'pasien', 'dokter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:dokter,id',
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'tindakan' => 'nullable|string',
        ]);

        $pasienvisit = Pasienvisit::findOrFail($id);
        $pasienvisit->update($validatedData);

        return response()->json(['message' => 'Data kunjungan pasien berhasil diperbarui!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $pasienvisit = Pasienvisit::findOrFail($id);
            $pasienvisit->delete();

            return response()->json(['success' => true, 'message' => 'Data kunjungan pasien berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }
}
