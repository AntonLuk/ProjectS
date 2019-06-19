<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;

class Client extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function applications(){
        return $this->hasMany(Application::class,'client_id');
    }
}
