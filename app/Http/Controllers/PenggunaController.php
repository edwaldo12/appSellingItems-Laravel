<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PenggunaController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => "required",
            'username' => ["required", "unique:users,username"],
            'password' => "required",
            'telepon' => "required",
            'tipe_pengguna' => "required",
            'email' => ["required", "unique:users,email"],
        ]);

        $user = new User;
        $user->nama = $request->nama;
        $user->telepon = $request->telepon;
        $user->email = $request->email;
        $user->tipe_pengguna = $request->tipe_pengguna;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        Session::flash('store_user', $user->save());
        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        dd($user);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $rules = [
            'nama' => "required",
            'username' => ["required", "unique:users,username"],
            'password' => "required",
            'telepon' => "required",
            'tipe_pengguna' => "required",
            'email' => ["required", "unique:users,email"],
        ];
        if ($user->username != $request->username) {
            $rules['username'] = "required|unique:users,username";
        }
        $request->validate($rules);

        $user->nama = $request->nama;
        $user->telepon = $request->telepon;
        $user->email = $request->email;
        $user->tipe_pengguna = $request->tipe_pengguna;
        $user->username = $request->username;
        $user->password = !empty($request->password) ? bcrypt($request->password) : $user->password;

        Session::flash('update_user', $user->save());
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Session::flash('destroy_user', $user->delete());
        return redirect()->route('users.index');
    }
}
