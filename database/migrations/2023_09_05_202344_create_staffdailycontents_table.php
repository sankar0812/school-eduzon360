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
        Schema::create('staffdailycontents', function (Blueprint $table) {
            $table->id();
            $table->string('staffid')->nullable();
            $table->string('date')->nullable();
            $table->string('classid')->nullable();
            $table->string('subjectid')->nullable();
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->longText('content_path')->nullable();
            $table->string('acd_year')->nullable();
            $table->string('SDC_status')->default(1);
            $table->string('SDC_delete')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffdailycontents');
    }
};
