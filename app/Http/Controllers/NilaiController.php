<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Mapel;
use App\Nilai;
use App\Siswa;
use App\Tugas;
use App\Pengumpulan;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Pengumpulan::all();
        $status = Tugas::all();
        $daftar_mapel = Mapel::all();
        $daftar_kelas = Kelas::all();
        return view('guru.nilai.index', compact('nilai', 'status', 'daftar_mapel', 'daftar_kelas'));
    }

    function show()
    {
        $daftar_mapel = Mapel::all();
        $daftar_siswa = Siswa::all();
        return view('guru.nilai.tambah', compact('daftar_mapel', 'daftar_siswa'));
    }

    function store(Request $request)
    {
        $nilai = new Nilai();

        $nilai->id_mapel = $request->mapel;
        $nilai->id_siswa = $request->siswa;
        $nilai->nilai = $request->nilai;

        $nilai->save();
        return redirect('index-nilai')->with('status', 'Data berhasil ditambah');

    }





    public function delete(Request $request)
    {
        $id = $request->input('id');
        $nilai = Nilai::find($id);

        $nilai->delete();

        return response()->json(['success' => true]);
    }
}
