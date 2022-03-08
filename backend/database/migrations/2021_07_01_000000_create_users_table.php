<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('id');
            // $table->string('username', 60)->comment('名前');
            $table->string('username_kanji', 60)->comment('名前(漢字)');
            $table->string('username_kana', 60)->comment('名前(カナ)');
            $table->timestamp('birthday')->comment('誕生日');
            $table->timestamp('AdmissionDay')->comment('入学日');
            $table->integer('gender')->default(10)->comment('性別');
            $table->string('email', 255)->unique()->comment('メールアドレス');
            $table->string('password', 255)->comment('パスワード');
            $table->integer('admin_role')->default(10)->nullable()->comment('権限');
            $table->binary('logo')->comment('画像');
            $table->timestamp('created_at')->useCurrent()->comment('登録日時');
            $table->timestamp('updated_at')->default(DB::raw('current_timestamp on update current_timestamp'))->comment('更新日時');
            $table->softDeletes()->comment('削除日時');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}