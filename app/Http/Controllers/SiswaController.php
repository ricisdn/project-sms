<?php

namespace App\Http\Controllers;

use App\User;
use App\Kelas;
use App\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public static function statusOptions()
    {
        return ['Hadir', 'Sakit', 'Izin', 'Alpa'];
    }

    public function index()
    {
        $siswa = Siswa::all();
        $daftar_kelas = Kelas::all();
        $daftar_user = User::all();
        return view('guru.siswa.index', compact('siswa', 'daftar_kelas', 'daftar_user'));
    }

    function show()
    {
        $daftar_kelas = Kelas::all();
        $daftar_user = User::where('usertype', null)->orWhere('usertype', 0)->get();
        return view('guru.siswa.tambah', compact('daftar_kelas', 'daftar_user'));
    }

    function store(Request $request)
    {
        $siswa = new Siswa();

        $siswa->id_user = $request->nama;
        $siswa->id_kelas = $request->kelas;
        $siswa->tgl_lahir = $request->tgl_lahir;
        $siswa->nomor_telepon = $request->telepon;
        $siswa->jenis_kelamin = $request->gender;
        $siswa->alamat = $request->alamat;

        // Mengirim Foto
        if ($request->hasFile('foto')) {
            $gambar = $request->file('foto');
            $format = now()->format('YmdHis') . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('uploads/siswa'), $format);
            $siswa->foto = $format;
        }

        $siswa->save();
        return redirect('index-siswa')->with('status', 'Data berhasil ditambah');
    }



    public function edit(Siswa $siswa)
    {
        $daftar_kelas = Kelas::all();
        $nama_siswa = User::find($siswa->id_user)->name;
        return view('guru.siswa.edit', compact('siswa', 'daftar_kelas', 'nama_siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            // 'nama' => 'required',
            'kelas' => 'required',
            'tgl_lahir' => 'required',
            'telepon' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
        ]);

        // $siswa->id_user = $request->input('nama');
        $siswa->id_kelas = $request->input('kelas');
        $siswa->tgl_lahir = $request->input('tgl_lahir');
        $siswa->nomor_telepon = $request->input('telepon');
        $siswa->jenis_kelamin = $request->input('gender');
        $siswa->alamat = $request->input('alamat');

        if ($request->hasFile('avatar')) {
            if ($siswa->foto) {
                $oldPhotoPath = public_path('uploads/siswa/' . $siswa->foto);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Mengirim Foto
            $avatar = $request->file('avatar');
            $format = now()->format('YmdHis') . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('uploads/siswa'), $format);
            $siswa->foto = $format;
        }

        $siswa->save();
        return redirect('index-siswa')->with('status', 'Data berhasil diupdate');
    }


    public function delete(Request $request)
    {
        $id = $request->input('id');
        $siswa = Siswa::find($id);

        if ($siswa->foto) {
            $photoPath = public_path('uploads/siswa/' . $siswa->foto);

            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        $siswa->delete();

        return response()->json(['success' => true]);
    }

    // Admin
    public function indexadm()
    {
        $siswa = Siswa::all();
        $daftar_user = User::all();
        return view('admin.siswa.index', compact('siswa', 'daftar_user'));
    }

    function showadm()
    {
        $daftar_kelas = Kelas::all();
        $daftar_user = User::where('usertype', null)->orWhere('usertype', 0)->get();
        return view('admin.siswa.tambah', compact('daftar_kelas', 'daftar_user'));
    }

    function storeadm(Request $request)
    {
        $siswa = new Siswa();

        $siswa->id_user = $request->nama;
        $siswa->id_kelas = $request->kelas;
        $siswa->tgl_lahir = $request->tgl_lahir;
        $siswa->nomor_telepon = $request->telepon;
        $siswa->jenis_kelamin = $request->gender;
        $siswa->alamat = $request->alamat;

        // Mengirim Foto
        if ($request->hasFile('foto')) {
            $gambar = $request->file('foto');
            $format = now()->format('YmdHis') . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('uploads/siswa'), $format);
            $siswa->foto = $format;
        }

        $siswa->save();
        return redirect('index-siswaadm')->with('status', 'Data berhasil ditambah');
    }

    public function editadm(Siswa $siswa)
    {
        $daftar_kelas = Kelas::all();
        $nama_siswa = User::find($siswa->id_user)->name;
        return view('admin.siswa.edit', compact('siswa', 'daftar_kelas', 'nama_siswa'));
    }

    public function updateadm(Request $request, Siswa $siswa)
    {
        $request->validate([
            'kelas' => 'required',
            'tgl_lahir' => 'required',
            'telepon' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
        ]);

        $siswa->id_kelas = $request->input('kelas');
        $siswa->tgl_lahir = $request->input('tgl_lahir');
        $siswa->nomor_telepon = $request->input('telepon');
        $siswa->jenis_kelamin = $request->input('gender');
        $siswa->alamat = $request->input('alamat');

        if ($request->hasFile('avatar')) {
            if ($siswa->foto) {
                $oldPhotoPath = public_path('uploads/siswa/' . $siswa->foto);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Mengirim Foto
            $avatar = $request->file('avatar');
            $format = now()->format('YmdHis') . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('uploads/siswa'), $format);
            $siswa->foto = $format;
        }

        $siswa->save();
        return redirect('index-siswaadm')->with('status', 'Data berhasil diupdate');
    }

    public function deleteadm(Request $request)
    {
        $id = $request->input('id');
        $siswa = Siswa::find($id);

        if ($siswa->foto) {
            $photoPath = public_path('uploads/siswa/' . $siswa->foto);

            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        $siswa->delete();

        return response()->json(['success' => true]);
    }

}
