<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKalenderEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kalender_events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ownerId');
            $table->integer('companyId')->nullable(); //osäker på om vi använder denna eller ej
            $table->string('title', 255);
            $table->string('info', 3000)->nullable();
            $table->dateTime('startDate');
            $table->dateTime('endDate');
            $table->string('behov', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kalender_events');
    }
}
