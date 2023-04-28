<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('project_detail_id');
            $table->foreign("project_detail_id")->references('id')->on("project_details");

            $table->unsignedBigInteger('product_id');
            $table->foreign("product_id")->references('id')->on("products");

            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('materials');
    }
}
