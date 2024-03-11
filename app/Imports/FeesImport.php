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

class FeesImport implements ToCollection, WithHeadingRow
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

            foreach ($rows as $row) {
                $students = Student::select('id','s_classid')->where('s_name', $row['student_name'])->first();
                $fees_structure = fee_structure::select('id')->where('class_id', $students->s_classid)->first();
              
            $total = $row['annual_fees'] + $row['exam_fees'] + $row['transport_fees'] + $row['others_fees'];
     
// dd( $total);

                Fees::create([
                    'student_id' => $students->id,
                    'fees_structure_id' =>  $fees_structure->id,
                    'annual_fees' => $row['annual_fees'],
                    'exam_fees' => $row['exam_fees'],
                    'transport' => $row['transport_fees'],
                    'others' => $row['others_fees'],
                    'reason' => $row['reason_for_other_fees'],
                    'total' => $total,
                    'academic_year' => $row['academic_year'],
                   
                ]);

                $feesRecord = new StudentFeesRecord();
                $feesRecord->student_id = $students->id;
                $feesRecord->total_fees = $total;
                $feesRecord->academic_year = $row['academic_year'];
                $feesRecord->balance = $total;
                $feesRecord->total_fees_paid = 0.00;
                $feesRecord->save();
            }
        } catch (\Exception $e) {

            dd($e->getMessage());
            Log::error('Error importing data: ' . $e->getMessage());

            throw $e;
        }
    }
}
