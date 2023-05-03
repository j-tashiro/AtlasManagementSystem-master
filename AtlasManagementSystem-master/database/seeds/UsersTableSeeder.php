<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'over_name' => '田代',
            'under_name' => '潤太郎',
            'over_name_kana' => 'タシロ',
            'under_name_kana' => 'ジュンタロウ',
            'mail_address' => 'juntaro.tashiro@gmail.com',
            'sex' => '1',
            'birth_day' => '1993-11-26',
            'role' => '4',
            'password' => bcrypt('password'),
        ]);
    }
}