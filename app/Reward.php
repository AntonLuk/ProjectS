<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Room;
class Reward extends Model
{
    public function room(){
        return $this->belongsTo(Room::class);
    }
}
