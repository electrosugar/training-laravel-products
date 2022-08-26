<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Hashing\AbstractHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function login()
    {
        $credentials = request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);


        //successful auth

        if (Auth::attempt($credentials)) {
            return redirect('/products')->with('success', 'Welcome Back!');
        }
        return back()
            ->withInput()
            ->withErrors([
                'username' => 'Your provided credentials could not be verified'
            ]);

    }

    public function logout()
    {
        Auth::logout();

        return Redirect::route('login');

    }
}
