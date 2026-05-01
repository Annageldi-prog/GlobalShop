<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        if (Auth::check() && auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (!auth()->user()->is_admin) {
                Auth::logout();
                return redirect()->route('admin.login')
                    ->withErrors(['username' => 'У вас нет прав администратора.']);
            }

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['username' => 'Неверный логин или пароль'])
            ->onlyInput('username');
    }

   
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
