<?php

use Illuminate\Database\Seeder;

class TypeClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('type_clients')->delete();

        \DB::table('type_clients')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Покупатель'
                ),
            1=>
                array(
                    'id' => 2,
                    'name' => 'Продавец'
                ),

        ));
    }
}
