<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        if (!$user || $user->role_id !== Role::ADMIN) {
            return $this->incorrectCredentials($request);
        }

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('dashboard');
        }

        return $this->incorrectCredentials($request);
    }

    public function logout()
    {
        Auth::logout();
        
        return redirect()->route('login');
    }

    public function incorrectCredentials(LoginRequest $request)
    {
        $request->session()->flash('msg_error', 'Identifiant ou mot de passe incorrect.');

        return redirect()->route('login');
    }
}
