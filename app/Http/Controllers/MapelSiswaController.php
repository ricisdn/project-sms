<?php

namespace App\Http\Controllers;

use App\Mapel;
use App\Guru;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapelSiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::where('id_user', Auth::user()->id)->first();

        if ($siswa) {
            $mapel = Mapel::where('id_kelas', $siswa->id_kelas)->get();
        } else {
            $mapel = collect();
        }
        return view('siswa.jadwal.index', compact('mapel'));
    }
}
