<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventEntryTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_entry_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('eventId');
            $table->string('ageGroup');
            $table->string('memberType')->nullable();
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
        Schema::dropIfExists('event_entry_tickets');
    }
}
