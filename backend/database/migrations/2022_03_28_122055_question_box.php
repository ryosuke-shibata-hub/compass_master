<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuestionBox extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        //
        Schema::create('question_boxes', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('id');
            $table->integer('user_id')->comment('ユーザーid');
            $table->integer('delete_user_id')->nullable()->comment('誰が削除したか');
            $table->integer('update_user_id')->nullable()->comment('誰が編集したか');
            $table->string('title', 255)->comment('タイトル');
            $table->string('question_detail', 5000)->comment('質問内容');
            $table->integer('tag_id')->comment('質問のタグid');
            $table->integer('question_status')->comment('質問のステータス');
            $table->date('event_at')->comment('何年何月何日の投稿か');
            $table->timestamp('created_at')->useCurrent()->comment('登録日時');
            $table->timestamp('updated_at')->default(DB::raw('current_timestamp on update current_timestamp'))->comment('更新日時');
            $table->softDeletes()->comment('削除日時');
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
        Schema::dropIfExists('question_box');
    }
}