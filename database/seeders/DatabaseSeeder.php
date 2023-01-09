<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keyword_news')->delete();
        DB::table('news')->delete();
        DB::table('keywords')->delete();
        DB::table('users')->delete();
        $this->call([UserSeeder::class,KeywordSeeder::class,NewsSeeder::class]);
    }
}
