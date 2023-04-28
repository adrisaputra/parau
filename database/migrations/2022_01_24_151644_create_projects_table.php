<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable();
            $table->string('project_name')->nullable();
            $table->string('client_name')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            // relation
            $table->unsignedBigInteger('outlet_id');
            $table->foreign("outlet_id")->references('id')->on("outlets");

            // timestamps
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
        Schema::dropIfExists('projects');
    }
}
