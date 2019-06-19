<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;
use App\Permission;
class Role extends EntrustRole
{
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
