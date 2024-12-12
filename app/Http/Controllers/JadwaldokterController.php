<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalDokter;
use App\Models\Dokter;

class JadwalDokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dokter = Dokter::all();
        if ($request->ajax()) {
            $query = JadwalDokter::with('dokter');

            // Pencarian
            if (!empty($request->search['value'])) {
                $search = $request->search['value'];
                $query->whereHas('dokter', function ($q) use ($search) {
                    $q->where('nama', 'like', "%$search%")
                        ->orWhere('spesialis', 'like', "%$search%")
                        ->orWhere('telepon', 'like', "%$search%");
                });
            }

            // Total data sebelum filter
            $totalData = JadwalDokter::count();

            // Pagination dan sorting
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;
            $columnIndex = $request->order[0]['column'] ?? 0;
            $columnName = $request->columns[$columnIndex]['data'] ?? 'id';
            $columnSortOrder = $request->order[0]['dir'] ?? 'asc';

            // Fallback jika kolom tidak valid
            if (!in_array($columnName, ['id', 'hari', 'jam_mulai', 'jam_selesai'])) {
                $columnName = 'id';
            }

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

        return view('jadwaldokter.index', compact('dokter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dokter = Dokter::all(); // Ambil semua dokter
        return view('jadwaldokter.create', compact('dokter')); // Kirim ke view
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'dokter_id' => 'required|exists:dokter,id',
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s|after:jam_mulai',
        ]);

        // Menyimpan jadwal dokter
        $jadwal = JadwalDokter::create($validatedData);

        // Mengembalikan data jadwal dalam format JSON
        return response()->json($jadwal, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jadwalDokter = JadwalDokter::with('dokter')->findOrFail($id);
        return view('jadwaldokter.show', compact('jadwalDokter'));
    }
    public function getJadwal()
    {
        // Mengambil jadwal dokter beserta informasi dokter yang terkait
        $jadwalDokter = JadwalDokter::with('dokter')->get();

        // Mengonversi data ke format yang diinginkan oleh FullCalendar
        $events = $jadwalDokter->map(function ($jadwal) {
            return [
                'title' => $jadwal->dokter->nama . ' - ' . $jadwal->hari,
                'start' => $jadwal->jam_mulai,
                'end' => $jadwal->jam_selesai,
                'description' => 'Dokter: ' . $jadwal->dokter->nama . '\n' . 'Hari: ' . $jadwal->hari
            ];
        });

        // Mengembalikan data dalam format JSON
        return response()->json($events);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwalDokter = JadwalDokter::findOrFail($id);
        $dokter = Dokter::all(); // Ambil semua dokter
        return view('jadwaldokter.edit', compact('jadwalDokter', 'dokter')); // Kirim ke view
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'dokter_id' => 'required|exists:dokter,id',
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s|after:jam_mulai',
        ]);

        $jadwalDokter = JadwalDokter::findOrFail($id);
        $jadwalDokter->update($validatedData);

        return redirect()->route('jadwaldokter.index')->with('success', 'Jadwal dokter berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwalDokter = JadwalDokter::findOrFail($id);
        $jadwalDokter->delete();

        return redirect()->route('jadwaldokter.index')->with('success', 'Jadwal dokter berhasil dihapus.');
    }
}
