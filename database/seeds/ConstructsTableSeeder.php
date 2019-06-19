<?php

use Illuminate\Database\Seeder;

class ConstructsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('constructs')->delete();

        DB::table('constructs')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Брусника'
                ),
            1=>
                array(
                    'id' => 2,
                    'name' => 'Аижк'
                ),
            2=>
                array(
                    'id' => 3,
                    'name' => 'Б-72'
                ),
            3=>
                array(
                    'id' => 4,
                    'name' => 'Снегири'
                ),
        ));

    }
}
