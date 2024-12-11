<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'alamat',
        'telepon',
        'jenis_kelamin',
        'golongan_darah',
    ];

    public function kunjungan()
    {
        return $this->hasMany(Pasienvisit::class);
    }
}
