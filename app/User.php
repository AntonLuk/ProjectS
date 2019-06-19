<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Departament;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_user');
    }
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userRole()
    {
        return $this->hasOne(RoleUser::class, 'user_id', 'id');
    }
    public function applications()
    {
        return $this->hasMany(Client::class);
    }
    public function deals()
    {
        return $this->hasManyThrough(Deal::class,Application::class);
    }

}
