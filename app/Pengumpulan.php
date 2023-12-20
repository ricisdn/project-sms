<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumpulan extends Model
{
    protected $table = 'tbl_pengumpulans';

    protected $fillable = [
        'file',
        'nilai',
        'catatan',
        'id_user',
        'id_mapel',
        'id_tugas',
        'id_kelas',
    ];

    protected function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    protected function mapel()
    {
        return $this->belongsTo('App\Mapel', 'id_mapel');
    }

    protected function tugas()
    {
        return $this->belongsTo('App\Tugas', 'id_tugas');
    }

    protected function kelas()
    {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }
}
