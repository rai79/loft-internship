<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //TODO обработка запросов авторизованных пользователей
    public function index()
    {
        return view('user.index');
    }
}
