<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddTestReportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_test_report_details', function (Blueprint $table) {
            $table->id();
            $table->integer('test_report_id')->nullable();
            $table->string('test_name')->nullable();
            $table->string('test_best_range')->nullable();
            $table->string('test_result')->nullable();
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
        Schema::dropIfExists('add_test_report_details');
    }
}
