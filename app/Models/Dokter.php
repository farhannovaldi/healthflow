<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';

    protected $fillable = [
        'nama',
        'spesialis',
        'telepon',
        'email',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwaldokter::class);
    }

    public function kunjunganPasien()
    {
        return $this->hasMany(Pasienvisit::class);
    }
}
