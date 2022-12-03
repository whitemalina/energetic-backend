<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'fullname' => 'Test',
            'login' => 'testuser',
            'password' => Hash::make('123'),
        ]);
        $user->save();
        $organizations_id = [1,2];
        $user->organizations()->attach($organizations_id);
        $user->projects()->attach($organizations_id);


        \DB::table('users')->insert(array (
            0 =>
                array (
                    'id' => 2,
                    'fullname' => 'Admin',
                    'is_admin' => '1',
                    'login' => 'adminuser',
                    'password' => '$2y$10$exzpzzzghv0BdPmB0cA2AOSdp4I8bk.m8XoOr4clcW8BPVMudPsNC',
                    'remember_token' => NULL,
                    'created_at' => '2021-05-29 20:36:00',
                    'updated_at' => '2021-05-29 20:36:00',
                ),

            2 =>
                array (
                    'id' => 3,
                    'fullname' => 'Test2',
                    'is_admin' => '0',
                    'login' => 'testuser2',
                    'password' => '$2y$10$D.V9Lya56YHo0nDPbOzz/uw23F84FwyismZ7aQE28Eky0jKTaeurq',
                    'remember_token' => NULL,
                    'created_at' => '2021-05-29 20:36:00',
                    'updated_at' => '2021-05-29 20:36:00',
                ),
        ));
    }
}
