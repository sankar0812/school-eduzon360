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
        Schema::create('classpromotions', function (Blueprint $table) {
            $table->id();
            $table->string('cp_from')->nullable();
            $table->string('cp_to')->nullable();
            $table->string('cp_lastyear')->nullable();
            $table->string('cp_year')->nullable();
            $table->string('cp_status')->default(1);
            $table->string('cp_delete')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classpromotions');
    }
};
