<?php

namespace App\Http\Controllers;

use App\Mapel;
use App\Presensi;
use App\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PresensiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::where('id_user', Auth::user()->id)->first();

        if ($siswa) {
            $presensi = Presensi::where('id_user', Auth::user()->id)->get();
            $hadir = Presensi::select('status', DB::raw('COUNT(*) as Jumlah_Data'))
                ->where('id_user', Auth::user()->id)
                ->where('status', 'Hadir')
                ->groupBy('status')
                ->get();
            $izin = Presensi::select('status', DB::raw('COUNT(*) as Jumlah_Data'))
                ->where('id_user', Auth::user()->id)
                ->where('status', 'Izin')
                ->groupBy('status')
                ->get();
            $sakit = Presensi::select('status', DB::raw('COUNT(*) as Jumlah_Data'))
                ->where('id_user', Auth::user()->id)
                ->where('status', 'Sakit')
                ->groupBy('status')
                ->get();
            $alpa = Presensi::select('status', DB::raw('COUNT(*) as Jumlah_Data'))
                ->where('id_user', Auth::user()->id)
                ->where('status', 'Alpa')
                ->groupBy('status')
                ->get();
        } else {
            $presensi = collect();
            $hadir = collect();
            $izin = collect();
            $sakit = collect();
            $alpa = collect();
        }
        return view('siswa.presensi.index', [
            'presensi' => $presensi,
            'hadir' => $hadir,
            'izin' => $izin,
            'sakit' => $sakit,
            'alpa' => $alpa
        ]);
    }
}