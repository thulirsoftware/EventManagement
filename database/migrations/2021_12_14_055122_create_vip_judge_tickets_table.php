<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVipJudgeTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vip_judge_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('event_id');
            $table->string('competition_id');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('no_entry_tickets');
            $table->string('no_food_tickets');
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
        Schema::dropIfExists('vip_judge_tickets');
    }
}
