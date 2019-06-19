<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;

class Comment extends Model
{
    public function application(){
        $this->belongsToMany(Application::class);
    }
}
