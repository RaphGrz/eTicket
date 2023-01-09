<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        User::create([
            'name' => 'admin',
            'last_name' => 'admin',
            'birth_date' => '2000-01-01',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$FvTl/pJwrR.i9ppTDf8oL.1TAtrtO3Sb3P/pi1cpi3umdzFT3.MDy',
            'remember_token' => '',
        ]);
        //User::factory()->count(10)->create();
    }
}
