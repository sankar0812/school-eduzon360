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
        Schema::create('staffpositions', function (Blueprint $table) {
            $table->id();
            $table->string('sp_id')->nullable();
            $table->string('sp_name')->nullable();
            $table->string('sp_status')->default(1);
            $table->string('sp_delete')->default(1);
            $table->timestamps();
        });

        $userData = [
            ['sp_id' => '1',  'sp_name' => 'Teaching Staff',  'sp_status' => 1,  'sp_delete' => 1,],
            ['sp_id' => '2',  'sp_name' => 'NON Teaching Staff',  'sp_status' => 1,  'sp_delete' => 1,],
            ['sp_id' => '3',  'sp_name' => 'Cleaning Staff',  'sp_status' => 1,  'sp_delete' => 1,],
            ['sp_id' => '4',  'sp_name' => 'Driver Staff',  'sp_status' => 1,  'sp_delete' => 1,],

        ];

        DB::table('staffpositions')->insert($userData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffpositions');
    }
};
