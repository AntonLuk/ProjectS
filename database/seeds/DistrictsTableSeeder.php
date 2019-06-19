<?php

use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('districts')->delete();

        \DB::table('districts')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Ленинский'
                ),
            1=>
            array(
                'id' => 2,
                'name' => 'Калининский'
            ),
            2=>
                array(
                    'id' => 3,
                    'name' => 'Центральный'
                ),
            3=>
                array(
                    'id' => 4,
                    'name' => 'Восточный'
                ),
        ));
    }
}
