<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalDokter;
use App\Models\Dokter;
use Carbon\Carbon;

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

    public function getJadwal(Request $request)
    {
        $start = $request->query('start'); // Tanggal awal rentang waktu
        $end = $request->query('end');     // Tanggal akhir rentang waktu

        // Ambil rentang tanggal yang diterima
        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse($end);

        // Daftar hari dalam minggu
        $daysOfWeek = [
            'Senin' => Carbon::MONDAY,
            'Selasa' => Carbon::TUESDAY,
            'Rabu' => Carbon::WEDNESDAY,
            'Kamis' => Carbon::THURSDAY,
            'Jumat' => Carbon::FRIDAY,
            'Sabtu' => Carbon::SATURDAY,
            'Minggu' => Carbon::SUNDAY
        ];

        // Ambil jadwal dokter
        $jadwal = JadwalDokter::with('dokter')->get();

        // Filter jadwal dokter berdasarkan rentang waktu dan hari
        $events = collect();

        // Mengulang setiap minggu dalam rentang waktu bulan
        $startDate->startOfMonth(); // Mulai dari awal bulan
        $endDate->endOfMonth(); // Sampai akhir bulan

        while ($startDate <= $endDate) {
            foreach ($jadwal as $item) {
                // Dapatkan tanggal dari hari tertentu dalam minggu
                $hari = $item->hari;
                $dayOfWeek = $daysOfWeek[$hari] ?? null;

                if ($dayOfWeek) {
                    // Tentukan tanggal yang sesuai dengan hari pada minggu itu
                    $dateForDay = $startDate->copy()->next($dayOfWeek);

                    // Pastikan tanggal jatuh dalam rentang waktu
                    if ($dateForDay >= $startDate && $dateForDay <= $endDate) {
                        $events->push([
                            'title' => $item->dokter->nama,
                            'start' => $dateForDay->toDateString() . 'T' . $item->jam_mulai,
                            'end' => $dateForDay->toDateString() . 'T' . $item->jam_selesai,
                            'description' => $item->dokter->nama . ' (' . $item->dokter->spesialis . ')'
                        ]);
                    }
                }
            }
            $startDate->addWeek(); // Pindah ke minggu berikutnya
        }

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
