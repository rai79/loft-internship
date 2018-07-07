<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    //TODO обработка запросов авторизованных пользователей
    public function index()
    {
        return view('manager.index');
    }
}
