<?php

namespace App\Http\Controllers;

use App\Mapel;
use App\Tugas;
use App\Presensi;
use App\Siswa;
use App\Pengumpulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $siswa = Siswa::where('id_user', Auth::user()->id)->first();
        if ($siswa) {
            $mapel = Mapel::where('id_kelas', $siswa->id_kelas)->get();
            $pengumpulan = Pengumpulan::where('id_user', Auth::user()->id)->get();
            $tugas = Tugas::where('id_kelas', $siswa->id_kelas)->get();
            $presensi = Presensi::where('id_user', Auth::user()->id)->get();
        } else {
            $mapel = collect();
            $pengumpulan = collect();
            $tugas = collect();
            $presensi = collect();
        }
        return view('dashboard-siswa', [
            'mapel' => $mapel,
            'tugas' => $tugas,
            'pengumpulan' => $pengumpulan,
            'presensi' => $presensi
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
