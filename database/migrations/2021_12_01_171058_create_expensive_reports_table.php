<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensiveReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expensive_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->integer('branch_id');
            $table->string('expensive_name');
            $table->date('expensive_date');
            $table->string('expensive_amount');
            $table->string('expensive_description');
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
        Schema::dropIfExists('expensive_reports');
    }
}
