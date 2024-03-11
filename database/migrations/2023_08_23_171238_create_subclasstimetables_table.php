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
        Schema::create('subclasstimetables', function (Blueprint $table) {
            $table->id();
            $table->string('tt_id')->nullable();
            $table->string('day_id')->nullable();
            $table->string('pre1')->nullable();
            $table->string('pre2')->nullable();
            $table->string('pre3')->nullable();
            $table->string('pre4')->nullable();
            $table->string('pre5')->nullable();
            $table->string('pre6')->nullable();
            $table->string('pre7')->nullable();
            $table->string('pre8')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subclasstimetables');
    }
};
