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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_name')->nullable();
            $table->string('date')->nullable();
            $table->string('intime')->nullable();
            $table->string('outtime')->nullable();
            $table->string('phone')->nullable();
            $table->string('staff_to_meet')->nullable();
            $table->string('visitor_type')->nullable();
            $table->string('purpose')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
