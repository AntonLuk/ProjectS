<?php

use Illuminate\Database\Seeder;

class TypeRepairsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('repairs')->delete();

        \DB::table('repairs')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Черновой'
                ),
            1=>
                array(
                    'id' => 2,
                    'name' => 'Улучшн. Черновая'
                ),
            2=>
                array(
                    'id' => 3,
                    'name' => 'Обычный'
                ),
            3=>
                array(
                    'id' => 4,
                    'name' => 'Дизайнерский'
                ),
        ));
    }
}
