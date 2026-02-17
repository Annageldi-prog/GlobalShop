<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Пользователь не залогинен → редирект на login
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        // Пользователь не админ → редирект на login
        if (!auth()->user()->is_admin) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
