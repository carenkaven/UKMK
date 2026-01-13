<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';
    protected $primaryKey = 'id_mahasiswa';

    protected $fillable = ['nama', 'nim', 'email', 'telepon', 'gender', 'agama', 'prodi', 'fakultas', 'angkatan', 'foto', 'password'];

    protected $hidden = ['password'];
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
