<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'description', 'tags'
    ];


    public function files()
    {
        return $this->hasMany('App\File');
    }
}
