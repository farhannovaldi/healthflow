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
        // Mapping nama hari ke tanggal (untuk contoh minggu ini)
        $hariMap = [
            'Senin' => now()->startOfWeek()->toDateString(),
            'Selasa' => now()->startOfWeek()->addDay(1)->toDateString(),
            'Rabu' => now()->startOfWeek()->addDay(2)->toDateString(),
            'Kamis' => now()->startOfWeek()->addDay(3)->toDateString(),
            'Jumat' => now()->startOfWeek()->addDay(4)->toDateString(),
            'Sabtu' => now()->startOfWeek()->addDay(5)->toDateString(),
            'Minggu' => now()->startOfWeek()->addDay(6)->toDateString(),
        ];

        $jadwal = JadwalDokter::with('dokter')->get();

        $response = $jadwal->map(function ($item) use ($hariMap) {
            $tanggal = $hariMap[$item->hari] ?? now()->toDateString(); // Pastikan tanggal sesuai hari

            return [
                'title' => $item->dokter->nama . ' (' . $item->jam_mulai . '-' . $item->jam_selesai . ')',
                'start' => $tanggal . 'T' . $item->jam_mulai,
                'end' => $tanggal . 'T' . $item->jam_selesai,
                'description' => "Dokter: {$item->dokter->nama}\nHari: {$item->hari}\nJam: {$item->jam_mulai} - {$item->jam_selesai}",
            ];
        });

        return response()->json($response);
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
