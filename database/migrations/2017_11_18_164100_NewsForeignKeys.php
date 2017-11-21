<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewsForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function(Blueprint $table) {
            $table->foreign('category')->references('id')->on('categories')->onDelete('restrict');
        });
        Schema::table('news', function(Blueprint $table) {
            $table->foreign('creator')->references('id')->on('users')->onDelete('restrict');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function(Blueprint $table) {
            $table->dropForeign(['creator']);
            $table->dropForeign(['category']);
        });
    }
}
