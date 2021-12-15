<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => "required",
            'password' => "required"
        ]);

        $user = Auth::attempt(['username' => $request->username, 'password' => $request->password]);
        if ($user) {
            Auth::login(User::where(['username' => $request->username])->firstOrFail());
            return redirect('/');
        }
        Session::flash('login', false);
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
