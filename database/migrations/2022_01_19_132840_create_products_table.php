<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('product_name');
            $table->string('unit');
            $table->string('image');
            $table->string('purchase_price');
            $table->string('selling_price');
            $table->integer('discount_amount')->default(0);
            $table->string('discount_reason')->default('');
            $table->text('description');
            $table->integer('status')->default(1);

            // relation
            $table->unsignedBigInteger('outlet_id');
            $table->foreign("outlet_id")->references('id')->on("outlets");

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
        Schema::dropIfExists('products');
    }
}
