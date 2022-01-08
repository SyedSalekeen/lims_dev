<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_tests', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->integer('branch_vendor_id')->nullale();
            $table->integer('branch_id');
            $table->integer('patient_mr_no');
            $table->date('report_issue_date');
            $table->string('test_amount');
            $table->string('test_discount_amount')->nullale();
            $table->string('additional_discount_amount')->nullale();
            $table->string('total_test_amount');
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
        Schema::dropIfExists('add_tests');
    }
}
