<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Complex;

class Construct extends Model
{
    public function complexs(){
        return $this->hasMany(Complex::class);
    }
}
