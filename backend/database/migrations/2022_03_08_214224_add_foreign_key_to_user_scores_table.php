<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToUserScoresTable extends Migration
{
    public function up()
    {
        Schema::table('user_scores', function (Blueprint $table) {

            $table->foreign('user_id')
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
        });
    }
}