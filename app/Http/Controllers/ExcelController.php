<?php

namespace App\Http\Controllers;

use App\Exports\FeesExport;
use App\Imports\FeesImport;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Exports\StudentsExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function export(Request $request)
    {

        $month = date('m');
           
        $currentDate = now();
        $nextYe = $currentDate->format('Y');
        $nextYear = $currentDate->addYear()->format('y');
    
        if ($month >= "06") {
            $fyear = $nextYe . '-' . $nextYear;
        } else {
            $fyear = ($nextYe - 1)  . '-' . ($nextYear - 1);
        }
    // dd($fyear);
        $feeStructures = DB::table('fee_structures')
            ->join('class_sections', 'class_sections.id', '=', 'fee_structures.class_id')
            ->join('students', 'students.s_classid', '=', 'fee_structures.class_id')
            ->select(
                'fee_structures.academic_year',
                'class_sections.c_class',
                'students.s_name',
                'fee_structures.annual_fee',
                'fee_structures.exam_fees',

            )
            ->where('fee_structures.class_id', $request->class_id)
            ->where('fee_structures.academic_year', $fyear)
            ->where('fee_structures.status', '1')
            ->orderBy('students.s_name', 'ASC')
            ->get();
    //     dd($request->class_id,$feeStructures,$fyear
    // );
        // die();
        $data = [
            'fee_structures' => $feeStructures,
        ];

        $firstFeeStructure = $data['fee_structures']->first();

        if ($firstFeeStructure) {
         
            $class = $firstFeeStructure->c_class;
            $year =  $firstFeeStructure->academic_year;

            $classyear = $class . '(' . $year .')';
            // dd($classyear);
            

            return Excel::download(new FeesExport($data['fee_structures']), $classyear . '.xlsx');
        }else{
            echo "There is no Data";
        }
    }




    public function import(Request $request)
    {

        // dd( $request->file);

        try {
            $request->validate([
                'file' => 'required|mimes:xlsx',
            ]);
    
            Excel::import(new FeesImport, $request->file('file'));
    
            return redirect()->back()->with('success', 'Data imported successfully.');
        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a user-friendly message
            return redirect()->back()->with('error', 'Error importing data. Please check your file and try again.');
        }
    }
    

    public function studentexport(Request $request)
    {
        $headings = [
            'Admission Number',
            'Roll Number',
            'First Name',
            'Last Name',
            'Full Name',
            'Date of Birth',
            'Gender',
            'Email',
            'Religion',
            'Aadhar Number',
            'Blood Group',
            'Permanent Address',
            'Present Address',
            'Nationality',
            'State',
            'Academic Year',
            'Father Name',
            'Father Occupation',
            'Mother Name',
            'Mother Occupation',
            'Phone',
            'Disabled Person',
            'Class ID',
            'Admission Date',
        ];
    
     
            return Excel::download(new StudentsExport($headings),'students.xlsx');

    }



    public function studentimport(Request $request)
    {

        // dd( $request->file);

        try {
            $request->validate([
                'file' => 'required|mimes:xlsx',
            ]);
    
            Excel::import(new StudentImport, $request->file('file'));
    
            return redirect()->back()->with('success', 'Student Data imported successfully.');
        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a user-friendly message
            return redirect()->back()->with('error', 'Error importing data. Please check your file and try again.');
        }
    }




    }

