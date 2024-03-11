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
        Schema::create('schoolinfos', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('regno')->nullable();
            $table->longText('about')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        
        $userData = [
            [
                'logo' => 'logo',
                'logo_path' => 'logo_path',
                'name' => 'name',
                'address' => 'address',
                'regno' => 'regno',
                'about' => 'about',
            
            ],
        
        ];

        DB::table('schoolinfos')->insert($userData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schoolinfos');
    }
};
