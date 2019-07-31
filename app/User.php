<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Scopes\DefaultScope;
use App\Scopes\BaseScope;

class User extends Authenticatable
{
    use Notifiable;
    use BaseScope;

    public static function boot() 
    {
        parent::boot();
        static::addGlobalScope(new DefaultScope);
    }

    protected $fillable = [
        'name', 'email', 'facebook_id', 'status', 'ins_id', 'upd_id', 'created_at', 'updated_at', 'del_flag'
    ];

    protected $hidden = [
        'remember_token'
    ];

    // Login admin
    protected $guard = "admin";
}
