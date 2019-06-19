<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
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
    }
}
