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
        Schema::create('dailyclasstimes', function (Blueprint $table) {
            $table->id();
            $table->string('classsection')->nullable();
            $table->string('classname')->nullable();
            $table->timestamps();
        });
        $userData = [
            ['classsection' => 'FN', 'classname' => '9.00 to 9.45'],
            ['classsection' =>  'FN', 'classname' =>  '9.45 to 10.30'],
            ['classsection' =>  'FN', 'classname' =>  '10.45.00 to 11.30'],
            ['classsection' => 'FN', 'classname' => '11.30 to 12.15'],
            ['classsection' =>  'AN', 'classname' =>  '1.00 to 1.45'],
            ['classsection' => 'AN', 'classname' => '1.45 to 2.30'],
            ['classsection' =>  'AN', 'classname' => '2.30 to 3.00'],
            ['classsection' =>  'AN', 'classname' => '3.00 to 3.30'],
        ];
        DB::table('dailyclasstimes')->insert($userData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dailyclasstimes');
    }
};
