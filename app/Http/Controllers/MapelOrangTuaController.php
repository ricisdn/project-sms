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
    public function index()
    {
        $orangtua = OrangTua::where('id_user', Auth::user()->id)->first();

        if ($orangtua) {
            $siswa = Siswa::where('id', $orangtua->id_siswa)->first();

            if ($siswa) {
                $mapel = Mapel::where('id_kelas', $siswa->id_kelas)->get();
            } else {
                $mapel = collect();
                $siswa = null;
            }
        } else {
            $mapel = collect();
            $siswa = null;
        }

        return view('orangtua.jadwal.index', compact('mapel', 'siswa'));
    }
}


