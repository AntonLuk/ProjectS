<?php

use Illuminate\Database\Seeder;
use App\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Праа с пользователями
         */

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
    }
}
