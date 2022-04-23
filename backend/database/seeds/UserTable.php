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
        //     'username_kanji' => '管理者',
        //     'username_kana' => 'カンリシャ',
        //     'email' => 'email_email_email@email.com',
        //     'password' => Hash::make('123456789'),
        //     'birthday' => '2000-01-01',
        //     'AdmissionDay' => '2010-05-05',
        //     'gender' => '1',
        //     'admin_role' => '15',
        //     'logo' => 'null',
        // ]);
        //     User::create([
        //     'username_kanji' => 'テストユーザー',
        //     'username_kana' => 'テストユーザー',
        //     'email' => 'email_email@email.com',
        //     'password' => Hash::make('123456789'),
        //     'birthday' => '2000-01-01',
        //     'AdmissionDay' => '2010-05-05',
        //     'gender' => '1',
        //     'admin_role' => '10',
        //     'logo' => 'null',
        // ]);
        //      User::create([
        //     'username_kanji' => '国語教師',
        //     'username_kana' => 'コクゴキョウシ',
        //     'email' => 'kokugo@email.com',
        //     'password' => Hash::make('123456789'),
        //     'birthday' => '2000-01-01',
        //     'AdmissionDay' => '2010-05-05',
        //     'gender' => '1',
        //     'admin_role' => '0',
        //     'logo' => 'null',
        // ]);
        //      User::create([
        //     'username_kanji' => '数学教師',
        //     'username_kana' => 'スウガクキョウシ',
        //     'email' => 'suugaku@email.com',
        //     'password' => Hash::make('123456789'),
        //     'birthday' => '2000-01-01',
        //     'AdmissionDay' => '2010-05-05',
        //     'gender' => '0',
        //     'admin_role' => '5',
        //     'logo' => 'null',
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
                    'logo' => 'null',
            ]);
        }

        // factory(User::class, 20)->create();
    }
}