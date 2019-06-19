<?php

use Illuminate\Database\Seeder;
use App\PermissionRole;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * ADMIN ROLES
         *
         */
        $createUser = new PermissionRole;
        $createUser->role_id = '1';
        $createUser->permission_id = '1';
        $createUser->timestamps = false;
        $createUser->save();

        $updateUser = new PermissionRole;
        $updateUser->role_id = '1';
        $updateUser->permission_id = '2';
        $updateUser->timestamps = false;
        $updateUser->save();

        $deleteUser = new PermissionRole;
        $deleteUser->role_id = '1';
        $deleteUser->permission_id = '3';
        $deleteUser->timestamps = false;
        $deleteUser->save();

        $createClient = new PermissionRole;
        $createClient->role_id = '1';
        $createClient->permission_id = '4';
        $createClient->timestamps = false;
        $createClient->save();

        $updateClient = new PermissionRole;
        $updateClient->role_id = '1';
        $updateClient->permission_id = '5';
        $updateClient->timestamps = false;
        $updateClient->save();

        $deleteClient = new PermissionRole;
        $deleteClient->role_id = '1';
        $deleteClient->permission_id = '6';
        $deleteClient->timestamps = false;
        $deleteClient->save();

        $createTask = new PermissionRole;
        $createTask->role_id = '1';
        $createTask->permission_id = '7';
        $createTask->timestamps = false;
        $createTask->save();

        $updateTask = new PermissionRole;
        $updateTask->role_id = '1';
        $updateTask->permission_id = '8';
        $updateTask->timestamps = false;
        $updateTask->save();

        $createObj = new PermissionRole;
        $createObj->role_id = '1';
        $createObj->permission_id = '9';
        $createObj->timestamps = false;
        $createObj->save();

        $updateObj = new PermissionRole;
        $updateObj->role_id = '1';
        $updateObj->permission_id = '10';
        $updateObj->timestamps = false;
        $updateObj->save();
        /*Права сотрудника */
        $createClient = new PermissionRole;
        $createClient->role_id = '3';
        $createClient->permission_id = '4';
        $createClient->timestamps = false;
        $createClient->save();

        $updateClient = new PermissionRole;
        $updateClient->role_id = '3';
        $updateClient->permission_id = '5';
        $updateClient->timestamps = false;
        $updateClient->save();

        $deleteClient = new PermissionRole;
        $deleteClient->role_id = '3';
        $deleteClient->permission_id = '6';
        $deleteClient->timestamps = false;
        $deleteClient->save();
    }
}
