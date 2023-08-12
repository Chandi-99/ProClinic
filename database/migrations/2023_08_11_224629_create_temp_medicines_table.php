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
        Schema::create('temp_medicines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medi_id');
            $table->unsignedBigInteger('prescription_id');
            $table->string('quantity');
            $table->string('dose');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_medicines');
    }
};
