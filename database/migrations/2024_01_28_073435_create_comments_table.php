<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('blog_post_id');
            $table->unsignedBigInteger('parent_comment_id')->nullable();
            $table->text('content');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('blog_post_id')->references('id')->on('blog_posts');
            $table->foreign('parent_comment_id')->references('id')->on('comments');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
