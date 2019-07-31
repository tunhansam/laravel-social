<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use App\Scopes\DefaultScope;
use App\Scopes\BaseScope;
use App\Presenters\AdminPresenter;

class Admin extends Authenticatable 
{
    use Notifiable;
    use BaseScope;
    use AdminPresenter;

    public static function boot() {
        parent::boot();
        static::addGlobalScope(new DefaultScope);
    }
   
    protected $fillable = [
        'name', 'password', 'email', 'avatar', 'provider', 'provider_id', 'role_type', 'ins_id', 'upd_id', 'created_at', 'updated_at', 'del_flag'
    ];
    protected $hidden = [
        'remember_token', 'password'
    ];
    protected $table = 'admin';
    protected $guard = "admin";

    public function getAuthPassword() {
        return $this->password;
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setEmailAttribute($value) {
        $this->attributes['email'] = trim(strtolower($value));
    }

    public function setDelFlagAttribute($value) {
        $this->attributes['del_flag'] = $value;
    }

    // Relationship
    public function updater() {
        return $this->belongsTo('App\Admin', 'upd_id');
    }
    public function getRememberTokenName(){
        return null; // not supported
    }
     
    /**
    * Overrides the method to ignore the remember token.
    */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute){
            parent::setAttribute($key, $value);
        }
    }
}
