<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Application;
class Contract extends Model
{
public function client(){
    return $this->belongsTo(Client::class,'client_id');
}
public function applications(){
    return $this->hasMany(Application::class);
}

}
