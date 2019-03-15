<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    public function owner() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function members() {
        return $this->belongsToMany('App\User');
    }

    public function todos() {
        return $this->hasMany('App\Todo');
    }

    protected $fillable = [
        'team_name', 'team_description', 'user_id'
    ];

}
