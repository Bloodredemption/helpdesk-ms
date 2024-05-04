<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'sex' => 'required|in:male,female,other',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // 'confirmed' requires a matching password_confirmation field
        ]);

        // Create a new user instance
        $user = new User();
        $user->name = $request->name;
        $user->sex = $request->sex;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // You should hash the password for security

        // Save the user to the database
        $user->save();

        // Redirect the user to a different page after registration
        return redirect('/login')->with('success', 'Registration successful. You can now login.');
    }
}
