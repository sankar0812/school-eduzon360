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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->string('sf_name')->nullable();
            $table->string('basic_salary')->default(0);
            $table->string('overtime')->default(0);
            $table->string('bonus')->default(0);
            $table->string('allowance')->default(0);
            $table->string('reduction')->default(0);
            $table->string('reduction_reason')->nullable();
            $table->string('net_salary')->default(0);
            $table->string('payment_method')->nullable();
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
        Schema::dropIfExists('salaries');
    }
};
