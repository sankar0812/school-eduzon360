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
        Schema::create('bulkclassmessages', function (Blueprint $table) {
            $table->id();
            $table->string('bcm_senderid')->nullable();
            $table->string('bcm_classid')->nullable();
            $table->longText('bcm_subject')->nullable();
            $table->longText('bcm_message')->nullable();
            $table->string('bcm_year')->nullable();
            $table->string('datetime')->nullable();
            $table->string('bcm_status')->default(1);
            $table->string('bcm_delete')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulkclassmessages');
    }
};
