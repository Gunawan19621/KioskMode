<?php

namespace Database\Seeders;

use App\Models\User_Kiosk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserKioskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User_Kiosk::create([
            'name' => 'User Kios 1',
            'email' => 'userkios1@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User_Kiosk::create([
            'name' => 'User Kios 2',
            'email' => 'userkios2@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
