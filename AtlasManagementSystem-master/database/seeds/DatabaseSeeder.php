<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 2023.05.02 初期データの登録
        $this->call(SubjectsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}