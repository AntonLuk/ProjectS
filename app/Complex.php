<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reward;
use App\Construct;
class Complex extends Model
{
    protected $table="complexs";
    public function rewards(){
        return $this->hasMany(Reward::class,'complex_id');
    }
    public function construct(){
        return $this->belongsTo(Construct::class,'construct_id');
    }
}
