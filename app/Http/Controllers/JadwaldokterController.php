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
    public function getAllJadwal()
    {
        $dokter = Dokter::all();

        return view('jadwaldokter.getAllJadwalDokter', compact('dokter'));
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Query dengan join untuk mengambil data dari tabel dokter
            $query = JadwalDokter::join('dokter', 'dokter.id', '=', 'jadwal_dokter.doctor_id')
                ->select('jadwal_dokter.*', 'dokter.nama', 'dokter.spesialis', 'dokter.telepon', 'dokter.email');

            // Pencarian
            if (!empty($request->search['value'])) {
                $search = $request->search['value'];
                $query->where('nama', 'like', "%$search%")
                    ->orWhere('hari', 'like', "%$search%")
                    ->orWhere('jam_mulai', 'like', "%$search%")
                    ->orWhere('jam_selesai', 'like', "%$search%");
            }

            // Total data sebelum filter
            $totalData = JadwalDokter::count();

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
        $request->validate([
            'dokter_id' => 'required|exists:dokter,id',
            'hari' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        JadwalDokter::create([
            'doctor_id' => $request->dokter_id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json(['message' => 'Jadwal dokter berhasil ditambahkan!'], 201);
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
    public function update(Request $request, $id)
    {
        $jadwal = JadwalDokter::findOrFail($id);

        $request->validate([
            'dokter_id' => 'required|exists:dokter,id',
            'hari' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $jadwal->update([
            'doctor_id' => $request->dokter_id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'updated_at' => Carbon::now(),
        ]);

        return response()->json(['message' => 'Jadwal dokter berhasil diperbarui!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Hapus data Dokter
            $jadwalDokter = JadwalDokter::findOrFail($id);
            $jadwalDokter->delete();

            // Respons dalam format JSON jika request datang dari AJAX
            return response()->json(['success' => true, 'message' => 'Data dokter berhasil dihapus.']);
        } catch (\Exception $e) {
            // Respons jika terjadi kesalahan
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }
}
