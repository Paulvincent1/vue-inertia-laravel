<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|confirmed',
            'avatar' => 'nullable|image|mimes:png,jpg'
        ]);

        if($request->hasFile('avatar')){
            $fields['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
        }

        $user = User::create($fields);

        Auth::login($user);

        return redirect()->route('dashboard')->with(['greet' => 'welcome to laravel inertia app']);
    }

    public function login(Request $request){
        

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->route('home');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
    
}
