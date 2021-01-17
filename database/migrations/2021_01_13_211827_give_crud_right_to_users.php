<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GiveCrudRightToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_crud_right', function (Blueprint $table) {
            //
            $table->integer('id')->unsigned()->nullable();
            $table->foreign('id')->references('id')->on('user')->onDelete('set null');
            $table->string('add');
            $table->string('update');
            $table->string('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
