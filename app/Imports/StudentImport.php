<?php

namespace App\Imports;

use App\Models\Fees;
use App\Models\Student;
use App\Models\fee_structure;
use App\Models\StudentFeesRecord;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements ToCollection, WithHeadingRow
{
    // public function rules(): array
    // {
    //     return [
    //         'student_id' => 'required|numeric',
    //         'fees_structure_id' => 'required|numeric',
    //         'annual_fees' => 'required|decimal',
    //         'exam_fees' => 'required|decimal',
    //         'transport' => 'required|decimal',
    //         'others' => 'required|decimal',
    //         'reason' => 'nullable|string',
    //         'total' => 'required|numeric',
    //         'academic_year' => 'nullable|string',

    //     ];
    // }

    public function collection(Collection $rows)
    {
        try {

            // dd($rows);
            // Assuming $rows is an array of data
            $dataToInsert = [];
    
            foreach ($rows as $row) {
                $dataToInsert[] = [
                    's_admissionno' => $row['admission_number'],
                    's_rollno' => $row['roll_number'],
                    's_firstname' => $row['first_name'],
                    's_lastname' => $row['last_name'],
                    's_name' => $row['full_name'],
                    's_dob' => $row['date_of_birth'],
                    's_gender' => $row['gender'],
                    's_email' => $row['email'],
                    's_religion' => $row['religion'],
                    's_aadharno' => $row['aadhar_number'],
                    's_bloodgroup' => $row['blood_group'],
                    's_permanentaddress' => $row['permanent_address'],
                    's_presentaddress' => $row['present_address'],
                    's_nationality' => $row['nationality'],
                    's_state' => $row['state'],
                    'acdm_year' => $row['academic_year'],
                    's_fathername' => $row['father_name'],
                    's_fatheroccupation' => $row['father_occupation'],
                    's_mothername' => $row['mother_name'],
                    's_motheroccupation' => $row['mother_occupation'],
                    's_phone' => $row['phone'],
                    's_disabledperson' => $row['disabled_person'],
                    's_classid' => $row['class_id'],
                    's_admissiondate' => $row['admission_date'],
                
                ];
            }
    
            // Use insert for bulk insertion
            Student::insert($dataToInsert);
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error('Error importing data: ' . $e->getMessage());
            throw $e;
        }
    }
}