<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('organizations')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Организация 1',
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'Организация 2',
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'Организация 3',
                ),
        ));
    }
}
