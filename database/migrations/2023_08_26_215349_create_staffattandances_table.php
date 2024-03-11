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
        Schema::create('staffattandances', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id')->nullable();
            $table->string('position_id')->nullable();
            $table->string('att_id')->nullable();
            $table->string('permission')->nullable();
            $table->string('att_year')->nullable();
            $table->string('att_date')->nullable();
            $table->string('att_month')->nullable();
            $table->string('att_status')->default(1);
            $table->string('att_delete')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffattandances');
    }
};
