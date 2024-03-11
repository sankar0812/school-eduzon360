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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('s_admissionno')->nullable()->unique();
            $table->string('s_rollno')->nullable();
            $table->string('s_name')->nullable();
            $table->string('s_firstname')->nullable();
            $table->string('s_lastname')->nullable();
            $table->date('s_dob')->nullable();
            $table->string('s_gender')->nullable();
            $table->string('s_email')->nullable();
            $table->string('s_religion')->nullable();
            $table->string('s_aadharno')->nullable();
            $table->string('s_bloodgroup')->nullable();
            $table->string('s_permanentaddress')->nullable();
            $table->string('s_presentaddress')->nullable();
            $table->string('s_nationality')->nullable();
            $table->string('s_state')->nullable();
            $table->string('s_fathername')->nullable();
            $table->string('s_fatheroccupation')->nullable();
            $table->string('s_mothername')->nullable();
            $table->string('s_motheroccupation')->nullable();
            // $table->string('s_contact')->nullable();
            $table->string('s_phone')->nullable();
            $table->string('s_disabledperson')->nullable();
            $table->string('s_profile')->nullable();
            $table->string('image_path')->nullable();
            $table->string('s_feesid')->nullable();
            $table->string('s_classid')->nullable();
            $table->string('acdm_year')->nullable();
            $table->string('s_loginstatus')->default(0);
            $table->string('s_vanid')->nullable();
            $table->string('s_certificate')->nullable();
            $table->string('file_path')->nullable();
            $table->date('s_admissiondate')->nullable();
            $table->string('s_status')->default(1);
            $table->string('s_delete')->default(1);
            $table->integer('s_otpvalue')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
