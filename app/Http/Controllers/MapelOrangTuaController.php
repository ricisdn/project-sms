<?php

namespace App\Http\Controllers;

use App\Mapel;
use App\Guru;
use App\Siswa;
use App\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapelOrangTuaController extends Controller
{
    public function index() {
        $orangtua = OrangTua::where('id_user', Auth::user()->id)->first();
        $siswa = Siswa::where('id',  $orangtua->id_siswa)->first();
    
        if ($orangtua) {
            $mapel = Mapel::where('id_kelas', $siswa->id_kelas)->get();
        } else {
            $mapel = collect();
        }
        return view('orangtua.jadwal.index', compact('mapel'));
    }
}