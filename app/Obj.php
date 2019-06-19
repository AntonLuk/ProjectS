<?php

namespace App;
use App\ImageObj;
use Illuminate\Database\Eloquent\Model;
use App\ObjComplex;

class Obj extends Model
{
    public function images(){
        return($this->hasMany(ImageObj::class,'obj_id'));
    }
    public function complex(){
        return($this->hasOne(ObjComplex::class,'obj_id'));
    }
    public  function type_obj(){
        return $this->belongsTo(TypeOfObj::class,'type_of_obj_id');
    }
    public  function san_node(){
        return $this->belongsTo(SanNode::class,'san_node_id');
    }
    public  function application(){
        return $this->belongsTo(Application::class,'application_id');
    }
    public  function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public  function type_material(){
        return $this->belongsTo(TypeOfObj::class,'type_of_obj_id');
    }
    public  function district(){
        return $this->belongsTo(District::class,'district_id');
    }
    public function room(){
        return $this->belongsTo(Room::class,'room_id');
    }
}
