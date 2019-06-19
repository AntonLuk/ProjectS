<?php

use Illuminate\Database\Seeder;

class ComplexsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('complexs')->delete();

        DB::table('complexs')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Видный',
                    'construct_id'=>1
                ),
            1=>
                array(
                    'id' => 2,
                    'name' => 'Гармония',
                    'construct_id'=>2
                ),
            2=>
                array(
                    'id' => 3,
                    'name' => 'Чемпионский',
                    'construct_id'=>3
                ),
            3=>
                array(
                    'id' => 4,
                    'name' => 'Звездный городок',
                    'construct_id'=>4
                ),
        ));

    }
}
