<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('title')->length(128);
            $table->string('subtitle')->length(1024)->nullable;
            $table->text('body');
            $table->integer('creator')->unsigned();         // FK to users table
            $table->integer('category')->unsigned();        // FK to categories table
            $table->boolean('active')->default(true); 
            $table->boolean('approved')->default(false);            
            $table->string('image')->nullable();
            $table->string('keywords')->length(128)->nullable(); 
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
        Schema::drop('posts');
    }
}
