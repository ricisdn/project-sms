<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'tbl_nilais';

    protected $fillable = [
        'nilai',
        'file',
        'id_mapel',
        'id_siswa',
        'id_kelas',
        'id_pengumpulan'
    ];

    protected function mapel()
    {
        return $this->belongsTo('App\Mapel', 'id_mapel');
    }

    protected function siswa()
    {
        return $this->belongsTo('App\Siswa', 'id_siswa');
    }

    protected function pengumpulan()
    {
        return $this->belongsTo('App\Pengumpulan', 'id_pengumpulan');
    }

    protected function kelas()
    {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }
}
