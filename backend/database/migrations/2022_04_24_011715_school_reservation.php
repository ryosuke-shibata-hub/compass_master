<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SchoolReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('school_reservation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('予約したユーザー');
            $table->integer('reserved_room_id')->comment('予約した部屋');
            $table->datetime('event_at')->comment('予約日時');
            $table->timestamp('created_at')->useCurrent()->comment('登録日時');
            $table->timestamp('updated_at')->default(DB::raw('current_timestamp on update current_timestamp'))->comment('更新日時');
            $table->softDeletes()->comment('削除日時');
            //
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
        Schema::dropIfExists('school_reservation');
    }
}