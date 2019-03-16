<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function teams() {
        return $this->belongsToMany('App\Team');
    }

    public function replies() {
        return $this->hasMany('App\Reply');
    }

    protected $fillable = [
        'file_name', 'file_ext', 'file_mime', 'file_size', 'file_path'
    ];
}
