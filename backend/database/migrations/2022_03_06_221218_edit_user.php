<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // Schema::table('users', function (Blueprint $table) {
        //     //
        //     $table->string('username_kanji', 60)->comment('名前(漢字)');
        //     $table->string('username_kana', 60)->comment('名前(カナ)');
        //     $table->timestamp('birthday')->useCurrent()->comment('誕生日');
        //     $table->timestamp('AdmissionDay')->useCurrent()->comment('入学日');
        //     $table->integer('gender')->default(10)->nullable()->comment('性別');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}