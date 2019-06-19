<?php

use Illuminate\Database\Seeder;
use App\DepartmentUser;
use App\Department;

class DepartamentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createDep = new Department();
        $createDep->id = '1';
        $createDep->name = 'Без группы';
        //$createDep->user_id=1;
        $createDep->save();
        $createDep = new Department();
        $createDep->id = '2';
        $createDep->name = 'Новички';
        $createDep->save();
//        $createDep = new Department();
//        $createDep->id = '3';
//        $createDep->name = 'Группка №2';
//        $createDep->save();
//        $depuser=new DepartmentUser();
//        $depuser->insert([
//            'department_id' => 1,
//            'user_id' => 1
//        ]);
    }
}
