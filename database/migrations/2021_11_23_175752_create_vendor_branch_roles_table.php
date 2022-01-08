<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorBranchRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_branch_roles', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->integer('branch_id');
            $table->string('role_name');
            $table->string('status')->default('1');
            $table->string('delete_status')->default('0');
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
        Schema::dropIfExists('vendor_branch_roles');
    }
}
