<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('task')->nullable();
            $table->integer('serviceId')->unsigned();
            $table->boolean('timed')->default(0)->nullable();
            $table->string('linkedTo')->nullable();
            $table->string('timeFrom')->nullable();
            $table->double('cutOffTime', 16, 2)->nullable();
            $table->double('minimumStaff')->nullable();
            $table->string('symbol')->nullable();
            $table->integer('order')->nullable();
            $table->string('minutesToBeDoneAppliesTo')->nullable();
            $table->double('minutesToBeDone')->nullable();
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
