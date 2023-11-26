<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $user = auth('web')->user();
        if (! $user) {
            return redirect()->route('auth.login.page');
        }

        return view('user.home', compact('user'));
    }
}
