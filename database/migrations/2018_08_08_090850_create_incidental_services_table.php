<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentalServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidental_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('flightId')->nullable();
            $table->string('incidentalService')->nullable();
            $table->string('qty')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->integer('INCid')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('incidental_services');
    }
}
