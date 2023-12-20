<?php

namespace App\Http\Controllers;

use App\Guru;
use App\User;
use App\Kelas;
use App\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapelController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $user = Auth::id();
        $guru = Guru::where('id_user', $user)->first();

        if ($guru) {
            $mapel = Mapel::where('id_user', $guru->id_user)->get();
        } else {
            $mapel = collect();
        }
        return view('guru.jadwal.index', compact('mapel'));
    }


    // Admin
    public function indexadm()
    {
        $mapel = Mapel::all();
        $daftar_user = User::all();
        return view('admin.mapel.index', compact('mapel', 'daftar_user'));
    }

    public function showadm()
    {
        $daftar_kelas = Kelas::all();
        $daftar_guru = Guru::all();
        $daftar_user = User::all();
        $daftar_mapel = Mapel::all();
        return view('admin.mapel.tambah', compact('daftar_mapel', 'daftar_guru', 'daftar_user', 'daftar_kelas'));
    }

    function storeadm(Request $request)
    {
        $mapel = new Mapel();
        $mapel->id_user = $request->guru;
        $mapel->nama_mapel = $request->nama;
        $mapel->id_kelas = $request->kelas;
        $mapel->hari = $request->hari;
        $mapel->jam_mulai = $request->jam_mulai;
        $mapel->jam_selesai = $request->jam_selesai;

        $mapel->save();
        return redirect('index-mapeladm')->with('status', 'Data berhasil ditambah');
    }

    public function editadm(Mapel $mapel)
    {
        $daftar_kelas = Kelas::all();
        $daftar_guru = Guru::all();
        $daftar_mapel = Mapel::all();
        $daftar_user = User::where('usertype', 2)->get();
        return view('admin.mapel.edit', compact('daftar_user', 'mapel', 'daftar_mapel', 'daftar_guru', 'daftar_kelas'));
    }


    public function updateadm(Request $request, Mapel $mapel)
    {
        $mapel->id_user = $request->input('guru');
        $mapel->nama_mapel = $request->input('mapel');
        $mapel->id_kelas = $request->input('kelas');
        $mapel->hari = $request->input('hari');
        $mapel->jam_mulai = $request->input('jam_mulai');
        $mapel->jam_selesai = $request->input('jam_selesai');


        $mapel->save();
        return redirect('index-mapeladm')->with('status', 'Data berhasil diupdate');
    }

    public function deleteadm(Request $request)
    {
        $id = $request->input('id');
        $mapel = Mapel::find($id);


        $mapel->delete();

        return response()->json(['success' => true]);
    }

}
