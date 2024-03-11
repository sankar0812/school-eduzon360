<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('hashpasses', function (Blueprint $table) {
            $table->id();
            $table->string('loginid')->nullable();
            $table->string('ha_name')->nullable();
            $table->string('ha_status')->default(1);
            $table->string('ha_delete')->default(1);
            $table->timestamps();
        });
        $userData = [
            ['loginid' => '1', 'ha_name' => 98659865,  'ha_status' => 1, 'ha_delete' => 1,],
            ['loginid' => '2', 'ha_name' => 12345678, 'ha_status' => 1, 'ha_delete' => 1,],
        ];

        DB::table('hashpasses')->insert($userData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hashpasses');
    }
};
