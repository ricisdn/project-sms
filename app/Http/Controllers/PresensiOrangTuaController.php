<?php

namespace App\Http\Controllers;

use App\Mapel;
use App\Presensi;
use App\Siswa;
use App\OrangTua;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PresensiOrangTuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orangtua = OrangTua::where('id_user', Auth::user()->id)->first();
        $siswa = Siswa::where('id', $orangtua->id_siswa)->first();

        if ($orangtua) {
            $presensi = Presensi::where('id_user', $orangtua->siswa->id_user)->get();
            $hadir = Presensi::select('status', DB::raw('COUNT(*) as Jumlah_Data'))
                ->where('id_user', $orangtua->siswa->id_user)
                ->where('status', 'Hadir')
                ->groupBy('status')
                ->get();
            $izin = Presensi::select('status', DB::raw('COUNT(*) as Jumlah_Data'))
                ->where('id_user', $orangtua->siswa->id_user)
                ->where('status', 'Izin')
                ->groupBy('status')
                ->get();
            $sakit = Presensi::select('status', DB::raw('COUNT(*) as Jumlah_Data'))
                ->where('id_user', $orangtua->siswa->id_user)
                ->where('status', 'Sakit')
                ->groupBy('status')
                ->get();
            $alpa = Presensi::select('status', DB::raw('COUNT(*) as Jumlah_Data'))
                ->where('id_user', $orangtua->siswa->id_user)
                ->where('status', 'Alpa')
                ->groupBy('status')
                ->get();
        } else {
            $presensi = collect();
        }
        return view('orangtua.presensi.index', [
            'siswa' => $siswa,
            'presensi' => $presensi,
            'hadir' => $hadir,
            'izin' => $izin,
            'sakit' => $sakit,
            'alpa' => $alpa
        ]);
    }
}