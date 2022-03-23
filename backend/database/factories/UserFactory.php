<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'username_kanji' => $faker->name,
        'username_kana' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $faker->password,
        'birthday' => '2010-01-01',
        'AdmissionDay' => '2015-05-05',
        'gender' => '0',
        'admin_role' => '10',
    ];
});