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
        Schema::create('salaryexpenses', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->string('sf_name')->nullable();
            $table->string('basic_salary')->nullable();
            $table->string('overtime')->nullable();
            $table->string('bonus')->nullable();
            $table->string('allowance')->nullable();
            $table->string('reduction')->nullable();
            $table->string('reduction_reason')->nullable();
            $table->string('net_salary')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('date')->nullable();
            $table->string('month')->nullable();
            $table->string('academic_year')->nullable();
            $table->string('position')->nullable();
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
        Schema::dropIfExists('salaryexpenses');
    }
};
