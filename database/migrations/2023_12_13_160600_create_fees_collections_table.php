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
        Schema::create('fees_collections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fees_id');
            $table->unsignedBigInteger('student_id');
            $table->decimal('amount', 10, 2);
            $table->date('paid_date');
            $table->string('academic_date');
            // $table->decimal('balance', 10, 2)->default(0);
            // $table->decimal('total_fees_paid', 10, 2)->default(0);
            $table->string('payment_method', 50);
            $table->string('status', 20)->default(1);
            $table->timestamps();

            $table->foreign('fees_id')->references('id')->on('fees');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees_collections');
    }
};
