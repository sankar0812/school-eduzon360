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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('busno')->nullable();
            $table->string('vehiclenumber')->nullable();
            $table->string('vehiclemodel')->nullable();
            $table->string('seatcount')->nullable();
            $table->string('seatoccupied')->nullable();
            $table->string('yearmade')->nullable();
            $table->string('fc')->nullable();
            $table->string('engineno')->nullable();
            $table->string('chassisno')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
