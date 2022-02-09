<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';


    protected $fillable = [
        'username',
        'email',
        'password',
        'admin_role',
    ];
//認証
    public static function contributorAndAdmin($id) {
        return Auth::id() == $id || Auth::user()->admin_role == 1;
    }

}
