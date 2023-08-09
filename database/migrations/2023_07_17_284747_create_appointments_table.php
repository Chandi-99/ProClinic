<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visiting_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('prescription_id')->nullable();
            $table->unsignedBigInteger('bill_id')->nullable();
            $table->integer('appo_number');
            $table->string('status');
            $table->date('date');
            $table->string('start_time');
            $table->foreign('visiting_id')->references('id')->on('visitings');
            $table->foreign('bill_id')->references('id')->on('bills');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
