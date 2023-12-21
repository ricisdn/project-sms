<?php

namespace App\Http\Controllers;

use App\Mapel;
use App\Nilai;
use App\Presensi;
use App\Siswa;
use App\OrangTua;
use App\Pengumpulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardOrangTuaController extends Controller
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
        $orangtua = OrangTua::where('id_user', Auth::user()->id)->first();
        if($orangtua){
            $siswa = Siswa::where('id', $orangtua->id_siswa)->first();
            $mapel = Mapel::where('id_kelas', $siswa->id_kelas)->get();
            $presensi = Presensi::where('id_user', $orangtua->siswa->id_user)->get();
            $nilai = Pengumpulan::where('id_user', $orangtua->siswa->id_user)->get();
        } else {
            $mapel = collect();
            $nilai = collect();
            $presensi = collect();
        }
        return view('dashboard-orangtua', [
            'mapel' => $mapel,
            'nilai' => $nilai,
            'presensi' => $presensi
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
