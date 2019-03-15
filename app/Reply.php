<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function todo() {
        return $this->belongsTo('App\Todo');
    }

    protected $fillable = [
        'reply_content'
    ];
}
