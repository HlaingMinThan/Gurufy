<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('user.auth.login');
    }

    public function loginAction(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return redirect()->intended(route('user-dashboard'));
        }
        return redirect()->back()->withInput()->with('error_message', 'Wrong credentials');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user-login');
    }
}
