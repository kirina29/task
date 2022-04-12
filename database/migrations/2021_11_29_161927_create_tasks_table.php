<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->text('descriptions');
            $table->decimal('price', 10, 2);
            $table->date('start_date');
            $table->date('deadline_date');
            $table->unsignedInteger('id_statuses')->nullable();
            $table->foreign('id_statuses')->references('id')->on('statuses')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedInteger('id_spaces')->nullable();
            $table->foreign('id_spaces')->references('id')->on('spaces')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('tasks');
    }
}
