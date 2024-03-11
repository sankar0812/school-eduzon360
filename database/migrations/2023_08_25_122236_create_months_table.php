<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('months', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->string('monthName')->nullable();
            $table->timestamps();
        });

        $userData = [
            ['month' => '1', 'monthName' => 'January'],
            ['month' => '2', 'monthName' => 'February'],
            ['month' => '3', 'monthName' => 'March'],
            ['month' => '4', 'monthName' => 'April'],
            ['month' => '5', 'monthName' => 'May'],
            ['month' => '6', 'monthName' => 'June'],
            ['month' => '7', 'monthName' => 'July'],
            ['month' => '8', 'monthName' => 'August'],
            ['month' => '9', 'monthName' => 'September'],
            ['month' => '10', 'monthName' => 'October'],
            ['month' => '11', 'monthName' => 'November'],
            ['month' => '12', 'monthName' => 'December'],

        ];

        DB::table('months')->insert($userData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('months');
    }
};
