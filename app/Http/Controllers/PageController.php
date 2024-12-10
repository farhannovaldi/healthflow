<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use App\Models\Obat;
use App\Models\HistoryPasien;
use App\Models\Pasienvisit;

class PageController extends Controller
{
    public function dataPasien() {
        $pasien = Pasien::all();
        return view('pages.data-pasien', compact('pasien'));
    }

    public function dataDokter() {
        $dokter = Dokter::all();
        return view('pages.data-dokter', compact('dokter'));
    }

    public function jadwalDokter() {
        $jadwal = JadwalDokter::all();
        return view('pages.jadwal-dokter', compact('jadwal'));
    }

    public function dataObat() {
        $obat = Obat::all();
        return view('pages.data-obat', compact('obat'));
    }

    public function historyPasien() {
        $history = Pasienvisit::all();
        return view('pages.history-pasien', compact('history'));
    }
}
