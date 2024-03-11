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
        Schema::create('attendancetypes', function (Blueprint $table) {
            $table->id();
            $table->string("tt_id")->nullable();
            $table->string("tt_name")->nullable();
            $table->string("tt_status")->default(1);
            $table->string("tt_delete")->default(1);
            $table->timestamps();
        });

        $userData = [
            ['tt_id' => '1', 'tt_name' => 'Present',  'tt_status' => 1, 'tt_delete' => 1,],
            ['tt_id' => '2', 'tt_name' => 'Absent',  'tt_status' => 1, 'tt_delete' => 1,],


        ];

        DB::table('attendancetypes')->insert($userData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendancetypes');
    }
};
