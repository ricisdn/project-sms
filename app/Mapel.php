<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'tbl_mapels';
    protected $fillable = [
        'id_user',
        'id_kelas',
        'nama_mapel',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    protected function guru()
    {
        return $this->belongsTo('App\Guru', 'id_guru');
    }

    protected function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    protected function kelas()
    {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }
}
