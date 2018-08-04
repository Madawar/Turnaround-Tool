<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serviceId')->unsigned();
            $table->integer('taskId')->unsigned();
            $table->integer('flightId')->unsigned();
            $table->boolean('completed')->nullable();
            $table->time('startTime')->nullable();
            $table->time('timeOfAction')->nullable();
            $table->time('endTime')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('userId')
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
        Schema::dropIfExists('task_histories');
    }
}
