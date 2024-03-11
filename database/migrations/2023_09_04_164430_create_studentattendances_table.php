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
        Schema::create('studentattendances', function (Blueprint $table) {
            $table->id();
            $table->string('stud_id')->nullable();
            $table->string('stud_classid')->nullable();
            $table->string('stud_attid')->nullable();
            $table->string('stud_year')->nullable();
            $table->string('stud_date')->nullable();
            $table->string('stud_month')->nullable();
            $table->string('stud_status')->default(1);
            $table->string('stud_delete')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentattendances');
    }
};
