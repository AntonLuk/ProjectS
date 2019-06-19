<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\PermissionRole;
use App\RoleUser;
class EntrustTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = new Role;
        $adminRole->display_name = 'Администратор';
        $adminRole->name = 'administrator';
        $adminRole->description = 'System Administrator';
        $adminRole->save();

        $editorRole = new Role;
        $editorRole->display_name = 'Менеджер';
        $editorRole->name = 'manager';
        $editorRole->description = 'Руководитель группы';
        $editorRole->save();

        $employeeRole = new Role;
        $employeeRole->display_name = 'Сотрудник';
        $employeeRole->name = 'employee';
        $employeeRole->description = 'Риелтор';
        $employeeRole->save();
        //Права
        $createUser = new Permission;
        $createUser->display_name = 'Создание пользователя';
        $createUser->name = 'user-create';
        $createUser->description = 'Право на создания пользователя';
        $createUser->save();

        $updateUser = new Permission;
        $updateUser->display_name = 'Изменение пользователя';
        $updateUser->name = 'user-update';
        $updateUser->description = 'Право на редактирования пользователя';
        $updateUser->save();

        $deleteUser = new Permission;
        $deleteUser->display_name = 'Удалить пользователя';
        $deleteUser->name = 'user-delete';
        $deleteUser->description = 'Право на удаления пользователя';
        $deleteUser->save();


        /**
         * Права с клиентами
         */

        $createClient = new Permission;
        $createClient->display_name = 'Создание клиента';
        $createClient->name = 'client-create';
        $createClient->description = 'Право на создание клиента';
        $createClient->save();

        $updateClient = new Permission;
        $updateClient->display_name = 'Изменение клиента';
        $updateClient->name = 'client-update';
        $updateClient->description = 'Право на редактирование клиента';
        $updateClient->save();

        $deleteClient = new Permission;
        $deleteClient->display_name = 'Удаление клиента';
        $deleteClient->name = 'client-delete';
        $deleteClient->description = 'Право на удаление клиента';
        $deleteClient->save();

        /**
         * Права с задачами
         */

        $createTask = new Permission;
        $createTask->display_name = 'Создание задачи';
        $createTask->name = 'task-create';
        $createTask->description = 'Право на создание задачи';
        $createTask->save();

        $updateTask = new Permission;
        $updateTask->display_name = 'Изменение задачи';
        $updateTask->name = 'task-update';
        $updateTask->description = 'Право на редактирование задачи';
        $updateTask->save();

        /**
         * Права со сделками
         */

        $createDeal = new Permission;
        $createDeal->display_name = 'Создание сделки';
        $createDeal->name = 'deal-create';
        $createDeal->description = 'Право на создание сделки';
        $createDeal->save();

        $updateDeal = new Permission;
        $updateDeal->display_name = 'Изменение сделки';
        $updateDeal->name = 'deal-update';
        $updateDeal->description = 'Право на редактирование сделки';
        $updateDeal->save();
        //Объекты
        $createObj = new Permission;
        $createObj->display_name = 'Создание объекта';
        $createObj->name = 'Obj-create';
        $createObj->description = 'Право на создание объекта';
        $createObj->save();

        $updateObj = new Permission;
        $updateObj->display_name = 'Изменение объекта';
        $updateObj->name = 'Obj-update';
        $updateObj->description = 'Право на редактирование объекта';
        $updateObj->save();

        $deleteObj = new Permission;
        $deleteObj->display_name = 'Удаление объекта';
        $deleteObj->name = 'Obj-delete';
        $deleteObj->description = 'Право на удаление объекта';
        $deleteObj->save();
        //Роли ПРАВА
        $createUser1 = new PermissionRole;
        $createUser1->role_id = $adminRole->id;
        $createUser1->permission_id =$createUser->id;
        $createUser1->timestamps = false;
        $createUser1->save();

        $updateUser1 = new PermissionRole;
        $updateUser1->role_id = $adminRole->id;
        $updateUser1->permission_id = $updateUser->id;
        $updateUser1->timestamps = false;
        $updateUser1->save();

        $deleteUser1 = new PermissionRole;
        $deleteUser1->role_id = $adminRole->id;
        $deleteUser1->permission_id = $deleteUser->id;
        $deleteUser1->timestamps = false;
        $deleteUser1->save();

        $createClient1 = new PermissionRole;
        $createClient1->role_id = $adminRole->id;
        $createClient1->permission_id = $createClient->id;
        $createClient1->timestamps = false;
        $createClient1->save();

        $updateClient1 = new PermissionRole;
        $updateClient1->role_id = $adminRole->id;
        $updateClient1->permission_id = $updateClient->id;
        $updateClient1->timestamps = false;
        $updateClient1->save();

        $deleteClient1 = new PermissionRole;
        $deleteClient1->role_id = $adminRole->id;
        $deleteClient1->permission_id = $deleteClient->id;
        $deleteClient1->timestamps = false;
        $deleteClient1->save();

        $createTask1 = new PermissionRole;
        $createTask1->role_id = $adminRole->id;
        $createTask1->permission_id = $createTask->id;
        $createTask1->timestamps = false;
        $createTask1->save();

        $updateTask1 = new PermissionRole;
        $updateTask1->role_id = $adminRole->id;
        $updateTask1->permission_id = $updateTask->id;
        $updateTask1->timestamps = false;
        $updateTask1->save();

        $createObj1 = new PermissionRole;
        $createObj1->role_id = $adminRole->id;
        $createObj1->permission_id = $createObj->id;
        $createObj1->timestamps = false;
        $createObj1->save();

        $updateObj1 = new PermissionRole;
        $updateObj1->role_id = $adminRole->id;
        $updateObj1->permission_id = $updateObj->id;
        $updateObj1->timestamps = false;
        $updateObj1->save();
        /*Права сотрудника */
        $createClient1 = new PermissionRole;
        $createClient1->role_id = $employeeRole->id;
        $createClient1->permission_id = $createClient->id;
        $createClient1->timestamps = false;
        $createClient1->save();

        $updateClient1 = new PermissionRole;
        $updateClient1->role_id = $employeeRole->id;
        $updateClient1->permission_id = $updateClient->id;
        $updateClient1->timestamps = false;
        $updateClient1->save();

        $deleteClient1 = new PermissionRole;
        $deleteClient1->role_id = $employeeRole->id;
        $deleteClient1->permission_id = $deleteClient->id;
        $deleteClient1->timestamps = false;
        $deleteClient1->save();

        $newrole = new RoleUser;
        $newrole->role_id = $adminRole->id;
        $newrole->user_id = '1';
        $newrole->timestamps = false;
        $newrole->save();
    }
}
