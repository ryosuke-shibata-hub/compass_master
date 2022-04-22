<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MyScedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('my_scedules',function(Blueprint $table) {
            $table->id();
            $table->date('start_date')->comment('開始日');
            $table->date('end_date')->commetn('終了日');
            $table->string('event_name')->comment('イベント名');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('my_scedules');
    }
}