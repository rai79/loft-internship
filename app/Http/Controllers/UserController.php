<?php

namespace App\Http\Controllers;

use App\Mail\newRequestPosted;
use App\User;
use App\UserRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Выводится диалог запроса.
     * Проверяется время до предыдущего поста и блокируется кнопка отправить до истечения 24 ч.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if($time = UserRequest::getLastTimeOrder(Auth::user()->id)) {
            if (($time_left = Carbon::now()->subDay()->diffInMinutes($time)) > 0) {
                $data['time_left'] = $time_left;
            }
        } else {
            $data= [];
        }
        return view('user.index', $data);
    }

    /**
     * Добавляет запрос пользователя в БД.
     * При отсутствии записи менеджера выдается ошибка
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $this->validate($request, [
            'theme' => 'required|string|max:200',
            'massage' => 'required|string'
        ]);
        UserRequest::storeRequest($request->theme, $request->massage);
        $data['request'] = $request;
        if($manager = User::getManageEmail()) {
            Mail::to($manager)->send(new newRequestPosted($data));
        } else {
            return view('errors.nomanager', $data);
        }
        return redirect()->route('user.index');
    }

}
