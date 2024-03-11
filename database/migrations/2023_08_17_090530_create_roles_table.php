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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('r_name')->nullable();
            $table->string('r_status')->default(1);
            $table->timestamps();
        });

        $userData = [
            ['r_name' => 'Admin',  'r_status' => 1,],
            ['r_name' => 'Teaching Staff',  'r_status' => 1,],
            ['r_name' => 'Clerk',  'r_status' => 1,],
            ['r_name' => 'Front Office',  'r_status' => 1,],
            ['r_name' => 'Accountant',  'r_status' => 1,],
            // ['r_name' => 'student',  'r_status' => 1,],
            // ['r_name' => 'Parent',  'r_status' => 1,],
        ];

        DB::table('roles')->insert($userData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
