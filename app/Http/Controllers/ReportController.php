<?php

namespace App\Http\Controllers;

use App\Models\Marks;
use App\Models\Routes;
use App\Models\Student;
use App\Models\ExamTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Oldstudentclass;
use App\Models\StudentsForRoute;
use App\Models\Class_section;
use Illuminate\Support\Facades\DB;
use App\Models\studentcompletereport;
use App\Models\studenttransferreport;

class ReportController extends Controller
{
    public function completedstudents()
    {
        return view('report.completestudents');
    }

    public function transferstudents()
    {
        return view('report.transferstudent');
    }


    public function completedstudentsfilter(Request $request)
    {
        // $Adyear = studentcompletereport::where((['cr_status' => 1]))->select('cr_year')->distinct()->get();
        $Adyear = Oldstudentclass::where((['oldstatus' => 1]))->select('oldyear')->distinct()->get();

        $filteryear = $request->year;

        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        if ($filteryear) {
            $students = DB::table('students')
                // ->join('studentcompletereports', 'students.id', '=', 'studentcompletereports.cr_student_id')
                // ->join('class_sections', 'class_sections.id', '=', 'studentcompletereports.cr_class_id')
                // ->select('students.*', 'class_sections.c_class as cname')
                ->where('students.s_classid', 'CT')
                ->where(['students.s_delete' => 1, 'students.acdm_year' => $filteryear])
                ->where('s_delete', 1)
                ->get();
        } else {
            $students = DB::table('students')
                // ->join('studentcompletereports', 'students.id', '=', 'studentcompletereports.cr_student_id')
                // ->join('class_sections', 'class_sections.id', '=', 'studentcompletereports.cr_class_id')
                // ->select('students.*', 'class_sections.c_class as cname')
                ->where('students.s_classid', 'CT' )
                ->where(['students.s_delete' => 1, 'students.acdm_year' =>  $fyear])
                ->where('s_delete', 1)
                ->get();
        }



        return view('report.completestudents', compact('Adyear', 'students'));
    }

    public function transferstudentsfilter(Request $request)
    {
        $Adyear = studenttransferreport::where((['tr_status' => 1]))->select('tr_year')->distinct()->get();

        $filteryear = $request->year;

        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        if ($filteryear) {
            $students = DB::table('students')
                ->join('studenttransferreports', 'students.id', '=', 'studenttransferreports.tr_student_id')
                ->join('class_sections', 'class_sections.id', '=', 'studenttransferreports.tr_class_id')
                // ->select('students.*', 'class_sections.c_class as cname')
                ->where('students.s_classid', 'TR')
                ->where(['students.s_delete' => 1, 'studenttransferreports.tr_year' => $filteryear])
                ->get();
        } else {
            $students = DB::table('students')
                ->join('studenttransferreports', 'students.id', '=', 'studenttransferreports.tr_student_id')
                ->join('class_sections', 'class_sections.id', '=', 'studenttransferreports.tr_class_id')
                // ->select('students.*', 'class_sections.c_class as cname')
                ->where('students.s_classid', 'TR')
                ->where(['students.s_delete' => 1, 'studenttransferreports.tr_year' => $fyear])
                ->get();
        }


        return view('report.transferstudent', compact('Adyear', 'students'));
    }
    public function getClassAttendance()
    {

        $currentDate = Carbon::today()->toDateString();

        $attendanceReport = DB::table('studentattendances')
            ->join('class_sections', 'class_sections.id', '=', 'studentattendances.stud_classid')
            ->select(
                'class_sections.c_class as stud_classid',
                'class_sections.id',
                DB::raw('COUNT(studentattendances.id) AS total_attendance'),
                DB::raw('SUM(CASE WHEN studentattendances.stud_attid = 1 THEN 1 ELSE 0 END) AS present_count'),
                DB::raw('SUM(CASE WHEN studentattendances.stud_attid = 2 THEN 1 ELSE 0 END) AS absent_count')
            )
            ->whereDate('studentattendances.stud_date', $currentDate)
            ->groupBy('class_sections.c_class','class_sections.id')
            ->orderBy('class_sections.id', 'ASC')
            ->get();

        foreach ($attendanceReport as $report) {
            $totalAttendance = $report->total_attendance;
            $presentCount = $report->present_count;
            $absentCount = $report->absent_count;

            // Calculate percentages
            $presentPercentage = ($totalAttendance > 0) ? (($presentCount / $totalAttendance) * 100) : 0;
            $absentPercentage = ($totalAttendance > 0) ? (($absentCount / $totalAttendance) * 100) : 0;

            // Assign percentages back to the report object
            $report->present_percentage = $presentPercentage;
            $report->absent_percentage = $absentPercentage;
        }
        // dd($attendanceReport);
        return view('report.classattendance', compact('attendanceReport', 'currentDate'));
    }

