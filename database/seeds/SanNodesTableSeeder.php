<?php

use Illuminate\Database\Seeder;

class SanNodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('san_nodes')->delete();

        \DB::table('san_nodes')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Совмещенный'
                ),
            1=>
                array(
                    'id' => 2,
                    'name' => 'Раздельный'
                ),

        ));
    }
}
