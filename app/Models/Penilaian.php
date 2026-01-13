<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaians';
    protected $primaryKey = 'id_penilaian';
    protected $fillable = ['id_mahasiswa', 'id_kriteria', 'id_sub_kriteria', 'nilai'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }

    public function subKriteria()
    {
        return $this->belongsTo(SubKriteria::class, 'id_sub_kriteria', 'id_sub_kriteria');
    }
}
