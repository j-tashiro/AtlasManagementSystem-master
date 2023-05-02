<?php

use Illuminate\Database\Seeder;
use App\Models\Users\Subjects;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 国語、数学、英語を追加
        // 2023.05.02 初期データの登録
        DB::table('subjects')->insert([
            'subject' => '国語',
        ]);
        DB::table('subjects')->insert([
            'subject' => '数学',
        ]);
        DB::table('subjects')->insert([
            'subject' => '英語',
        ]);
    }
}