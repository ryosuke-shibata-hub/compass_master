<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i < 10; $i++) {
            User::create([
                'username' => 'テストユーザー'.$i,
                'email' => 'email_email'.$i.'@email.com',
                'password' => bcrypt('test'.$i),
            ]);
        }

        User::create([
            'username' => '管理者',
            'email' => 'email_email_email@email.com',
            'password' => bcrypt('123456789'),
            'admin_role' => 1,
        ]);
    }
}
