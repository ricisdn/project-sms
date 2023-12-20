<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $table = 'tbl_orangtuas';
    protected $fillable = [
        'id_user',
        'id_siswa',
        'tgl_lahir',
        'nomor_telepon',
        'jenis_kelamin',
        'alamat',
    ];

    protected function siswa()
    {
        return $this->belongsTo('App\Siswa', 'id_siswa');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
