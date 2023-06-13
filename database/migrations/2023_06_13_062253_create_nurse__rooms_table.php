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
        Schema::create('nurse__rooms', function (Blueprint $table) {
            $table->id('id');
            $table->date('date');
            $table->string('session');
            $table->unsignedBigInteger('nurse_id');
            $table->unsignedBigInteger('room_id');
            $table->foreign('nurse_id')->references('id')->on('nurses');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nurse__rooms');
    }
};
