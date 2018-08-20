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
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->text('body');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('post_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('post_category', function (Blueprint $table) {
            $table->unsignedInteger('post_id')->index();
            $table->unsignedInteger('category_id')->index();

            $table->foreign('post_id')
                  ->references('id')
                  ->on('posts')
                  ->onDelete('cascade');

            $table->foreign('category_id')
                  ->references('id')
                  ->on('post_categories')
                  ->onDelete('cascade');
        });

        Schema::create('post_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id')->index();
            $table->text('body');
            $table->string('author')->nullable();
            $table->string('author_email')->nullable();
            $table->string('author_website')->nullable();
            $table->timestamps();

            $table->foreign('post_id')
                  ->references('id')
                  ->on('posts')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_comments');
        Schema::dropIfExists('post_category');
        Schema::dropIfExists('post_categories');
        Schema::dropIfExists('posts');
    }
}
