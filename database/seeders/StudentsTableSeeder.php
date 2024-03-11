<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = [
            [
                's_admissionno' => 'AD001',
                's_rollno' => 'R001',
                's_name' => 'John Doe',
                's_firstname' => 'John',
                's_lastname' => 'Doe',
                's_dob' => '2000-01-01',
                's_gender' => 'Male',
                's_email' => 'john.doe@example.com',
                's_religion' => 'Christian',
                's_aadharno' => '123456789012',
                's_bloodgroup' => 'O+',
                's_permanentaddress' => '123 Main St, City, Country',
                's_presentaddress' => '456 Main St, City, Country',
                's_nationality' => 'Indian',
                's_state' => 'State',
                's_fathername' => 'John Doe Sr.',
                's_fatheroccupation' => 'Engineer',
                's_mothername' => 'Jane Doe',
                's_motheroccupation' => 'Teacher',
                's_phone' => '9876543210',
                's_disabledperson' => 'No',
                's_profile' => 'profile_picture1.jpg',
                'image_path' => 'images/students/',
                's_feesid' => 'F001',
                's_classid' => 'C001',
                's_loginstatus' => 0,
                's_vanid' => 'V001',
                's_certificate' => 'certificate1.pdf',
                'file_path' => 'files/students/',
                's_admissiondate' => '2022-01-15',
                's_status' => 1,
                's_delete' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more student records as needed
            // Repeat the structure for each student
        ];

        DB::table('students')->insert($students);
    }
}
