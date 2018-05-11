<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('body');
            $table->unsignedInteger('author_id')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('post_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->unsignedInteger('post_id')->index();
            $table->unsignedInteger('tag_id')->index();

            $table->foreign('post_id')
                  ->references('id')
                  ->on('posts')
                  ->onDelete('cascade');

            $table->foreign('tag_id')
                  ->references('id')
                  ->on('post_tags')
                  ->onDelete('cascade');
        });

        Schema::create('post_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            $table->string('author')->nullable();
            $table->string('author_email')->nullable();
            $table->string();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_comments');
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('post_tags');
        Schema::dropIfExists('posts');
    }
}
