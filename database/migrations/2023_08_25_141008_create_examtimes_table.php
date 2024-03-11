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
        Schema::create('examtimes', function (Blueprint $table) {
            $table->id();
            $table->string('et_id')->nullable();
            $table->string('et_name')->nullable();
            $table->string('time')->nullable();
            $table->string('et_status')->default(1);
            $table->string('et_delete')->default(1);
            $table->timestamps();
        });
        $userData = [
            ['et_id' => '1', 'et_name' => 'FN',  'time' => '9.30am to 12.30pm', 'et_status' => 1, 'et_delete' => 1,],
            ['et_id' => '2', 'et_name' => 'AN', 'time' => '1.30pm to 4.30pm', 'et_status' => 1, 'et_delete' => 1,],
        ];

        DB::table('examtimes')->insert($userData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examtimes');
    }
};
