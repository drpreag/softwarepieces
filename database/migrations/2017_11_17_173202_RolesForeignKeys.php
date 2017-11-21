<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RolesForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // can be trigged only after seed
        //Schema::table('roles', function(Blueprint $table) {
        //    $table->foreign('creator')->references('id')->on('users')->onDelete('restrict');
        //});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropForeign(['roles_creator_foreign']);
    }
}
