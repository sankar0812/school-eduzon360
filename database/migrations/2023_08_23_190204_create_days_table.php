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
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->string('day_name')->nullable();
            $table->string('day_status')->default(1);
            $table->string('day_delete')->default(1);
            $table->timestamps();
        });

        $userData = [
            ['day_name' => 'Monday', 'day_status' => '1',  'day_delete' => 1,],
            ['day_name' => 'Tuesday', 'day_status' => '1',  'day_delete' => 1,],
            ['day_name' => 'Wednesday', 'day_status' => '1',  'day_delete' => 1,],
            ['day_name' => 'Thursday', 'day_status' => '1',  'day_delete' => 1,],
            ['day_name' => 'Friday', 'day_status' => '1',  'day_delete' => 1,],
            ['day_name' => 'Saturday', 'day_status' => '0',  'day_delete' => 1,],
            ['day_name' => 'Sunday', 'day_status' => '0',  'day_delete' => 1,],

        ];

        DB::table('days')->insert($userData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days');
    }
};
