<?php

namespace App;
use Zizaco\Entrust\EntrustPermission;
use App\Role;
class Permission extends EntrustPermission
{
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
