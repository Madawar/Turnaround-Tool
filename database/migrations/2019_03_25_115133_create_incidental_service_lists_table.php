<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentalServiceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidental_service_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('INCid')->unique();
            $table->text('description')->nullable();
            $table->text('REMARKS')->nullable();
            $table->string('uom')->nullable();
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
        Schema::dropIfExists('incidental_service_lists');
    }
}
