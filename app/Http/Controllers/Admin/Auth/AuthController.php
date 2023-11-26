<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $remember = (bool) $request->get('remember');
        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        $attempt = auth('web')->attempt($credentials);

        if (!$attempt) {
            return redirect()->route('auth.login')->withErrors(['Invalid credentials']);
        }

        $user = User::where('email', $email)->first();
        auth('web')->login($user);

        return redirect()->route('admin.dashboard');
    }

    public function register(Request $request)
    {
        dd($request->all());
    }

    public function logout(Request $request)
    {
        auth('web')->logout();

        return redirect()->route('auth.login');
    }
}
