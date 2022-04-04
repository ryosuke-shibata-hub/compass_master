<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuestionCommentReplies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('question_comment_replies', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('id');
            $table->integer('user_id')->comment('ユーザーid');
            $table->integer('question_comment_id')->comment('質問sid');
            $table->integer('delete_user_id')->nullable()->comment('誰が削除したか');
            $table->integer('update_user_id')->nullable()->comment('誰が編集したか');
            $table->string('comment_replies', 2500)->comment('コメントへのリプライ');
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
        Schema::dropIfExists('question_comment_replies');
    }
}