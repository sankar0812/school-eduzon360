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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id')->nullable();
            $table->string('sf_firstname')->nullable();
            $table->string('sf_lastname')->nullable();
            $table->string('sf_name')->nullable();
            $table->date('sf_dob')->nullable();
            $table->string('sf_gender')->nullable();
            $table->string('sf_email')->nullable();
            $table->string('sf_religion')->nullable();
            $table->string('sf_aadharno')->nullable();
            $table->string('sf_bloodgroup')->nullable();
            $table->string('sf_nationality')->nullable();
            $table->string('sf_state')->nullable();
            $table->string('sf_permanentaddress')->nullable();
            $table->string('sf_presentaddress')->nullable();
            $table->string('sf_fathername')->nullable();
            $table->string('sf_fatheroccupation')->nullable();
            $table->string('sf_mothername')->nullable();
            $table->string('sf_motheroccupation')->nullable();
            // $table->string('s_contact')->nullable();
            $table->string('sf_phone')->nullable();
            $table->string('sf_qualification')->nullable();
            $table->string('sf_experience')->nullable();
            $table->string('sf_language')->nullable();
            $table->string('sf_position')->nullable();
            $table->string('sf_subject_taken')->nullable();
            $table->string('sf_disabledperson')->nullable();
            $table->string('sf_profile')->nullable();
            $table->string('sf_image_path')->nullable();
            $table->string('sf_classid')->nullable();
            $table->string('sf_designation')->nullable();
            $table->string('sf_account_details')->nullable();
            $table->string('sf_certificate')->nullable();
            $table->string('sf_file_path')->nullable();
            $table->string('login_id')->nullable();
            $table->date('sf_joindate')->nullable();
            $table->string('sf_status')->default(1);
            $table->string('sf_delete')->default(1);
            $table->string('salary_status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
