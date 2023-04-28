<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number');
            $table->enum('status', ['CART', 'PO', 'DONE']);
            $table->unsignedBigInteger('pay_cost')->default(0);
            $table->unsignedBigInteger('total_price')->default(0);
            $table->string('transaction_date')->default('');

            // relation
            $table->unsignedBigInteger('user_id');
            $table->foreign("user_id")->references('id')->on("users");

            $table->unsignedBigInteger('supplier_id')->default(1);
            $table->foreign("supplier_id")->references('id')->on("suppliers");

            // timestampe
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
        Schema::dropIfExists('purchase_transactions');
    }
}
