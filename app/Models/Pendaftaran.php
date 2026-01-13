<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftarans';
    protected $primaryKey = 'id_pendaftaran';

    protected $fillable = ['tanggal_daftar', 'status_verifikasi', 'id_mahasiswa', 'id_ukm'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function ukm()
    {
        return $this->belongsTo(Ukm::class, 'id_ukm');
    }
}
