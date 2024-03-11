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
        Schema::create('studentdailyexams', function (Blueprint $table) {
            $table->id();
            $table->string('class_id')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('subject_id')->nullable();
            $table->string('examtype_id')->nullable();
            $table->string('exam_date')->nullable();
            $table->string('exam_month')->nullable();
            $table->string('exam_year')->nullable();
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
        Schema::dropIfExists('studentdailyexams');
    }
};
