<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Obj;
use App\Application;
class Deal extends Model
{
    public function obj(){
    return $this->belongsTo(Obj::class);
    }
    public function application(){
        return $this->belongsTo(Application::class);
    }
    public function users(){
        return $this->hasManyThrough(User::class,Application::class);
    }
}
