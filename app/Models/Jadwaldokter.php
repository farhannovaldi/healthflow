<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwaldokter extends Model
{
    use HasFactory;

    protected $table = 'jadwal_dokter';

    // Menentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'dokter_id',     // Mengacu ke id dokter
        'hari',          // Hari praktek dokter (Senin, Selasa, dst)
        'jam_mulai',     // Jam mulai praktek dokter
        'jam_selesai',   // Jam selesai praktek dokter
    ];

    // Relasi antara Jadwaldokter dan Dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id'); // Relasi belongsTo untuk dokter
    }
}
