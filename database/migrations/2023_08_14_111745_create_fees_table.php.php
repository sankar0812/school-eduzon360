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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('fees_structure_id');
            $table->decimal('annual_fees', 10);
            $table->decimal('exam_fees', 10);
            $table->decimal('transport', 10);
            $table->decimal('others', 10);
            $table->string('reason')->nullable();
            $table->decimal('total', 10);
            $table->string('academic_year')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
