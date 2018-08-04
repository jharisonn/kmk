<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('comment', function (Blueprint $table) {
          $table->increments('id_comment');
          $table->string('name');
          $table->longText('comment');
          $table->unsignedInteger('id_post');
          $table->foreign('id_post')->references('id_post')->on('posts');
          $table->timestamp('posted_on');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
}
