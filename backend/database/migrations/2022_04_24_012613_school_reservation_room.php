<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SchoolReservationRoom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::create('school_reservation_room', function (Blueprint $table) {
            $table->increments('id');
            $table->text('room_name')->comment('部屋名');
            $table->text('room_flg')->comment('0=リモート、1=>本社');
            $table->integer('number_of_free_slots')->comment('空き枠数');
            // $table->datetime('event_at')->comment('予約日時');
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
    }
}