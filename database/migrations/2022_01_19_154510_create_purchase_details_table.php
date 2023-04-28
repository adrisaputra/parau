<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_transaction_id');
            $table->foreign("purchase_transaction_id")->references('id')->on("purchase_transactions");

            $table->unsignedBigInteger('product_id');
            $table->foreign("product_id")->references('id')->on("products");

            $table->unsignedBigInteger('amount')->default(0);
            $table->unsignedBigInteger('price')->default(0);

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
        Schema::dropIfExists('purchase_details');
    }
}
