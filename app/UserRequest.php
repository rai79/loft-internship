<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserRequest extends Model
{
    protected $guarded = ['id'];
    protected $table = "requests";

    /**
     * Сохраняем запись запроса пользователя
     *
     * @param $theme - тема заявки
     * @param $massage - сообщение заявки
     * @return bool
     */
    public static function storeRequest($theme, $massage)
    {
        $user_req = new UserRequest();
        $user_req->theme = $theme;
        $user_req->massage = $massage;
        $user_req->user_id = Auth::user()->id;
        $user_req->processed = 0;
        return $user_req->save();
    }

    /**
     * Получаем время последней записи
     *
     * @param $id
     * @return timestamp - если найдена запись, bool - если записи отсутствуют
     */
    public static function getLastTimeOrder($id)
    {
        if($last_request = self::where('user_id',$id)->orderBy('created_at', 'desc')->first()) {
            return $last_request->created_at;
        }
        return false;
    }

}
