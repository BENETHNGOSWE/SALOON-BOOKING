<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function register(Request $request) {
        $userdata = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required|in:admin,kinyozi,mteja',
        ]);

        $userdata['password'] = bcrypt($userdata['password']);
        $user = User::create($userdata);
        return redirect()->route('login')->with('message', 'Register Successfully');
    }

    public function login(Request $request){
        $userdata = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($userdata)) {
            if(Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role === 'kinyozi') {
                return redirect()->route('kinyozi.dashboard');
            } else {
                return redirect()->route('mteja.dashboard');
            }
        }
    }
}
