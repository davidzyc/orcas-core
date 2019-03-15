<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //

    public function replies(){
        return $this->hasMany('App\Reply');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function team() {
        return $this->belongsTo('App\Team');
    }

    protected $fillable = [
        'todo_type', 'todo_title', 'todo_content', 'todo_due'
    ];
}
