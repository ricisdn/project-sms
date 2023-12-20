<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'tbl_presensis';

    protected $fillable = [
        'id_siswa',
        'id_mapel',
        'id_user',
    ];

    protected function siswa()
    {
        return $this->belongsTo('App\Siswa', 'id_siswa');
    }

    protected function mapel()
    {
        return $this->belongsTo('App\Mapel', 'id_mapel');
    }

    protected function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
