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
        Schema::create('examtimetables', function (Blueprint $table) {
            $table->id();
            $table->string('class_id')->nullable();
            $table->string('examtype_id')->nullable();
            $table->string('months_id')->nullable();
            $table->string('year')->nullable();
            $table->string('status')->default(1);
            $table->string('delete')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examtimetables');
    }
};
