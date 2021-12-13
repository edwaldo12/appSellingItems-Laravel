<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
            "username" => ["required", "unique:users"],
            "nik" => ["required", "unique:users"],
            "password" => ["required", 'min:8'],
            "status" => "required"
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->nik = $request->nik;
        $user->username = $request->username;
        $user->status = $request->status;
        $user->password = Hash::make($request->password);
        Session::flash('save_user', $user->save());
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => "required",
            "username" => ["required", "unique:users"],
            "nik" => ["required", "unique:users"],
            "password" => ["required", 'min:8'],
            "status" => "required"
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->nik = $request->nik;
        $user->username = $request->username;
        $user->status = $request->status;
        $user->password = Hash::make($request->password);
        Session::flash('update_user', $user->save());
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Session::flash('delete_user', $user->delete());
        return redirect()->route('users.index');
    }
}
