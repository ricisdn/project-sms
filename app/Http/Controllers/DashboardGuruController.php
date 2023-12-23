<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Mapel;
use App\Siswa;
use App\Kelas;
use App\Tugas;
use App\Pengumpulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardGuruController extends Controller
{
    public function index()
    {
        $guru = Guru::where('id_user', Auth::user()->id)->first();
        if ($guru) {
            $mapel = Mapel::where('id_user', $guru->id_user)->get();
            $siswa = Siswa::join('tbl_kelass', 'tbl_siswas.id_kelas', '=', 'tbl_kelass.id')
                ->join('tbl_mapels', 'tbl_mapels.id_kelas', '=', 'tbl_kelass.id')
                ->where('tbl_mapels.id_user', $guru->id_user)
                ->groupBy('tbl_siswas.id')
                ->pluck('tbl_siswas.id');
            $kelas = Kelas::join('tbl_mapels', 'tbl_kelass.id', '=', 'tbl_mapels.id_kelas')
                ->where('tbl_mapels.id_user', $guru->id_user)
                ->groupBy('tbl_kelass.id')
                ->pluck('tbl_kelass.id');
            $tugas = Tugas::join('tbl_mapels', 'tbl_tugass.id_mapel', '=', 'tbl_mapels.id')
                ->where('tbl_mapels.id_user', $guru->id_user)
                ->groupBy('tbl_tugass.id')
                ->pluck('tbl_tugass.id');
            $pengumpulan = Pengumpulan::join('tbl_mapels', 'tbl_pengumpulans.id_mapel', '=', 'tbl_mapels.id')
                ->where('tbl_mapels.id_user', $guru->id_user)
                ->groupBy('tbl_pengumpulans.id')
                ->pluck('tbl_pengumpulans.id');

            // Menghitung jumlah pengumpulan untuk di tracking di Diagram
            $submissionData = Pengumpulan::selectRaw("MONTH(created_at) as month, COUNT(*) as count")
                ->groupBy('month')
                ->get();

            $months = [];
            $submissions = [];

            if ($submissionData->isNotEmpty()) {
                foreach ($submissionData as $data) {
                    $months[] = date("F", mktime(0, 0, 0, $data->month, 1));
                    $submissions[] = $data->count;
                }
            }
        } else {
            $mapel = collect();
            $siswa = collect();
            $kelas = collect();
            $pengumpulan = collect();
            $tugas = collect();
            $months = [];
            $submissions = [];
        }

        return view('dashboard-guru', compact('siswa', 'mapel', 'kelas', 'tugas', 'pengumpulan', 'months', 'submissions'));
    }
}
