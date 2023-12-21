<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class RoleaksesController extends Controller
{
    public function indexadm(Request $request)
    {
        $user = User::all();
        return view('admin.role.index', [
            'user' => $user
    ]);
    }

    // public function showRegistrationForm()
    // {
        
    //     return view('auth.register');
    // }

    // function storeadm(Request $request)
    // {
    //     $user = new User();

    //     $user->name = $request->name;
    //     $user->usertype = $request->usertype;
    //     $user->email = $request->email;
    //     $user->password = $request->password;
        
    //     $user->save();
    //     return redirect('index-roleaksesadm')->with('status', 'Data berhasil ditambah');
    // }

    public function editadm(User $user){
        return view('admin.role.edit', [
        'user' => $user
    ]);
    }

    public function updateadm(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'usertype' => 'required',
            
            
        ]);

        $user->name = $request->input('name');
        $user->usertype = $request->input('usertype');
        

        $user->save();
        return redirect('index-roleaksesadm')->with('status', 'Data berhasil diupdate');
    }

    public function deleteadm(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);

    

        $user->delete();

        return response()->json(['success' => true]);
    }
}