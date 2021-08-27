<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Pandu',
                'email' => 'pandu@cash.app',
                'password' => bcrypt('123'),
                'is_admin' => 1,
            ],
            [
                'name' => 'Budi',
                'email' => 'budi@cash.app',
                'password' => bcrypt('123'),
            ]
            ];

            foreach ($user as $key => $value) {
                User::create($value);
                
            }
    }
}
