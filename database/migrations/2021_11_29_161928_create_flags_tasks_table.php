<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlagsTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flags_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_flags')->nullable();
            $table->foreign('id_flags')->references('id')->on('flags')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedInteger('id_tasks')->nullable();
            $table->foreign('id_tasks')->references('id')->on('tasks')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('flags_tasks');
    }
}
