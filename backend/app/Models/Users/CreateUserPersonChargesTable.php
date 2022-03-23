<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class CreateUserPersonChargesTable extends Model
{
    protected $table = 'user_person_charges';

    protected $fillable = [
        'user_id',
        'math_teacher_user_id',
        'japanese_language_user_id',
    ];

    // public static function teacher_name() {

    //     $name = \DB::table('users')
    //         ->join('user_person_charges','users.id',"=",'user_person_charges.math_teacher_user_id')
    //         ->get();

    //         return $name;
    // }

    // public static function teacherQuery() {
    //     return self::with('teacher_name');
    // }

    // public static function teacher_list() {
    //     return self::teacherQuery()->first();
    // }
}