<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'signature' => 'nullable|string',
            'stamp' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'position' => $request->position,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        if($user){
            return redirect()->route('dashboard.home'); // Change this route to where you want to redirect after registration
        }else{
            return redirect()->route('auth.login')->withErrors(['Please Check credentials']); // Change this route to where you want to redirect after registration
        }



        
    }
}
