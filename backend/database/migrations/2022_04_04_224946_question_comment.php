<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuestionComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('question_comments', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('id');
            $table->integer('user_id')->comment('ユーザーid');
            $table->integer('question_id')->comment('質問id');
            $table->integer('delete_user_id')->nullable()->comment('誰が削除したか');
            $table->integer('update_user_id')->nullable()->comment('誰が編集したか');
            $table->string('comment', 2500)->comment('コメント');
            $table->date('event_at')->comment('何年何月何日の投稿か');
            $table->timestamp('created_at')->useCurrent()->comment('登録日時');
            $table->timestamp('updated_at')->default(DB::raw('current_timestamp on update current_timestamp'))->comment('更新日時');
            $table->softDeletes()->comment('削除日時');
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_comments');
    }
}