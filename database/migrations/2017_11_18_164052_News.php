<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class News extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('url')->length(255);
            $table->string('title')->length(128);
            $table->string('imgurl')->length(255)->nullable();
            $table->text('post');
            $table->integer('creator')->unsigned();         // FK to users table
            $table->integer('category')->unsigned();        // FK to categories table
            $table->boolean('active')->default(true); 
            $table->boolean('approved')->default(false);
            $table->string('slug')->length(128)->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
