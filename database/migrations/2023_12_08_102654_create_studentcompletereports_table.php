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
        Schema::create('studentcompletereports', function (Blueprint $table) {
            $table->id('cr_id');
            $table->string('cr_student_id')->nullable();
            $table->string('cr_class_id')->nullable();
            $table->string('cr_date')->nullable();
            $table->string('cr_year')->nullable();
            $table->string('cr_status')->default(1);
            $table->string('cr_delete')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentcompletereports');
    }
};
