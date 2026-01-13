<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    protected $table = 'sub_kriterias';
    protected $primaryKey = 'id_sub_kriteria';
    protected $fillable = ['id_kriteria', 'nama_sub', 'nilai'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }
}
