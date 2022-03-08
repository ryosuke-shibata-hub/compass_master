<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPersonChargesTable extends Migration
{
    public function up()
    {
        Schema::create('user_person_charges', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('id');
            $table->integer('user_id')->comment('ユーザーid');
            $table->integer('japanese_language_user_id')->nullable()->comment('国語講師id');
            $table->integer('math_teacher_user_id')->nullable()->comment('数学講師id');
            $table->timestamp('created_at')->useCurrent()->comment('登録日時');
            $table->timestamp('updated_at')->default(DB::raw('current_timestamp on update current_timestamp'))->comment('更新日時');
            $table->softDeletes()->comment('削除日時');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_person_charges');
    }
}