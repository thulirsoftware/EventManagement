<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FamilyMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tagDvId');
            $table->string('firstName');
            $table->string('lastName')->nullable();
            $table->string('relationshipType')->nullable();
            $table->string('phoneNo')->nullable();
            $table->string('dob')->nullable();
            $table->string('schoolName')->nullable();
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
