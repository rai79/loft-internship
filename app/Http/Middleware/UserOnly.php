<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserOnly
{
    /**
     * Handle an incoming request.
     * Если авторизованный пользователь то продолжаем, если менеджер то редирект в менеджерскую часть иначе редирект в корень
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isUser()) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->isManager()) {
            return redirect()->route('user.index');
        } else {
            return redirect('/');
        }
    }
}
