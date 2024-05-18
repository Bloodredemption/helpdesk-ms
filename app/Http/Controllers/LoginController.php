<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            session(['user_id' => Auth::id()]);
            

            if ($user->usertype == 'Admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->usertype == 'User') {
                return redirect()->route('tickets.index');
            }
        }

        // Authentication failed...
        return back()->withInput()->withErrors(['email' => 'The provided credentials are incorrect.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
