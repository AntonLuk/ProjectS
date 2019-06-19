<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('StagesTableSeeder');
        $this->call('UsersTableSeeder');
//        $this->call('PermissionTableSeeder');
//        $this->call('RolesTableSeeder');
//        $this->call('RolePermissionTableSeeder');
        $this->call('EntrustTableSeeder');
        //$this->call('UserRoleTableSeeder');
        $this->call('DepartamentsTableSeeder');
        $this->call('DistrictsTableSeeder');
        $this->call('SanNodesTableSeeder');
        $this->call('TypeClientsTableSeeder');
        $this->call('TypeMaterialsTableSeeder');
        $this->call('TypeObjsTableSeeder');
        $this->call('TypeRepairsTableSeeder');
        $this->call('ConstructsTableSeeder');
        $this->call('ComplexsTableSeeder');
        $this->call('DepartamentsUsersTableSeeder');
        $this->call('StagesTableSeeder');
        $this->call('RoomsTableSeeder');

    }
}
