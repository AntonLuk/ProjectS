<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeClient extends Model
{
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
