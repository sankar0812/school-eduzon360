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
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->string('hw_staffid')->nullable();
            $table->string('hw_date')->nullable();
            $table->string('hw_classid')->nullable();
            $table->string('hw_subjectid')->nullable();
            $table->string('hw_title')->nullable();
            $table->longText('hw_content')->nullable();
            $table->longText('hw_content_path')->nullable();
            $table->string('acd_year')->nullable();
            $table->string('hw_status')->default(1);
            $table->string('hw_delete')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homework');
    }
};
