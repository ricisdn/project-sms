<?php

namespace App\Http\Controllers;
use App\Mapel;
use App\Jadwal;
use App\Guru;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function indexadm()
    {
        $jadwal = Mapel::all();
        return view('admin.jadwal.index', [
            'jadwal' => $jadwal
        ]);
    }

    // function showadm()
    // {
    //     $daftar_mapel = Mapel::all();
    //     $daftar_guru = Guru::all();
    //     return view('daftar_guru', 'daftar_mapel');
    // }

    // function storeadm(Request $request)
    // {
    //     $jadwal = new Jadwal();
    //     $jadwal->id_guru = $request->guru;
    //     $jadwal->id_mapel = $request->mapel;
        
    //     $jadwal->save();
    //     return redirect('index-jadwaladm')->with('status', 'Data berhasil ditambah');
    // }
}
