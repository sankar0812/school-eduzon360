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
        Schema::create('paidfees', function (Blueprint $table) {
                $table->id();
                $table->string('student_id');
                $table->string('class_id')->nullable();
                $table->string('admission')->default(0);
                $table->string('term1')->default(0);
                $table->string('term2')->default(0);
                $table->string('term3')->default(0);
                $table->string('extra')->default(0);
                $table->string('special_fees')->default(0);
                $table->string('books')->default(0);
                $table->string('uniform')->default(0);
                $table->string('fine')->default(0);
                $table->string('totalpaidfees')->default(0);
                $table->string('totalduefees')->default(0);
                $table->string('academic_year')->nullable();
                $table->string('paid_date')->nullable();
                $table->string('paid_month')->nullable();
                $table->string('status')->default(1);
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paidfees');
    }
};
