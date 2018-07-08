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
