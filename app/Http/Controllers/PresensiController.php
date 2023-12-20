<?php

namespace App\Http\Controllers;

use App\User;
use App\Mapel;
use App\Siswa;
use App\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        $presensi = Presensi::all();
        $daftar_mapel = Mapel::all();
        return view('guru.presensi.index', compact('presensi', 'daftar_mapel'));
    }

    function store(Request $request)
    {
        $presensi = new Presensi();

        $presensi->id_user = $request->nama;
        $presensi->id_mapel = $request->mapel;
        $presensi->status = $request->status;
        $presensi->keterangan = $request->keterangan;
        $presensi->tgl_presensi = $request->tgl_presensi;

        $presensi->save();
        return redirect('index-presensi')->with('status', 'Data berhasil ditambah');

    }

    function show()
    {
        $daftar_siswa = Siswa::with('user')->get();
        $daftar_mapel = Mapel::all();
        $daftar_user = User::all();
        return view('guru.presensi.tambah', compact('daftar_mapel', 'daftar_siswa', 'daftar_user'));
    }

    function edit(Presensi $presensi)
    {
        return view('guru.presensi.edit', compact('presensi'));
    }

    public function update(Request $request, Presensi $presensi)
    {
        $presensi->status = $request->input('status');

        $presensi->save();
        return redirect('index-presensi')->with('status', 'Data berhasil diupdate');
    }

    public function StatusWarna($status)
    {
        switch ($status) {
            case 'Hadir':
                return 'btn btn-success btn-sm w-50 mt-3 text-white p-0';
            case 'Izin':
                return 'btn btn-primary btn-sm w-50 mt-3 text-white p-0';
            case 'Sakit':
                return 'btn btn-warning btn-sm w-50 mt-3 text-dark p-0';
            case 'Alpa':
                return 'btn btn-danger btn-sm w-50 mt-3 text-white p-0';
            default:
                return '';
        }
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $presensi = Presensi::find($id);

        $presensi->delete();

        return response()->json(['success' => true]);
    }

    // Admin
    public function indexadm()
    {
        $presensi = Presensi::all();
        $daftar_user = User::all();
        return view('admin.presensi.index', compact('presensi', 'daftar_user'));
    }

    function storeadm(Request $request)
    {
        $presensi = new Presensi();
        $presensi->id_user = $request->siswa;
        $presensi->id_mapel = $request->mapel;
        $presensi->status = $request->status;
        $presensi->tgl_presensi = $request->tgl_presensi;

        $presensi->save();
        return redirect('index-presensiadm')->with('status', 'Data berhasil ditambah');

    }

    function showadm()
    {
        $daftar_siswa = Siswa::all();
        $daftar_user = User::where('usertype', null)->orWhere('usertype', 0)->get();
        $daftar_mapel = Mapel::all();
        return view('admin.presensi.tambah', compact('daftar_mapel', 'daftar_siswa', 'daftar_user'));
    }

    function editadm(Presensi $presensi)
    {
        return view('admin.presensi.edit', compact('presensi'));
    }

    public function updateadm(Request $request, Presensi $presensi)
    {
        $presensi->status = $request->input('status');
        $presensi->save();
        return redirect('index-presensiadm')->with('status', 'Data berhasil diupdate');
    }

    public function StatusWarnaadm($status)
    {
        switch ($status) {
            case 'Hadir':
                return 'btn btn-success btn-sm w-50 mt-3 text-white p-0';
            case 'Izin':
                return 'btn btn-primary btn-sm w-50 mt-3 text-white p-0';
            case 'Sakit':
                return 'btn btn-warning btn-sm w-50 mt-3 text-dark p-0';
            case 'Alpa':
                return 'btn btn-danger btn-sm w-50 mt-3 text-white p-0';
            default:
                return '';
        }
    }

    public function deleteadm(Request $request)
    {
        $id = $request->input('id');
        $presensi = Presensi::find($id);

        $presensi->delete();

        return response()->json(['success' => true]);
    }
}
