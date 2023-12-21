<?php

namespace App\Http\Controllers;

use App\Nilai;
use App\Mapel;
use App\Siswa;
use App\OrangTua;
use App\Pengumpulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiOrangTuaController extends Controller
{
    public function index()
    {
        $orangtua = OrangTua::where('id_user', Auth::user()->id)->first();

        if ($orangtua) {
            $siswa = Siswa::where('id', $orangtua->id_siswa)->first();

            if ($siswa) {
                $nilai = Pengumpulan::where('id_user', $siswa->id_user)->get();
            } else {
                $nilai = collect();
            }
        } else {
            $nilai = collect();
            $siswa = null;
        }

        return view('orangtua.nilai.index', compact('nilai', 'siswa'));
    }
}
