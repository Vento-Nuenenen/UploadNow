<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forms_users', function (Blueprint $table) {
            $table->foreign('FK_USR')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('FK_FORM')->references('id')->on('forms')->onDelete('cascade');
        });

        Schema::table('entries', function (Blueprint $table) {
            $table->foreign('FK_FORM')->references('id')->on('forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fks');
    }
}