    public function getClassAttendanceReport(Request $request)
    {
        $currentDate = $request->search_date;

        $attendanceReport = DB::table('studentattendances')
            ->join('class_sections', 'class_sections.id', '=', 'studentattendances.stud_classid')
            ->select(
                'class_sections.c_class as stud_classid',
                'class_sections.id',
                DB::raw('COUNT(studentattendances.id) AS total_attendance'),
                DB::raw('SUM(CASE WHEN studentattendances.stud_attid = 1 THEN 1 ELSE 0 END) AS present_count'),
                DB::raw('SUM(CASE WHEN studentattendances.stud_attid = 2 THEN 1 ELSE 0 END) AS absent_count')
            )
            ->whereDate('studentattendances.stud_date', $currentDate)
            ->groupBy('class_sections.c_class','class_sections.id')
            ->orderBy('class_sections.id', 'ASC')
            ->get();
        foreach ($attendanceReport as $report) {
            $totalAttendance = $report->total_attendance;
            $presentCount = $report->present_count;
            $absentCount = $report->absent_count;

            // Calculate percentages
            $presentPercentage = ($totalAttendance > 0) ? (($presentCount / $totalAttendance) * 100) : 0;
            $absentPercentage = ($totalAttendance > 0) ? (($absentCount / $totalAttendance) * 100) : 0;

            // Assign percentages back to the report object
            $report->present_percentage = $presentPercentage;
            $report->absent_percentage = $absentPercentage;
        }
        // dd($attendanceReport);
        return view('report.classattendance', compact('attendanceReport', 'currentDate'));
    }


    public function getClasswiseCounts()
    {
        $classwiseCounts = DB::table('students')
            ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
              ->select(
                'class_sections.c_class',
                'class_sections.id',
                DB::raw('COUNT(*) as total_students'),
                DB::raw('SUM(CASE WHEN students.s_gender = "Male" THEN 1 ELSE 0 END) as male_count'),
                DB::raw('SUM(CASE WHEN students.s_gender = "Female" THEN 1 ELSE 0 END) as female_count')
            )
            ->groupBy('class_sections.c_class','class_sections.id')
            ->orderBy('class_sections.id', 'ASC')
            ->get();
        return view('report.classwisecount', compact('classwiseCounts'));
    }
    public function getstudentroute()
    {
        $routes = Routes::with(['subRouteLocations', 'students'])->get();
        $studentRouteReport = Null;
        return view('report.studentsinaroute', compact('routes', 'studentRouteReport'));
    }
    public function getstudentinaroute(Request $request)
    {

        $routeId = $request->route_id;
        $routes = Routes::with(['subRouteLocations', 'students'])->get();
        $studentRouteReport = StudentsForRoute::join('routes', 'routes.id', '=', 'students_for_route.route_id')
            ->select('students_for_route.roll_no', 'students_for_route.name', 'routes.routetitle as route_name')
            ->where('route_id', $routeId)
            ->get();

        return view('report.studentsinaroute', compact('studentRouteReport', 'routes'));
    }


    public function getVehiclesReport()
    {
        $vehiclesReport = DB::table('vehicles')
            ->select('busno', 'vehiclenumber', 'vehiclemodel', 'seatcount', 'fc')
            ->get();

        return view('report.vehiclereport', compact('vehiclesReport'));
    }

