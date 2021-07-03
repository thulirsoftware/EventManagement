<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasedEventEntryTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchased_event_entry_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('eventId');
            $table->string('userId');
            $table->string('ticketId');
            $table->string('ticketQty');
            $table->string('ticketAmount');
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
        Schema::dropIfExists('purchased_event_entry_tickets');
    }
}
