<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsBlogPostTable extends Migration
{
    public function up()
    {
        Schema::create('tags_blog_post', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('blog_post_id');
            $table->timestamps();

            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('blog_post_id')->references('id')->on('blog_posts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tags_blog_post');
    }
}
