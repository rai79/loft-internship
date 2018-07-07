<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ManagerOnly
{
    /**
     * Handle an incoming request.
     * Если менеджер то продолжаем, если авторизованный пользователь то редирект в пользовательскую часть иначе редирект в корень
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isManager()) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->isUser()) {
            return redirect()->route('user.index');
        } else {
            return redirect('/');
        }
    }
}
