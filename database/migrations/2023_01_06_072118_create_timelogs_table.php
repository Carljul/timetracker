<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timelogs', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->date('activity_date');
            $table->string('time_in');
            $table->string('lunch_break_start')->nullable();
            $table->string('lunch_brek_ends')->nullable();
            $table->string('time_out')->nullable();
            $table->string('undertime')->nullable();
            $table->string('overtime')->nullable();
            $table->string('late')->nullable();
            $table->timestamps();

            // Foreign
            $table->foreign('employee_id')->references('employee_gen_id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timelogs');
    }
};
