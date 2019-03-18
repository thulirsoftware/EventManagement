<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('eventId');
            $table->string('eventName');
            $table->string('ageGroup');
            $table->string('memberType')->nullable();
            $table->string('foodType')->nullable();
            $table->string('dateRange')->nullable();
            $table->string('ticketPrice')->nullable();
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
        //
    }
}
