<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->integer('branch_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('sex');
            $table->string('martial_status');
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->string('contact_number');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->string('address');
            $table->string('emergency_name');
            $table->string('relationship');
            $table->string('home_phone');
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
        Schema::dropIfExists('patients');
    }
}
