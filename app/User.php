<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
}
