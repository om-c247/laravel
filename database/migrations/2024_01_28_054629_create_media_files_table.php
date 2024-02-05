<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaFilesTable extends Migration
{
    public function up()
    {
        Schema::create('media_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_post_id');
            $table->string('filename');
            $table->string('filetype');
            $table->timestamps();

            $table->foreign('blog_post_id')->references('id')->on('blog_posts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('media_files');
    }
}
