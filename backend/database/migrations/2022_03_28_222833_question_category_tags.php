<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuestionCategoryTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_tag_categories', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('id');
            $table->string('question_tag', 255)->unique()->comment('タグタイトル');
            $table->timestamp('created_at')->useCurrent()->comment('登録日時');
            $table->timestamp('updated_at')->default(DB::raw('current_timestamp on update current_timestamp'))->comment('更新日時');
            $table->softDeletes()->comment('削除日時');
            $table->binary('tag_logo')->comment('画像');
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_category_tags');
    }
}