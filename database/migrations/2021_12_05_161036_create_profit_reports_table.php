<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profit_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->integer('branch_id');
            $table->string('profit_name');
            $table->string('profit_amount');
            $table->string('profit_description');
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
        Schema::dropIfExists('profit_reports');
    }
}
