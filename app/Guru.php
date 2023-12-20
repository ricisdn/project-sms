<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'tbl_gurus';

    protected $fillable = [
        'nama',
        'umur',
        'nomor_telepon',
        'jenis_kelamin',
        'alamat',
        'status',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
