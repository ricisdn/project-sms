<?php

namespace App\Http\Controllers;

use App\OrangTua;
use App\Siswa;
use App\Ortu;
use App\User;
use Illuminate\Http\Request;

class OrtuController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function indexadm()
    {
        $ortu = OrangTua::all();
        $daftar_user = User::all();
        return view('admin.ortu.index', compact('ortu', 'daftar_user'));
    }

    function showadm()
    {
        $daftar_siswa = Siswa::all();
        $daftar_ortu = User::where('usertype', 3)->get();
        return view('admin.ortu.tambah', compact('daftar_siswa', 'daftar_ortu'));
    }

    function storeadm(Request $request)
    {
        $ortu = new OrangTua();

        $ortu->id_user = $request->ortu;
        $ortu->id_siswa = $request->siswa;
        $ortu->tgl_lahir = $request->tgl_lahir;
        $ortu->nomor_telepon = $request->telepon;
        $ortu->jenis_kelamin = $request->gender;
        $ortu->alamat = $request->alamat;

        $ortu->save();
        return redirect('index-ortuadm')->with('status', 'Data berhasil ditambah');
    }

    public function editadm(OrangTua $ortu)
    {
        $daftar_siswa = Siswa::all();
        $nama_ortu = User::find($ortu->id_user)->name;
        return view('admin.ortu.edit', compact('ortu', 'daftar_siswa', 'nama_ortu'));
    }

    public function updateadm(Request $request, OrangTua $ortu)
    {
        $ortu->id_siswa = $request->input('siswa');
        $ortu->tgl_lahir = $request->input('tgl_lahir');
        $ortu->nomor_telepon = $request->input('telepon');
        $ortu->jenis_kelamin = $request->input('gender');
        $ortu->alamat = $request->input('alamat');

        if ($request->hasFile('avatar')) {
            if ($ortu->foto) {
                $oldPhotoPath = public_path('uploads/ortu/' . $ortu->foto);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Mengirim Foto
            $avatar = $request->file('avatar');
            $format = now()->format('YmdHis') . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('uploads/ortu'), $format);
            $ortu->foto = $format;
        }

        $ortu->save();
        return redirect('index-ortuadm')->with('status', 'Data berhasil diupdate');
    }

    public function deleteadm(Request $request)
    {
        $id = $request->input('id');
        $ortu = OrangTua::find($id);

        if ($ortu->foto) {
            $photoPath = public_path('uploads/ortu/' . $ortu->foto);

            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        $ortu->delete();

        return response()->json(['success' => true]);
    }
}
