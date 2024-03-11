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
        Schema::create('subexamtimetables', function (Blueprint $table) {
            $table->id();
            $table->string('exam_id')->nullable();
            $table->string('ett_date')->nullable();
            $table->string('ett_day')->nullable();
            $table->string('ett_time')->nullable();
            $table->string('ett_code')->nullable();
            $table->string('ett_subject')->nullable();
            $table->string('ett_question')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subexamtimetables');
    }
};
