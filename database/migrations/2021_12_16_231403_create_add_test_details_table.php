<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddTestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_test_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('add_test_id');
            $table->integer('gig_id');
            $table->integer('gig_quantity');
            $table->integer('gig_amount');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_test_details');
    }
}
