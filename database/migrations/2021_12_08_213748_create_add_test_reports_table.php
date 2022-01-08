<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddTestReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_test_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->integer('branch_vendor_id')->nullable();
            $table->integer('branch_id');
            $table->integer('patient_id');
            $table->string('patient_report');
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
        Schema::dropIfExists('add_test_reports');
    }
}
