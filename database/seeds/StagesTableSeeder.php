<?php

use Illuminate\Database\Seeder;

class StagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('stages')->delete();

        \DB::table('stages')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Звонок'
                ),
            1=>
                array(
                    'id' => 2,
                    'name' => 'Показ'
                ),
            3=>
                array(
                    'id' => 3,
                    'name' => 'Бронь'
                ),
            4=>
                array(
                    'id' => 4,
                    'name' => 'Сделка'
                ),
            5=>
                array(
                    'id' => 5,
                    'name' => 'Задаток'
                ),

        ));
    }
}
