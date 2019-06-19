<?php

use Illuminate\Database\Seeder;
use App\DepartmentUser;
class DepartamentsUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $depuser=new DepartmentUser();
        $depuser->department_id='1';
        $depuser->user_id='1';
        $depuser->save();
    }
}
