<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasienvisit extends Model
{
    use HasFactory;

    protected $table = 'pasien_visit';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'tanggal_kunjungan',
        'keluhan',
        'diagnosis',
        'tindakan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
