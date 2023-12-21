<?php

namespace App\Http\Controllers;

use App\Pengumpulan;
use App\Tugas;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasSiswaController extends Controller
{
    // Halaman Tugas
    public function index()
    {
        $siswa = Siswa::where('id_user', Auth::user()->id)->first();

        if ($siswa) {
            $pengumpulan = Pengumpulan::where('id_user', Auth::user()->id)->get();
            $tugas = Tugas::where('id_kelas', $siswa->id_kelas)->get();
        } else {
            $tugas = collect();
            $pengumpulan = collect();
        }
        return view('siswa.tugas.index', compact('tugas', 'pengumpulan'));
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        $pengumpulan = new Pengumpulan();

        $pengumpulan->id_user = $request->nama;
        $pengumpulan->id_mapel = $request->mapel;
        $pengumpulan->id_kelas = $request->kelas;
        $pengumpulan->id_tugas = $request->tugas;
        $pengumpulan->catatan = $request->catatan;

        if ($request->hasFile('file')) {
            $avatar = $request->file('file');
            $avatarName = now()->format('YmdHis') . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('uploads/pengumpulan'), $avatarName);
            $pengumpulan->file = $avatarName;
        }

        $pengumpulan->save();
        return redirect('tugas-siswa')->with('status', 'Data berhasil ditambah');
    }

    // Halaman submit tugas
    public function show($id)
    {
        $siswa = Siswa::where('id_user', Auth::user()->id)->first();
        $tugas = Tugas::find($id);
        $siswa = Siswa::where('id_user', Auth::user()->id)->get();
        return view('siswa.tugas.tambah', ['tugas' => $tugas, 'siswa' => $siswa]);
    }

    // Halaman edit tugas
    public function edit($id)
    {
        $siswa = Siswa::where('id_user', Auth::user()->id)->first();
        $tugas = Tugas::find($id);
        $pengumpulan = Pengumpulan::where('id_tugas', $id)->where('id_user', $siswa->id_user)->first();
        return view('siswa.tugas.edit', ['tugas' => $tugas, 'pengumpulan' => $pengumpulan]);
    }

    // Mengupdate data ke database
    public function update(Request $request, Pengumpulan $pengumpulan)
    {
        $pengumpulan = Pengumpulan::find($request->input('id_pengumpulan'));

        if (!$pengumpulan) {
            // Menangani kasus ketika Pengumpulan tidak ditemukan
            return redirect('tugas-siswa')->with('error', 'Data tidak ditemukan');
        }

        // Menghapus file lama jika file baru diupload
        if ($request->hasFile('file')) {
            // Menghapus file lama
            if ($pengumpulan->file) {
                Storage::delete('uploads/pengumpulan/' . $pengumpulan->file);
            }

            // Mengunggah file baru
            $avatar = $request->file('file');
            $avatarName = now()->format('YmdHis') . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('uploads/pengumpulan'), $avatarName);
            $pengumpulan->file = $avatarName;
        }

        // Mengisi kolom-kolom dengan data yang baru
        $pengumpulan->id_tugas = $request->input('tugas');
        $pengumpulan->id_user = $request->input('siswa');
        $pengumpulan->id_mapel = $request->input('mapel');
        $pengumpulan->catatan = $request->input('catatan');

        // Menyimpan perubahan
        $pengumpulan->save();

        return redirect('tugas-siswa')->with('status', 'Data berhasil diupdate');

    }
}
