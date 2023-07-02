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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('medi_name')->unique();
            $table->string('company');
            $table->string('availability');
            $table->string('after_eat');
            $table->double('unit_price');
            $table->string('uses');
            $table->string('side_effects');
            $table->double('mg');
            $table->string('precautions');
            $table->string('image');
            $table->string('overdose');
            $table->string('howtouse');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
