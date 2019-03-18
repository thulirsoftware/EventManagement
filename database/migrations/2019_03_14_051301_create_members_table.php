<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('primaryEmail');
            $table->string('secondaryEmail')->nullable();
            $table->string('tagDvId')->nullable();
            $table->string('gender');
            $table->string('dob');
            $table->string('maritalStatus');
            $table->string('phoneNo1');
            $table->string('phoneNo2')->nullable();
            $table->string('addressLine1');
            $table->string('addressLine2')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('zipCode');
            $table->string('membershipType');
            $table->string('membershipExpiryDate')->nullable();
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
        Schema::dropIfExists('members');
    }
}
