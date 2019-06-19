<?php

use Illuminate\Database\Seeder;

class TypeMaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('type_materials')->delete();

        \DB::table('type_materials')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Кирпич'
                ),
            1=>
                array(
                    'id' => 2,
                    'name' => 'Монолит'
                ),
            2=>
                array(
                    'id' => 3,
                    'name' => 'Панель'
                ),
        ));
    }
}
