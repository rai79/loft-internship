<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Проверка что это учетная запись менеджера
     *
     * @return bool
     */
    public function isManager()
    {
        return $this->is_manager;
    }

    /**
     * Проверка что это учетная запись обычного пользователя
     *
     * @return bool
     */
    public function isUser()
    {
        return !$this->is_manager;
    }

    /**
     * Получаем почтовый ящик администратора
     * В случае отсутствия учетной записи менеджера ошибка записывается в логи.
     *
     * @return mixed
     */
    public static function getManageEmail()
    {
        try
        {
            if($manager = self::where('is_manager',1)->first()) {
                return $manager->email;
            } else {
                throw new \Exception('Отсутствует учетная запись менеджера в БД. Дальнейшая работа невозможна. Обратитесь к администратору');
            }
        } catch (\Exception $e) {
            Log::critical($e->getMessage());
        }
        return false;
    }
}
