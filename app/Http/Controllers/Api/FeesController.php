<?php

namespace App\Http\Controllers\Api;

use App\Models\Enews;
use App\Models\Student;
use App\Models\Enotices;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FeesController extends Controller
{
    public function StudentFeeBalance(Request $request)
    {
        $studentlogId = $request->input('s_admissionno');
        $getid = Student::where('s_admissionno', $studentlogId)->first();
        $a = $getid->id;
        $classId = $getid->s_classid;

    
        $data['StudentFeeBalance'] = DB::table('students')
            ->select(
                'students.s_name',
                'students.id',
                'class_sections.c_class',
                'student_fees_records.total_fees',
                'student_fees_records.academic_year',
                'student_fees_records.balance',
                DB::raw('SUM(student_fees_records.balance) as total_balance'),
                'student_fees_records.total_fees_paid'
            )
            ->leftJoin('student_fees_records', function ($join) {
                $join->on('students.id', '=', 'student_fees_records.student_id');
            })
            ->leftJoin('class_sections', 'class_sections.id', '=', 'students.s_classid')
            ->where('students.id', $a)
            ->where('class_sections.id', $classId)
            ->orderBy('student_fees_records.academic_year', 'DESC')
            ->groupBy(
                'students.s_name',
                'students.id',
                'class_sections.c_class',
                'student_fees_records.balance',
                'student_fees_records.total_fees',
                'student_fees_records.academic_year',
                'student_fees_records.total_fees_paid'
            )
            ->limit(2)
            ->get();
    
        // Iterate over the result to fetch separate fee collections for each student
        foreach ($data['StudentFeeBalance'] as &$record) {
            $feesCollections = DB::table('fees_collections')
                ->select(
                    'fees_collections.id',
                    'fees_collections.paid_date',
                    'fees_collections.amount'
                )
                ->where('fees_collections.student_id', $record->id)
                ->where('fees_collections.academic_date', $record->academic_year)
                ->orderBy('fees_collections.paid_date','DESC')
                ->limit(5)
                ->get();
    
            // Convert the feesCollections result to an array
            $record->fees_collections = $feesCollections->toArray();
        }
    
        // Now, $data contains the student information with a nested array of fees collections for each student
    
        return response()->json($data);
    }

    public function studenthome()
    {

        $todayDate = Carbon::now()->format('Y-m-d');

        $currentDate = Carbon::now();
        $yesterdayDate = $currentDate->subDay();
        $yesterdayDateFormatted = $yesterdayDate->format('Y-m-d');
        
        $enewview = Enews::where(['date' => $todayDate, 'status' => 1])->get();
        $enoticesview = Enotices::where(['date' => $todayDate, 'status' => 1])->get();
        
        $yesenewview = Enews::where(['date' => $yesterdayDateFormatted, 'status' => 1])->get();
        $yesenoticesview = Enotices::where(['date' => $yesterdayDateFormatted, 'status' => 1])->get();
        
        $enewcount = Enews::where(['date' => $todayDate, 'status' => 1])->count();
        $enoticescount = Enotices::where(['date' => $todayDate, 'status' => 1])->count();
        $studentId = 1; // Retrieve the student ID from the session
        
        if ($studentId) {
            $studentdetails = DB::table('students')
                ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
                ->where(['students.id' => $studentId, 'students.s_loginstatus' => 1])->first();
        
            return response()->json([
                'studentdetails' => $studentdetails,
                'enewview' => $enewview,
                'enoticesview' => $enoticesview,
                'yesenewview' => $yesenewview,
                'yesenoticesview' => $yesenoticesview,
                'enewcount' => $enewcount,
                'enoticescount' => $enoticescount,
            ]);
        } else {
            // Handle the case where student ID is not found in the session
            return response()->json(['status' => 'failed']);
        }
        
    }

}
