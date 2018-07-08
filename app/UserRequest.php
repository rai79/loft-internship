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

    /**
     * Получаем все запросы которые еще не обработаны
     *
     * @return mixed
     */
    public static function getAllProcessing()
    {
        return self::where('processed',0)->get();
    }

    /**
     * Получаем все запросы которые уже обработаны
     *
     * @return mixed
     */
    public static function getAllProcessed()
    {
        return self::where('processed',1)->get();
    }

    /**
     * Обновляем статус запроса (обработан менеджером или нет)
     *
     * @param $request_id - идентификатор запроса
     * @return bool
     */
    public static function updateRequest($request_id)
    {
        if($request = self::find($request_id)) {
            $request->processed = 1;
            return $request->save();
        }
        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
