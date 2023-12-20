<?php

namespace App\Http\Controllers;

use App\User;
use App\Kelas;
use App\Mapel;
use App\Siswa;
use App\Tugas;
use App\Pengumpulan;
use Illuminate\Http\Request;

class PengumpulanController extends Controller
{
    public function index()
    {
        $pengumpulan = Pengumpulan::all();
        $daftar_deskripsi = Tugas::all();
        $daftar_mapel = Mapel::all();
        $daftar_kelas = Kelas::all();
        return view('guru.pengumpulan.index', compact('pengumpulan', 'daftar_deskripsi', 'daftar_mapel', 'daftar_kelas'));
    }

    public function show()
    {
        $daftar_siswa = Siswa::all();
        $daftar_mapel = Mapel::all();
        $daftar_tugas = Tugas::all();
        $daftar_kelas = Kelas::all();
        return view('guru.pengumpulan.tambah', compact('daftar_siswa', 'daftar_mapel', 'daftar_tugas', 'daftar_kelas'));
    }

    public function store(Request $request)
    {
        $pengumpulan = new Pengumpulan();

        $pengumpulan->id_siswa = $request->nama;
        $pengumpulan->id_tugas = $request->deskripsi;
        $pengumpulan->id_kelas = $request->kelas;
        $pengumpulan->id_mapel = $request->mapel;
        $pengumpulan->catatan = $request->catatan;

        if ($request->hasFile('file')) {
            $avatar = $request->file('file');
            $avatarName = now()->format('YmdHis') . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('uploads/pengumpulan'), $avatarName);
            $pengumpulan->file = $avatarName;
        }

        $pengumpulan->save();
        return redirect('index-pengumpulan')->with('status', 'Data berhasil ditambah');
    }

    function edit(Pengumpulan $pengumpulan)
    {
        $daftar_mapel = Mapel::all();
        $daftar_siswa = Siswa::all();
        return view('guru.pengumpulan.edit', compact('pengumpulan', 'daftar_mapel', 'daftar_siswa'));
    }

    function update(Request $request, Pengumpulan $pengumpulan)
    {
        $pengumpulan->nilai = $request->nilai;

        $pengumpulan->save();
        return redirect('index-pengumpulan')->with('status', 'Data berhasil ditambah');
    }

    // Admin
    public function indexadm()
    {
        $pengumpulan = Pengumpulan::all();
        $daftar_user = User::all();
        return view('admin.pengumpulan.index', compact('pengumpulan', 'daftar_user'));
    }

    public function showadm()
    {
        $daftar_user = User::where('usertype', 0)->get();
        $daftar_mapel = Mapel::all();
        $daftar_kelas = Kelas::all();
        return view('admin.pengumpulan.tambah', compact('daftar_kelas', 'daftar_user', 'daftar_mapel'));
    }

    public function storeadm(Request $request)
    {
        $pengumpulan = new Pengumpulan();

        $pengumpulan->id_user = $request->nama;
        $pengumpulan->id_kelas = $request->kelas;
        $pengumpulan->id_mapel = $request->mapel;
        $pengumpulan->catatan = $request->catatan;

        if ($request->hasFile('file')) {
            $avatar = $request->file('file');
            $avatarName = now()->format('YmdHis') . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('uploads/pengumpulan'), $avatarName);
            $pengumpulan->file = $avatarName;
        }

        $pengumpulan->save();
        return redirect('index-pengumpulanadm')->with('status', 'Data berhasil ditambah');
    }

    function editadm(Pengumpulan $pengumpulan)
    {
        $daftar_mapel = Mapel::all();
        return view('admin.pengumpulan.edit', compact('pengumpulan', 'daftar_mapel'));
    }

    function updateadm(Request $request, Pengumpulan $pengumpulan)
    {
        $pengumpulan->nilai = $request->nilai;
        $pengumpulan->save();
        return redirect('index-pengumpulanadm')->with('status', 'Data berhasil ditambah');
    }

    public function deleteadm(Request $request)
    {
        $id = $request->input('id');
        $pengumpulan = Pengumpulan::find($id);

        $pengumpulan->delete();

        return response()->json(['success' => true]);
    }

}