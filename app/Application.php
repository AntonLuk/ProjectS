<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Obj;
class Application extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function type_client()
    {
        return $this->belongsTo(TypeClient::class);
    }
    public function stage(){
        return $this->belongsTo(Stage::class,'stage_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'application_id');
    }
    public function files(){
       return $this->hasMany(FilesApplication::class,'application_id');
    }
    public function objs(){
        return $this->hasMany(Obj::class);
    }
    public function deals(){
        return $this->hasMany(Deal::class);
    }
}
