<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('reference')->nullable();
            $table->string('description')->nullable();
            $table->integer('buying_price')->default(0);
            $table->integer('for_discount')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('percent_vat')->default(0);
            $table->integer('vat')->default(0);
            $table->integer('purchase_price_include')->default(0);
            $table->integer('percent_margin')->default(0);
            $table->integer('sale_price_ht')->default(0);
            $table->integer('amount')->default(0);
            $table->integer('quantity')->default(1);
            $table->integer('stock_min')->default(0);
            $table->integer('stock_max')->default(0);
            $table->enum('status',[0,1])->default(1);
            $table->text('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
