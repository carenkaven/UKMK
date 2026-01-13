<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    protected $table = 'ukms';
    protected $primaryKey = 'id_ukm';

    protected $fillable = ['nama_ukm', 'deskripsi', 'ketua_ukm', 'gambar', 'jadwal', 'prestasi', 'kontak'];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_ukm', 'id_ukm');
    }
}
