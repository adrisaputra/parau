<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_details', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable();
            
            $table->unsignedBigInteger('project_id');
            $table->foreign("project_id")->references('id')->on("projects");

            $table->string('work_name')->nullable();
            $table->text('description')->nullable();
            $table->string('service_value')->nullable();
            $table->integer('volume')->nullable();
            $table->string('image')->nullable();
            $table->date('work_start')->nullable();
            $table->date('work_end')->nullable();
            $table->integer('estimation')->default(0);
            $table->string('team')->nullable();
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
        Schema::dropIfExists('project_details');
    }
}
