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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->references('id')->on('doctors');
            $table->foreignId('patient_id')->references('id')->on('patients');
            $table->foreignId('schedule_id')->references('id')->on('schedules');
            $table->string('remarks', 500);
            $table->string('treatment', 500);
            $table->date('confirmed_at');
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
        Schema::dropIfExists('appointments');
    }
};