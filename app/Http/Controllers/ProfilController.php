<?php

namespace App\Http\Controllers;

use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('guru.profile.index', ['user' => $user]);
    }

    public function indexadm()
    {
        $user = Auth::user();
        return view('admin.profile.index', ['user' => $user]);
    }

    public function indexsiswa()
    {
        $user = Auth::user();
        return view('siswa.profile.index', ['user' => $user]);
    }

    public function indexortu()
    {
        $user = Auth::user();
        return view('orangtua.profile.index', ['user' => $user]);
    }

    // Guru
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'old_password' => 'required',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect('index-profil')->with('error', 'Password anda tidak valid !!');
        }

        // Update user data
        $user->name = $request->nama;
        $user->email = $request->email;

        // Check if a new photo is uploaded
        if ($request->hasFile('avatar')) {
            if ($user->foto) {
                $oldPhotoPath = public_path('uploads/profile/guru' . $user->foto);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Mengirim Foto
            $avatar = $request->file('avatar');
            $format = now()->format('YmdHis') . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('uploads/profile/guru'), $format);
            $user->foto = $format;
        }

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();
        return redirect('index-profil')->with('status', 'Data berhasil diupdate');
    }

    // Admin
    public function updateadm(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'old_password' => 'required',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect('index-profiladmin')->with('error', 'Password anda tidak valid !!');
        }

        // Update user data
        $user->name = $request->nama;
        $user->email = $request->email;

        // Check if a new photo is uploaded
        if ($request->hasFile('avatar')) {
            if ($user->foto) {
                $oldPhotoPath = public_path('uploads/profile/admin' . $user->foto);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Mengirim Foto
            $avatar = $request->file('avatar');
            $format = now()->format('YmdHis') . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('uploads/profile/admin'), $format);
            $user->foto = $format;
        }

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();
        return redirect('index-profiladmin')->with('status', 'Data berhasil diupdate');
    }

    // Siswa
    public function updatesiswa(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'old_password' => 'required',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect('index-profilsiswa')->with('error', 'Password anda tidak valid !!');
        }

        // Update user data
        $user->name = $request->nama;
        $user->email = $request->email;

        // Check if a new photo is uploaded
        if ($request->hasFile('avatar')) {
            if ($user->foto) {
                $oldPhotoPath = public_path('uploads/profile/siswa' . $user->foto);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Mengirim Foto
            $avatar = $request->file('avatar');
            $format = now()->format('YmdHis') . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('uploads/profile/siswa'), $format);
            $user->foto = $format;
        }

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();
        return redirect('index-profilsiswa')->with('status', 'Data berhasil diupdate');
    }

    // Orangtua
    public function updateortu(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'old_password' => 'required',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect('index-profilortu')->with('error', 'Password anda tidak valid !!');
        }

        // Update user data
        $user->name = $request->nama;
        $user->email = $request->email;

        // Check if a new photo is uploaded
        if ($request->hasFile('avatar')) {
            if ($user->foto) {
                $oldPhotoPath = public_path('uploads/profile/orangtua' . $user->foto);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Mengirim Foto
            $avatar = $request->file('avatar');
            $format = now()->format('YmdHis') . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('uploads/profile/orangtua'), $format);
            $user->foto = $format;
        }

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();
        return redirect('index-profilortu')->with('status', 'Data berhasil diupdate');
    }
}
