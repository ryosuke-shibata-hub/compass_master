<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;
use Faker\Factory as Faker;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        // User::truncate();

        // User::create([
        //     'username_kanji' => '山田太郎',
        //     'username_kana' => 'ヤマダタロウ',
        //     'email' => 'yamada@test.com',
        //     'password' => Hash::make('test'),
        //     'birthday' => '2000-01-01',
        //     'AdmissionDay' => '2010-05-05',
        //     'gender' => '1',
        //     'admin_role' => '10',
        // ]);

        //日本語のテストデータ作成
        $faker = Faker::create('ja_JP');

        // 100件のテストデータを繰り返し作成
        for($i = 0; $i < 10; $i++){
            User::create([
                    'username_kanji' => $faker->name,
                    'username_kana' => $faker->name,
                    'email' => $faker->unique()->safeEmail,
                     'password' => Hash::make('123456789'),
                    'birthday' => '2000-01-01',
                    'AdmissionDay' => '2010-05-05',
                    'gender' => '1',
                    'admin_role' => '10',
            ]);
        }

        factory(User::class, 100)->create();
    }
}