    // public function getstaff()
    // {



    // }

    public function getStaffreport(Request $request)
    {

     $staffposition = $request->input('staffposition');
     $inputMonth = $request->input('month');

     $currentMonth = $inputMonth ? $inputMonth : Carbon::now()->format('Y-m');
     
  if($staffposition){
    $staffposition = $request->input('staffposition');
 }else{
    $staffposition = 1;
 }
   
// dd($currentMonth);
$staffs = DB::table('staffattandances')
    ->join('staff', 'staff.id', '=', 'staffattandances.staff_id')
    ->join('staffpositions', 'staffpositions.sp_id', '=', 'staff.sf_position')
    ->select(
        'staff.id',
        'staff.sf_name',
        'staffpositions.sp_name',
        DB::raw('SUM(CASE WHEN staffattandances.att_id = "1" THEN 1 ELSE 0 END) as present_days'),
        DB::raw('SUM(CASE WHEN staffattandances.att_id = "2" THEN 1 ELSE 0 END) as absent_days'),
        DB::raw('(SUM(CASE WHEN staffattandances.att_id = "1" THEN 1 ELSE 0 END) / COUNT(staffattandances.att_id)) * 100 as attendance_percentage')
    )
    ->where(['staff.sf_position' => $staffposition, 'staffattandances.att_month' => $currentMonth])
    ->groupBy('staff.id', 'staff.sf_name', 'staffpositions.sp_name')
    ->get();

// dd($staffs);


        return view('report.staffreport', compact('staffs','currentMonth'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function getStaffAttendancereport(Request $request)
    {




        $staffposition = $request->input('staffposition');

        // $currentDate = $request->search_date;

        $currentDate = Carbon::now()->toDateString();


        $staffAttendance = DB::table('staffattandances')
            ->join('staff', 'staff.id', '=', 'staffattandances.staff_id')
            ->join('staffpositions', 'staffpositions.sp_id', '=', 'staff.position_id')
            ->select('staff.*', 'staffattandances.*', 'staffpositions.position_name')
            ->where(['staff.sf_position' => $staffposition, 'staffattandances.att_month' => $currentDate])
            ->get();
// dd( $staffAttendance);
        return view('report.staffattendance', compact('staffs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function getfeesReport(Request $request)
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




        $class_id = $request->class;

        // dd( $class_id);
        $feesReportByClass = DB::table('students')
        ->join('student_fees_records', 'students.id', '=', 'student_fees_records.student_id')
        ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
        ->select(
            'students.id as student_id',
            'students.s_name as student_name',
            'class_sections.c_class as class_grade',
            DB::raw('SUM(student_fees_records.total_fees) as total_fees'),
            DB::raw('SUM(student_fees_records.total_fees_paid) as total_fees_paid'),
            DB::raw('SUM(student_fees_records.balance) as total_balance')
        )
        ->where('class_sections.id',$class_id)
        ->where('student_fees_records.academic_year',$fyear)
        ->groupBy('students.id', 'students.s_name', 'class_sections.c_class')
        ->get();
    
        // dd($feesReportByClass);

        return view('report.feesreport', compact('feesReportByClass'));
    }

//     public function classMarksReport(Request $request)
//     {
//         // Retrieve the specific class

// $classId = 1;
// $examTypeId = 2;


//         $class = Class_section::find($classId);
    
//         // Retrieve all students for the given class
//         $students = Student::where('s_classid', $classId)->get();
    
//         // Retrieve the specific exam type
//         $examType = ExamTypes::find($examTypeId);
    
//         // Retrieve marks for the entire class and exam type
//         $marks = Marks::where([
//             'class_id' => $classId,
//             'examtype_id' => $examTypeId,
//         ])->get();
//     $marks_id = $marks->id;

//         dd($marks_id,$class,$students,$marks,$examType);
   
//         return view('student.class_marks_report', [
//             'class' => $class,
//             'students' => $students,
//             'marks' => $marks,
//             'examType' => $examType,
//         ]);
//     }



}
