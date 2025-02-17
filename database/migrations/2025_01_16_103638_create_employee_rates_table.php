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
        Schema::create('employee_rates', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('employee_title')->nullable();
            $table->double('rate', 12, 2)->default(0);
            $table->double('ot_rate', 12, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Foreign
            $table->foreign('employee_id')->references('employee_gen_id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_rates');
    }
};
