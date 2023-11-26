<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = auth('web')->user();
        if (! $user) {
            return redirect()->route('auth.login.page');
        }

        return view('admin.dashboard', compact('user'));
    }
}
