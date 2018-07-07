<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Редирект после авторизации пользователей согласно их учетным данным
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isManager()) {
            return redirect()->route('manager.index');
        } else {
            return redirect()->route('user.index');
        }
    }
}
