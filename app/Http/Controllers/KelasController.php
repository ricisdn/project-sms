<?php

namespace App\Http\Controllers;

use App\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function indexadm()
    {
        $kelas = Kelas::all();
        return view('admin.kelas.index', [
            'kelas' => $kelas
        ]);
    }

    function showadm()
    {
        return view('admin.kelas.tambah');
    }

    function storeadm(Request $request)
    {
        $kelas = new Kelas();

        $kelas->nama_kelas = $request->nama;

        $kelas->save();
        return redirect('index-kelasadm')->with('status', 'Data berhasil ditambah');
    }

    public function editadm(Kelas $kelas)
    {
        return view('admin.kelas.edit', [
            'kelas' => $kelas
        ]);
    }

    public function updateadm(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $kelas->nama_kelas = $request->input('nama');

        $kelas->save();
        return redirect('index-kelasadm')->with('status', 'Data berhasil diupdate');
    }

    public function deleteadm(Request $request)
    {
        $id = $request->input('id');
        $kelas = Kelas::find($id);

        $kelas->delete();

        return response()->json(['success' => true]);
    }
}
