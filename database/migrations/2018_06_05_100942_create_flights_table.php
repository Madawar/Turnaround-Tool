<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('carrier')->unsigned();
            $table->string('flightNo')->nullable();
            $table->string('orig')->nullable();
            $table->string('dest')->nullable();
            $table->string('flightType')->nullable();
            $table->string('aircraftType')->nullable();
            $table->string('aircraftRegistration')->nullable();
            $table->string('turnaroundType')->nullable();
            $table->date('flightDate')->nullable();
            $table->dateTime('arrival')->nullable();
            $table->dateTime('departure')->nullable();
            $table->dateTime('STA')->nullable();
            $table->dateTime('STD')->nullable();
            $table->integer('delayCode')->nullable();
            $table->string('remarks')->nullable();
            $table->boolean('loaded')->nullable();
            $table->boolean('transferred')->nullable();
            $table->text('oshDescription')->nullable();
            $table->boolean('hasOshIssue')->nullable();
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
        Schema::dropIfExists('flights');
    }
}
