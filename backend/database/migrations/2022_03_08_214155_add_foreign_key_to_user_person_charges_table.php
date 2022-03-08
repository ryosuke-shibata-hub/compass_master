<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToUserPersonChargesTable extends Migration
{
    public function up()
    {
        Schema::table('user_person_charges', function (Blueprint $table) {

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('math_teacher_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('japanese_language_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('user_scores', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['math_teacher_user_id']);
            $table->dropForeign(['japanese_language_user_id']);
        });
    }
}