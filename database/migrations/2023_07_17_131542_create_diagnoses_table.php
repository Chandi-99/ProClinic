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
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appo_id');
            $table->string('chief_complain');
            $table->string('symptoms');
            $table->string('physical_examination');
            $table->string('recommended_tests');
            $table->string('identified_disease');
            $table->string('rest_no_days');
            $table->string('blood_pressure');
            $table->string('blood_sugar_level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnoses');
    }
};
