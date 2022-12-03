<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('posts')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Название',
                    'description' => 'Описание',
                    'photo_url' => 'фывфыв',
                    'scheme_url' => 'фывфыв',
                    'geotag' => '61.230859, 73.236817',
                    'risks' => 'Риски',
                    'security' => 'Безопасность всякая',
                    'project_id' => '1',
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'Название2',
                    'description' => 'Описание2',
                    'photo_url' => 'фывфыв2',
                    'scheme_url' => 'фывфыв2',
                    'geotag' => '61.230859, 73.236817',
                    'risks' => 'Риски2',
                    'security' => 'Безопасность всякая2',
                    'project_id' => '2',
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'Название3',
                    'description' => 'Описание3',
                    'photo_url' => 'фывфыв3',
                    'scheme_url' => 'фывфыв3',
                    'geotag' => '61.230859, 73.236817',
                    'risks' => 'Риски3',
                    'security' => 'Безопасность всякая3',
                    'project_id' => '3',
                ),
        ));
    }
}
