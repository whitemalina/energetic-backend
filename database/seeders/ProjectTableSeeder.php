<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('projects')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Проект 1',
                    'organization_id' => '1',
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'Проект 2',
                    'organization_id' => '2',
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'Проект 3',
                    'organization_id' => '3',
                ),
        ));
    }
}
