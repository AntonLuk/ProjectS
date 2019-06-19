<?php

use Illuminate\Database\Seeder;

class TypeObjsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('type_of_objs')->delete();

        \DB::table('type_of_objs')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Новостройка'
                ),
            1=>
                array(
                    'id' => 2,
                    'name' => 'Вторичка'
                ),

        ));
    }
}
