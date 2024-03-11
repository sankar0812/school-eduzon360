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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('sender_admin')->nullable();
            $table->string('sender_staff')->nullable();
            $table->string('sender_student')->nullable();
            $table->string('receiver_admin')->nullable();
            $table->string('receiver_staff')->nullable();
            $table->string('receiver_student')->nullable();
            $table->string('subject')->nullable();
            $table->longText('message')->nullable();
            $table->string('datetime');
            $table->string('attachment')->nullable();
            $table->string('attachment_path')->nullable();
            $table->string('status')->default(1);
            $table->string('mes_delete')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
