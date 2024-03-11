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
        Schema::create('studenttransferreports', function (Blueprint $table) {
            $table->id('tr_id');
            $table->string('tr_student_id')->nullable();
            $table->string('tr_class_id')->nullable();
            $table->string('tr_date')->nullable();
            $table->string('tr_year')->nullable();
            $table->string('tr_status')->default(1);
            $table->string('tr_delete')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studenttransferreports');
    }
};
