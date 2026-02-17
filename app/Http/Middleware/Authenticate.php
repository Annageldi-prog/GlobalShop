<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        // Если запрос НЕ AJAX — отправляем на админ логин
        if (! $request->expectsJson()) {
            return route('admin.login');
        }
    }
}
