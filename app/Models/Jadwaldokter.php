<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwaldokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokter_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
