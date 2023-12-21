<?php

namespace App\Http\Controllers;

use App\Nilai;
use App\Mapel;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pengumpulan;

class NilaiSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        $siswa = Siswa::where('id_user', $user)->first();

        if ($siswa) {
            $pengumpulan = Pengumpulan::where('id_user', $siswa->id_user)->get();
        } else {
            $pengumpulan = collect();
        }
        return view('siswa.nilai.index', compact('pengumpulan'));
    }
}
