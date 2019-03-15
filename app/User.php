<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function hasTeams() {
        return $this->hasMany('App\Team', 'user_id');
    }

    public function replies() {
        return $this->hasMany('App\Reply');
    }

    public function todos() {
        return $this->hasMany('App\Todo');
    }

    public function files() {
        return $this->hasMany('App\File');
    }

    public function teams() {
        return $this->belongsToMany('App\Team');
    }

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
}
