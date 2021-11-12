<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTCalendrierEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_calendrier_events', function (Blueprint $table) {
            $table->id();
            $table->string('nom_event');
            $table->string('desc_event')->nullable();
            $table->dateTime('start_event');
            $table->dateTime('end_event');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_calendrier_events');
    }
}
