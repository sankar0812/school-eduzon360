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
        Schema::create('submarkentries', function (Blueprint $table) {
            $table->id();
            $table->string('mark_id')->nullable();
            $table->string('subject_id')->nullable();
            $table->string('student_id')->nullable();
            $table->string('mark')->nullable();
            $table->string('internal')->nullable();
            $table->string('external')->nullable();
            $table->string('exammonth_id')->nullable();
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
        Schema::dropIfExists('submarkentries');
    }
};
