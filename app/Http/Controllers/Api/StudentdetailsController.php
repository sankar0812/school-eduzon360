<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Enews;
use App\Models\Staff;
use App\Models\Routes;
use App\Models\Student;
use App\Models\Enotices;
use App\Models\Examtime;
use App\Models\messages;
use App\Models\ExamTypes;
use Illuminate\Http\Request;
use App\Models\Examtimetable;


use App\Models\Assignvehicles;
use Illuminate\Support\Carbon;
use App\Models\StudentsForRoute;
use App\Models\Studentattendance;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Cache\RateLimiting\Limit;
use App\Http\Resources\ExamScheduleResource;
use App\Http\Resources\SubExamTimetableResource;

class StudentdetailsController extends Controller
{
    //
    public function studenthome(Request $request)
    {
        try {
            $todayDate = Carbon::now()->format('Y-m-d');
            $currentDate = Carbon::now();
            $twoDaysAgo = $currentDate->copy()->subDay(3);
            $yesterdayDate = $currentDate->copy()->subDay(1);

            $twoDaysAgoFormatted = $twoDaysAgo->format('Y-m-d');
            $yesterdayDateFormatted = $yesterdayDate->format('Y-m-d');

            $enewview = Enews::where(['date' => $todayDate, 'status' => 1])->select('title', 'content', 'date', 'time')->get();
            $enoticesview = Enotices::where(['date' => $todayDate, 'status' => 1])->select('title', 'content', 'date', 'time')->get();

            $yesenewview = Enews::whereBetween('date', [$twoDaysAgoFormatted, $yesterdayDateFormatted])
                ->where('status', 1)
                ->select('title', 'content', 'date', 'time')
                ->get();
            $yesenoticesview = Enotices::whereBetween('date', [$twoDaysAgoFormatted, $yesterdayDateFormatted])
                ->where('status', 1)
                ->select('title', 'content', 'date', 'time')
                ->get();

            $enewcount = Enews::where(['date' => $todayDate, 'status' => 1])->count();
            $enoticescount = Enotices::where(['date' => $todayDate, 'status' => 1])->count();

            $studentId = $request->input('s_admissionno');

            if ($studentId) {
                $studentdetails = DB::table('students')
                    ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
                    ->where(['students.s_admissionno' => $studentId, 'students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->first();
            }
            // Assuming you have an API response structure, you can customize this accordingly
            return response()->json([

                'studentdetails' => $studentdetails,
                'today_enewview' => $enewview,
                'today_enoticesview' => $enoticesview,
                'yesterday_enewview' => $yesenewview,
                'yesterday_enoticesview' => $yesenoticesview,
                'enewcount' => $enewcount,
                'enoticescount' => $enoticescount,

                'success' => true,
                'message' => 'Welcome to homepage',
            ], 200);
        } catch (\Exception $e) {
            // Handle the case where student ID is not found in the request
            return response()->json([
                'success' => false,
                'message' => 'You are not logged in.',
            ], 401); // You can choose an appropriate HTTP status code
        }
    }

    public function attendancemonth()
    {

        try {
            $month = date('m');
            $year = date('Y');
            $shortYear = date('y');

            if ($month >= "06") {
                $fyear = $year . '-' . ($shortYear + 1);
            } else {
                $fyear = ($year - 1) . '-' . $shortYear;
            }

            $monthview = Studentattendance::where('stud_year', $fyear)->select('stud_month')->orderby('id', 'Asc')->first();
            return response()->json($monthview);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log the error, return an error response, etc.)
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }


    public function myattendancefilter(Request $request)
    {
        try {
            $monthid = $request->input('monthid');
            $studentAd = $request->input('s_admissionno');

            $student = DB::table('students')->select('students.id', 'class_sections.c_class')
                ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
                ->where(['students.s_admissionno' => $studentAd, 'students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->first();
            $studentId =  $student->id;
            $class = $student->c_class;

            $month = date('m');
            $year = date('Y');
            $shortYear = date('y');

            if ($month >= "06") {
                $fyear = $year . '-' . ($shortYear + 1);
            } else {
                $fyear = ($year - 1) . '-' . $shortYear;
            }
            $MONTH = now()->format('Y-m');

            // $monthview = Studentattendance::where('stud_year', $fyear)->select('stud_month')->distinct()->first();
            // $month = $monthview->stud_month;


            $attendanceRecords = null;
            $pr = 0;
            $Ab = 0;

            if ($monthid) {
                $attendanceRecords = Studentattendance::where(['stud_id' => $studentId, 'stud_month' => $monthid])->orderBy('stud_date', 'DESC')->get();
                $pr = Studentattendance::where(['stud_id' => $studentId, 'stud_month' => $monthid, 'stud_attid' => 1])->count();
                $Ab = Studentattendance::where(['stud_id' => $studentId, 'stud_month' => $monthid, 'stud_attid' => 2])->count();
                $total_days = $pr + $Ab; $pr = Studentattendance::where(['stud_id' => $studentId, 'stud_month' => $monthid, 'stud_attid' => 1])->count();
                $Ab = Studentattendance::where(['stud_id' => $studentId, 'stud_month' => $monthid, 'stud_attid' => 2])->count();
                $total_days = $pr + $Ab;
                $monthid = $monthid;
            } else {
                $attendanceRecords = Studentattendance::where(['stud_id' => $studentId, 'stud_month' => $MONTH])->orderBy('stud_date', 'DESC')->get();
                $pr = Studentattendance::where(['stud_id' => $studentId, 'stud_month' => $MONTH, 'stud_attid' => 1])->count();
                $Ab = Studentattendance::where(['stud_id' => $studentId, 'stud_month' => $MONTH, 'stud_attid' => 2])->count();
                $total_days = $pr + $Ab;
                $monthid = $MONTH;
            }

            return response()->json([
                // 'a'=>$studentId,
                'fyear' => $fyear,
                'monthview' => $monthid,
                'class' => $class,
                'attendanceRecords' => $attendanceRecords,
                'Totaldays' => $total_days,
                'present' => $pr,
                'Absent' => $Ab,
                'success' => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    public function classtimetable(Request $request)
    {

        try {
            $studentId = $request->input('s_admissionno');
            $getid = Student::where(['s_admissionno' => $studentId, 'students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->first();
    
            $month = date('m');
            $year = date('Y');
            $shortYear = date('y');
    
            // Determine the academic year
            if ($month >= "06") {
                $fyear = $year . '-' . ($shortYear + 1);
            } else {
                $fyear = ($year - 1) . '-' . $shortYear;
            }
    
            $classtime = DB::table('dailyclasstimes')
                ->select('classname')
                ->get();
    
            $classname = DB::table('class_sections')
                ->select('c_class')
                ->where('class_sections.id', $getid->s_classid)
                ->first();
            $class = $classname->c_class;
    
            $timetableView = DB::table('classtimetables')
                ->join('class_sections', 'class_sections.id', '=', 'classtimetables.class_id')
                ->select('class_sections.id as section_id', 'class_sections.c_class', 'classtimetables.id as timetable_id', 'classtimetables.class_id')
                ->where('classtimetables.class_id', $getid->s_classid)
                ->get();
    
            $response = [
                'classname' => $class,
                'day' => [],
                'fyear' => $fyear,
                'classtime' => $classtime,
                'success' => true,
            ];
    
            if (!empty($timetableView)) {
                foreach ($timetableView as $key => $requested) {
                    $result = DB::table('subclasstimetables')
                        ->join('days', 'days.id', '=', 'subclasstimetables.day_id')
                        ->where('tt_id', $requested->timetable_id)
                        ->select(
                            'days.id as day_id',
                            'days.day_name',
                            'subclasstimetables.pre1',
                            'subclasstimetables.pre2',
                            'subclasstimetables.pre3',
                            'subclasstimetables.pre4',
                            'subclasstimetables.pre5',
                            'subclasstimetables.pre6',
                            'subclasstimetables.pre7',
                            'subclasstimetables.pre8'
                        )
                        ->get();
    
                    // Grouping by day
                    $groupedResult = $result->groupBy('day_id');
    
                    // Setting the grouped result as a sub-array
                    $response['day'] = [];
    
                    foreach ($groupedResult as $dayId => $periods) {
                        $day = [
                            'id' => $dayId,
                            'day' => $periods[0]->day_name,
                            'periods' => [],
                        ];
    
                        foreach ($periods as $period) {
                            $day['periods'] = (object)[
                                'pre1' => $period->pre1,
                                'pre2' => $period->pre2,
                                'pre3' => $period->pre3,
                                'pre4' => $period->pre4,
                                'pre5' => $period->pre5,
                                'pre6' => $period->pre6,
                                'pre7' => $period->pre7,
                                'pre8' => $period->pre8,
                            ];
                        }
    
                        $response['day'][] = $day;
                    }
                }
            }
    
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    public function  fullexamtype(Request $request)
    {
        try {

            $examtype = ExamTypes::select('id', 'name')->get();

            return response()->json(['examtype' => $examtype,]);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log the error, return an error response, etc.)
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }

    public function exammarkfilter(Request $request)
    {

        try {
            $month = date('m');
            $year = date('Y');
            $shortYear = date('y');

            if ($month >= "06") {
                $fyear = $year . '-' . ($shortYear + 1);
            } else {
                $fyear = ($year - 1) . '-' . $shortYear;
            }

            $studentlogId = $request->input('s_admissionno');
            $examid = $request->input('examid');
            $monthid = $request->input('monthid');
            $examdate = $request->input('examdate');

            $getid = Student::where('s_admissionno', $studentlogId)->where(['students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->first();
            $classid = $getid->s_classid;
            $studentId = $getid->id;

            $markshow = [];

            if ($examid == '1') {
                $markshow = DB::table('studentdailyexams')
                    ->join('class_sections', 'class_sections.id', '=', 'studentdailyexams.class_id')
                    // ->join('subjects', 'subjects.id', '=', 'marks.subject_id')
                    ->join('exam_types', 'exam_types.id', '=', 'studentdailyexams.examtype_id')
                    // ->select('marks.id as markid', 'marks.exam_year', 'marks.exam_date', 'class_sections.c_class', 'exam_types.name as exaname')

                    ->select('studentdailyexams.examtype_id', 'exam_types.name', 'class_sections.c_class', 'studentdailyexams.exam_year', 'studentdailyexams.exam_month')
                    ->where(['studentdailyexams.class_id' => $classid, 'studentdailyexams.examtype_id' => $examid, 'studentdailyexams.exam_month' => $monthid,])
                    ->distinct() // Adjust the class ID as needed
                    ->get();

                foreach ($markshow as $key => $requested) {
                    $result = DB::table('substudentdailyexams')
                        ->join('subjects', 'subjects.id', '=', 'substudentdailyexams.subject_id')
                        // ->join('students', 'students.id', '=', 'submarkentries.student_id')
                        ->select('subjects.name', 'substudentdailyexams.internal', 'substudentdailyexams.exammonth_id',  'substudentdailyexams.examdate', 'substudentdailyexams.external', 'substudentdailyexams.mark')
                        ->where(['student_id' => $studentId, 'substudentdailyexams.exammonth_id' => $monthid])
                        ->get();
                    // $markshow[$key]->tableview = [];
                    $markshow[$key]->tableview = $result;
                }
            } else {
                $markshow = DB::table('marks')
                    ->join('class_sections', 'class_sections.id', '=', 'marks.class_id')
                    // ->join('subjects', 'subjects.id', '=', 'marks.subject_id')
                    ->join('exam_types', 'exam_types.id', '=', 'marks.examtype_id')
                    // ->select('marks.id as markid', 'marks.exam_year', 'marks.exam_date', 'class_sections.c_class', 'exam_types.name as exaname')

                    ->select('exam_types.name', 'class_sections.c_class', 'marks.exam_year', 'marks.exam_date', 'marks.exam_month')
                    ->where(['marks.class_id' => $classid, 'marks.examtype_id' => $examid, 'marks.exam_month' => $monthid])
                    ->distinct() // Adjust the class ID as needed
                    ->get();

                foreach ($markshow as $key => $requested) {
                    $result = DB::table('submarkentries')
                        ->join('subjects', 'subjects.id', '=', 'submarkentries.subject_id')
                        // ->join('students', 'students.id', '=', 'submarkentries.student_id')
                        ->select('subjects.name', 'submarkentries.internal', 'submarkentries.external', 'submarkentries.mark')
                        ->where(['student_id' => $studentId, 'exammonth_id' => $monthid])
                        ->get();
                    // $markshow[$key]->tableview = [];
                    $markshow[$key]->tableview = $result;
                }
            }



            return response()->json([
                'fyear' => $fyear,
                'exam'   =>   $examid,
                'month'   =>  $monthid,
                'date'  => $examdate,

                'markshow' => $markshow,
                'success' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 401);
        }
    }





    public function staff(Request $request)
    {
        try {
            $studentloginId = $request->s_admissionno;
            $getid = Student::where('s_admissionno', $studentloginId)->where(['students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->first();
            $clid = $getid->s_classid;

            $assignstaff = DB::table('assignstaffs')
                ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')
                ->join('subassignstaffs', 'subassignstaffs.as_id', '=', 'assignstaffs.id')
                ->join('staff', 'staff.id', '=', 'subassignstaffs.as_staff_id')
                ->select('staff.*')
                ->where('class_sections.id', $clid)
                ->get();

            return response()->json([
                'assignstaff' => $assignstaff,
                'success' => true
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function dailytopic(Request $request)
    {
        try {
            $studentloginId = $request->s_admissionno;
            $olddate = $request->input('olddate');

            $month = date('m');
            $year = date('Y');
            $shortYear = date('y');

            if ($month >= "06") {
                $fyear = $year . '-' . ($shortYear + 1);
            } else {
                $fyear = ($year - 1) . '-' . $shortYear;
            }

            $todayDate = Carbon::now()->format('Y-m-d');


            $getid = Student::where('s_admissionno', $studentloginId)->where(['students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->first();
            $clid = $getid->s_classid;


            if ($olddate) {
                $contentview = DB::table('staffdailycontents')
                    ->join('subjects', 'subjects.id', '=', 'staffdailycontents.subjectid')
                    ->join('class_sections', 'class_sections.id', '=', 'staffdailycontents.classid')
                    ->select('subjects.name', 'staffdailycontents.date', 'staffdailycontents.classid', 'staffdailycontents.title', 'staffdailycontents.content_path', 'staffdailycontents.id', 'class_sections.c_class')
                    ->where([
                        'date' => $olddate,
                        'classid' => $clid,
                        'acd_year' => $fyear,
                    ])
                    ->get();
            } else {
                $contentview = DB::table('staffdailycontents')
                    ->join('subjects', 'subjects.id', '=', 'staffdailycontents.subjectid')
                    ->join('class_sections', 'class_sections.id', '=', 'staffdailycontents.classid')
                    ->select('subjects.name', 'staffdailycontents.date', 'staffdailycontents.classid', 'staffdailycontents.title', 'staffdailycontents.content_path', 'staffdailycontents.id', 'class_sections.c_class')
                    ->where([
                        'date' => $todayDate,
                        'classid' => $clid,
                        'acd_year' => $fyear,
                    ])
                    ->get();
            }

            return response()->json([
                'contentview' => $contentview,
                'fyear' => $fyear,
                'success' => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function homework(Request $request)
    {
        try {
            $studentloginId = $request->s_admissionno;
            $olddate = $request->input('olddate');

            $month = date('m');
            $year = date('Y');
            $shortYear = date('y');

            if ($month >= "06") {
                $fyear = $year . '-' . ($shortYear + 1);
            } else {
                $fyear = ($year - 1) . '-' . $shortYear;
            }

            $todayDate = Carbon::now()->format('Y-m-d');
            $getid = Student::where('s_admissionno', $studentloginId)->where(['students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->first();
            $clid = $getid->s_classid;

            if ($olddate) {
                $homework = DB::table('homework')
                    ->join('subjects', 'subjects.id', '=', 'homework.hw_subjectid')
                    ->join('class_sections', 'class_sections.id', '=', 'homework.hw_classid')
                    ->select('homework.hw_title', 'homework.hw_content', 'homework.hw_date', 'subjects.name', 'homework.id', 'homework.hw_content_path', 'class_sections.c_class')
                    ->where([
                        'hw_date' => $olddate,
                        'hw_classid' => $clid,
                        'acd_year' => $fyear,
                    ])
                    ->get();
                $date =  $olddate;
            } else {
                $homework = DB::table('homework')
                    ->join('subjects', 'subjects.id', '=', 'homework.hw_subjectid')
                    ->join('class_sections', 'class_sections.id', '=', 'homework.hw_classid')
                    ->select('homework.hw_title', 'homework.hw_content', 'homework.hw_date', 'subjects.name', 'homework.id', 'homework.hw_content_path', 'class_sections.c_class')
                    ->where([
                        'hw_date' => $todayDate,
                        'hw_classid' => $clid,
                        'acd_year' => $fyear,
                    ])
                    ->get();
            }


            return response()->json(['homework' => $homework]);
        } catch (\Exception $e) {

            return response()->json(['error' => 'An error occurred while processing the request.']);
        }
    }


    public function feesDetails(Request $request)
    {
try {
    $studentloginId = $request->s_admissionno;
    $month = date('m');

    $currentDate = now();
    $nextYear = $currentDate->format('Y');
    $nextShortYear = $currentDate->addYear()->format('y');

    if ($month >= "06") {
        $fyear = $nextYear . '-' . $nextShortYear;
    } else {
        $fyear = ($nextYear - 1)  . '-' . ($nextShortYear - 1);
    }

    $getid = Student::where('s_admissionno', $studentloginId)
        ->where(['students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])
        ->first();

    if (!$getid) {
        return response()->json(['error' => 'Student not found.'], 404);
    }

    $feesRecords = DB::table('student_fees_records')
        ->select(
            'students.s_name',
            'students.id as s_id',
            'class_sections.c_class',
            'student_fees_records.total_fees',
            'student_fees_records.academic_year',
            'student_fees_records.balance',
            'student_fees_records.total_fees_paid',
            'student_fees_records.student_id'
        )
        ->join('students', 'students.id', '=', 'student_fees_records.student_id')
        ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
        ->where('students.s_admissionno', $studentloginId)
        ->where('student_fees_records.academic_year', $fyear)
          ->where('student_fees_records.balance','!=' ,'0')
        ->groupBy(
            'students.s_name',
            'students.id',
            'class_sections.c_class',
            'student_fees_records.total_fees',
            'student_fees_records.academic_year',
            'student_fees_records.balance',
            'student_fees_records.total_fees_paid',
            'student_fees_records.student_id'
        )
        ->first();
       

    $previousYearRecords = DB::table('student_fees_records')
        ->select(
            'students.s_name',
            'students.id',
            'student_fees_records.total_fees',
            'student_fees_records.academic_year',
            'student_fees_records.balance',
            'student_fees_records.student_id'
        )
        ->join('students', 'students.id', '=', 'student_fees_records.student_id')
        ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
        ->where('students.id', $getid->id)
        ->where('student_fees_records.academic_year', '<>', $fyear) // Exclude current year
        ->groupBy(
            'students.s_name',
            'students.id',
            'student_fees_records.total_fees',
            'student_fees_records.academic_year',
            'student_fees_records.balance',
            'student_fees_records.student_id'
        )
        ->first();
        

    if (empty($feesRecords)) {
        return response()->json(['error' => 'No records found for the current year.'], 404);
    }

    return response()->json(['feesRecords' =>$feesRecords, 'previousYearRecords' => $previousYearRecords]);
} catch (Exception $e) {
    return response()->json(['error' => 'Internal Server Error'], 500);
}

        
    }


    public function examyeartype(Request $request)
    {
        try {
            $studentloginId = $request->s_admissionno;

            $month = date('m');
            $year = date('Y');
            $shortYear = date('y');

            if ($month >= "06") {
                $fyear = $year . '-' . ($shortYear + 1);
            } else {
                $fyear = ($year - 1) . '-' . $shortYear;
            }
            $getid = Student::where('s_admissionno', $studentloginId)->where(['students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->first();

            $examtype = ExamTypes::where('id', '<>', 1)->select('id', 'name')->get();

            $exammonth = Examtimetable::where(['year' => $fyear, 'class_id' => $getid->s_classid])->distinct()->pluck('months_id')->toArray();

            $examtime = Examtime::select('id', 'et_name', 'time')->get();
            return response()->json(['examtype' => $examtype, 'exammonth' => $exammonth, 'examtime' => $examtime]);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log the error, return an error response, etc.)
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }


    public function examschedulefilter(Request $request)
    {
        try {

            $studentloginId = $request->s_admissionno;
            $examtypeid = $request->examid;
            $exammonth = $request->exammonth;


            $month = date('m');
            $year = date('Y');
            $shortYear = date('y');

            if ($month >= "06") {
                $fyear = $year . '-' . ($shortYear + 1);
            } else {
                $fyear = ($year - 1) . '-' . $shortYear;
            }


            $getid = Student::where('s_admissionno', $studentloginId)->where(['students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->first();

            if ($examtypeid &&  $exammonth) {
                $examview = DB::table('examtimetables')
                    ->join('class_sections', 'class_sections.id', '=', 'examtimetables.class_id')
                    ->join('exam_types', 'exam_types.id', '=', 'examtimetables.examtype_id')
                    ->select('class_sections.id', 'class_sections.c_class', 'exam_types.name', 'examtimetables.months_id', 'examtimetables.year', 'examtimetables.examtype_id', 'examtimetables.id as timetable_id')
                    ->where([
                        'examtimetables.year' => $fyear,
                        'examtimetables.months_id' => $exammonth,
                        'examtimetables.examtype_id' => $examtypeid,
                        'class_sections.id' => $getid->s_classid,
                    ])
                    // ->orderBy('timetable_id', 'desc')
                    ->get();

                if (!$examview->isEmpty()) {
                    foreach ($examview as $key => $requested) {
                        $result = DB::table('subexamtimetables')
                            ->where('exam_id', $requested->timetable_id)
                            ->select(
                                'ett_date',
                                'ett_day',
                                'ett_time',
                                'ett_code',
                                'ett_subject'
                            )
                            ->get();

                        $examview[$key]->tableview = $result;
                    }
                }
            } else {
                
                 $currentmonth = date('Y-m');
                $examview = DB::table('examtimetables')
                    ->join('class_sections', 'class_sections.id', '=', 'examtimetables.class_id')
                    ->join('exam_types', 'exam_types.id', '=', 'examtimetables.examtype_id')
                    ->select('class_sections.id', 'class_sections.c_class', 'exam_types.name', 'examtimetables.months_id', 'examtimetables.year', 'examtimetables.examtype_id', 'examtimetables.id as timetable_id')
                    ->where([
                        'examtimetables.year' => $fyear,
                          'examtimetables.months_id' => $currentmonth,
                        'class_sections.id' => $getid->s_classid,
                    ])
                    ->orderBy('timetable_id', 'desc')  // Order by the primary key (assuming it's 'id')
                    ->limit(1)
                    ->get();

                if (!$examview->isEmpty()) {
                    foreach ($examview as $key => $requested) {
                        $result = DB::table('subexamtimetables')
                            ->where('exam_id', $requested->timetable_id)
                            ->select(
                                'exam_id',
                                'ett_date',
                                'ett_day',
                                'ett_time',
                                'ett_code',
                                'ett_subject'
                            )
                            ->get();

                        $examview[$key]->tableview = $result;
                    }
                }
            }
            return response()->json([
                'examview' => $examview,
                'success' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 401);
        }
    }


    // public function examschedulefilters(Request $request)
    // {
    //     try {

    //         $studentloginId = $request->s_admissionno;

    //         $month = date('m');
    //         $year = date('Y');
    //         $shortYear = date('y');

    //         if ($month >= "06") {
    //             $fyear = $year . '-' . ($shortYear + 1);
    //         } else {
    //             $fyear = ($year - 1) . '-' . $shortYear;
    //         }

    //         $academicyear = Examtimetable::distinct()->pluck('year')->toArray();
    //         $examtime = Examtime::all();


    //         $getid = Student::where('s_admissionno', $studentloginId)->first();
    //         $clid = $getid->s_classid;

    //         $classname = DB::table('class_sections')
    //             ->select('c_class')
    //             ->where('class_sections.id', $getid->s_classid)
    //             ->first();
    //         $class = $classname->c_class;

    //         $examtype = ExamTypes::all();

    //         $examtypeid = $request->examid;
    //         $academicid = $request->academicid;

    //         if ($examtypeid && $academicid) {
    //             $examview = DB::table('examtimetables')
    //                 ->join('class_sections', 'class_sections.id', '=', 'examtimetables.class_id')
    //                 ->join('exam_types', 'exam_types.id', '=', 'examtimetables.examtype_id')
    //                 ->join('months', 'months.id', '=', 'examtimetables.months_id')
    //                 ->select('class_sections.id', 'class_sections.c_class', 'exam_types.name', 'months.monthName', 'examtimetables.year', 'examtimetables.id as timetable_id')
    //                 ->where([
    //                     'examtype_id' => $examtypeid,
    //                     'examtimetables.year' => $academicid,
    //                     'class_sections.id' => $getid->s_classid,
    //                 ])
    //                 ->orderBy('timetable_id', 'desc')
    //                 ->get();

    //             if (!empty($examview)) {
    //                 foreach ($examview as $key => $requested) {
    //                     $result = DB::table('subexamtimetables')
    //                         ->where('exam_id', $requested->timetable_id)
    //                         ->select(
    //                             'ett_date',
    //                             'ett_day',
    //                             'ett_time',
    //                             'ett_code',
    //                             'ett_subject'
    //                         )
    //                         ->get();

    //                     $examview[$key]->tableview = $result;
    //                 }
    //             }
    //         } else {
    //             $examview = DB::table('examtimetables')
    //                 ->join('class_sections', 'class_sections.id', '=', 'examtimetables.class_id')
    //                 ->join('exam_types', 'exam_types.id', '=', 'examtimetables.examtype_id')
    //                 ->join('months', 'months.id', '=', 'examtimetables.months_id')
    //                 ->select('class_sections.c_class', 'exam_types.name', 'months.monthName', 'examtimetables.year', 'examtimetables.id as timetable_id')
    //                 ->where([
    //                     'examtimetables.year' => $fyear,
    //                     'class_sections.id' => $getid->s_classid,
    //                 ])
    //                 ->orderBy('timetable_id', 'desc')
    //                 ->orderBy('examtimetables.id', 'desc')
    //                 // ->limit(2)
    //                 ->get();

    //             if (!empty($examview)) {
    //                 foreach ($examview as $key => $requested) {
    //                     $result = DB::table('subexamtimetables')
    //                         ->where('exam_id', $requested->timetable_id)
    //                         ->select(
    //                             'exam_id',
    //                             'ett_date',
    //                             'ett_day',
    //                             'ett_time',
    //                             'ett_code',
    //                             'ett_subject'
    //                         )
    //                         ->get();

    //                     $examview[$key]->tableview = $result;
    //                 }
    //             }
    //         }

    //         return response()->json([
    //             'class' => $class,
    //             'examtype' => $examtype,
    //             'fyear' => $fyear,
    //             'examview' => $examview,
    //             'examtime' => $examtime,
    //             'academicyear' => $academicyear,
    //             'success' => true,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //         ], 401);
    //     }
    // }


    // public function message(Request $request)
    // {

    //     $month = date('m');

    //     $currentDate = now();
    //     $nextYe = $currentDate->format('Y');
    //     $nextYear = $currentDate->addYear()->format('y');

    //     if ($month >= "06") {
    //         $fyear = $nextYe . '-' . $nextYear;
    //     } else {
    //         $fyear = ($nextYe - 1)  . '-' . ($nextYear - 1);
    //     }

    //     $studentlogId = $request->input('s_admissionno');
    //     $getid = Student::where('s_admissionno', $studentlogId)->where(['students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->first();
    //     $studentId = $getid->id;


    //     $senderMessagesStudent = DB::table('messages')
    //         ->join('students', 'students.id', '=', 'messages.sender_student')
    //         ->join('staff', 'staff.login_id', '=', 'messages.receiver_staff')
    //         ->where('messages.sender_student', $studentId)
    //         // ->where('messages.receiver_staff','=', 'staff.login_id')
    //         ->select('messages.*', 'staff.sf_name as name')
    //         ->orderBy('messages.id', 'DESC')
    //         ->get();

    //     $inboxMessagesStaff = DB::table('messages')
    //         ->join('staff', 'staff.login_id', '=', 'messages.sender_staff')
    //         ->where('messages.receiver_student', $studentId)
    //         ->select('messages.*', 'staff.sf_name as name')
    //         ->orderBy('messages.id', 'DESC')
    //         ->get();

    //     $inboxBulkMessages = DB::table('bulkclassmessages')
    //         ->join('class_sections', 'class_sections.id', '=', 'bulkclassmessages.bcm_classid')
    //         ->join('students', 'students.s_classid', '=', 'class_sections.id')
    //         ->join('roles', 'roles.id', '=', 'bulkclassmessages.bcm_senderid')
    //         ->select('bulkclassmessages.bcm_subject as subject', 'bulkclassmessages.datetime', 'roles.r_name as name')
    //         ->where('bulkclassmessages.bcm_year', $fyear)
    //         ->where('students.id', $studentId)
    //         ->get();
    //     // dd($inboxBulkMessages);
    //     // dd($studentId);

    //     $studentclass = Student::where('id', $studentId)->where(['students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->select('s_classid')->first();

    //     $assignstaff = DB::table('assignstaffs')
    //         ->select('as_class_id', 'id')
    //         ->where('as_class_id', $studentclass->s_classid) // Use the actual value from the object
    //         ->get();

    //     if (!empty($assignstaff)) {
    //         foreach ($assignstaff as $key => $requested) {
    //             $result = DB::table('subassignstaffs')
    //                 ->join('staff', 'staff.id', '=', 'subassignstaffs.as_staff_id')
    //                 ->where('as_id', $requested->id)
    //                 ->select(
    //                     'staff.login_id',
    //                     'staff.id',
    //                     'staff.sf_name',
    //                     'staff.sf_subject_taken',
    //                 )
    //                 ->get();

    //             $assignstaff[$key]->view = $result;
    //         }
    //     }

    //     return response()->json([
    //         'assignstaff' => $assignstaff,
    //         'inboxMessagesStaff' => $inboxMessagesStaff,
    //         'senderMessagesStudent' => $senderMessagesStudent,
    //         'inboxBulkMessages' => $inboxBulkMessages,
    //         'success' => true
    //     ]);
    // }


    public function messagestore(Request $request)
    {
        $studentlogId = $request->input('s_admissionno');
        $getid = Student::where('s_admissionno', $studentlogId)->where(['students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->first();
        $studentId = $getid->id;
                if ($request->sender_staff) {

            $getstaffid = Staff::where('staff_id', $request->sender_staff)
                ->where(['sf_status' => 1, 'sf_delete' => 1])
                ->first();
            $sender = $getstaffid->login_id;
        } else{
            $sender = Null;
        }

        if ($request->receiver_staff) {

            $getstaffid = Staff::where('staff_id', $request->receiver_staff)
                ->where(['sf_status' => 1, 'sf_delete' => 1])
                ->first();
            $receiver = $getstaffid->login_id;
        }else{
            $receiver = Null;
        }
        $post = new messages;

        $post->sender_admin = $request->sender_admin;
        $post->sender_staff = $request->sender_staff;
        $post->sender_student = $studentId;
        $post->receiver_admin = $request->receiver_admin;
        $post->receiver_staff = $request->receiver_staff;
        $post->receiver_student = $request->receiver_student;
        $post->subject = $request->subject;
        $post->message = $request->message;
        // $post->attachment = $attachment;
        // $post->attachment_path = $attachment_path;
        $post->datetime = date('D, M d,Y  h:i A');
        $post->save();



        // return redirect()->route('message.index')
        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully.',
        ]);
    }

    public function message(Request $request)
    {
        $studentlogId = $request->input('s_admissionno');
        $getid = Student::where('s_admissionno', $studentlogId)
            ->where(['students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])
            ->first();
        
        $studentId = $getid->id;
        $stafflogId = $request->input('staffId');
        $getstaffid = Staff::where('staff_id', $stafflogId)
        ->where([ 'sf_status' => 1, 'sf_delete' => 1])
        ->first();
        $staffId = $getstaffid->login_id;
        // $studentId = 1;
        // $staffId = 1;
        
        $send = DB::table('messages')
        ->where(function ($query) use ($studentId, $staffId) {
            $query->where('sender_student', $studentId)
                ->where('receiver_staff', $staffId);
        })
       
        ->orderBy('datetime', 'DESC')
        ->get();
        
        $inbox = DB::table('messages')
        ->orWhere(function ($query) use ($studentId, $staffId) {
            $query->where('sender_staff', $staffId)
                ->where('receiver_student', $studentId);
        })
        ->orderBy('datetime', 'DESC')
        ->get();
        
        return response()->json([
            'studentlogId' => $studentlogId,
            'studentId' => $studentId,
            'staffId' => $staffId,
            'send' => $send,
            'inbox' => $inbox,
            // 'inboxMessagesStaff' => $inboxMessages,
            'success' => true
        ]);
        
        
    }



    // public function studenttransport(Request $request)
    // {
    //     try {
    //         $studentloginId = $request->s_admissionno;

    //         $getid = Student::where('s_admissionno', $studentloginId)->where(['students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->first();

    //         $busdetail = DB::table('assignvehicles')
    //             ->join('routes', 'routes.id', '=', 'assignvehicles.route_id')
    //             ->join('vehicles', 'vehicles.id', '=', 'assignvehicles.vehicle_id')
    //             ->where(['assignvehicles.id' => $getid->s_vanid])
    //             ->select('routetitle', 'destination', 'vehiclenumber', 'staff_id')
    //             ->first();
    //         $busdriver = Staff::where(['staff_id' => $busdetail->staff_id])
    //             ->select('sf_name', 'sf_profile', 'sf_image_path', 'sf_phone')
    //             ->first();

    //         return response()->json(['busdetail' => $busdetail, 'busdriver' => $busdriver]);
    //     } catch (\Exception $e) {
    //         // Handle exceptions (e.g., log the error, return an error response, etc.)
    //         return response()->json(['error' => 'An error occurred while processing the request.'], 500);
    //     }
    // }
// }


public function studentTransport(Request $request)
{
    $studentLoginId = $request->s_admissionno;

    $student = Student::where('s_admissionno', $studentLoginId)
        ->where(['students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])
        ->first();

    if (!$student) {
        return response()->json(['error' => 'Student not found'], 404);
    }

    $studentsForRoute = StudentsForRoute::where('roll_no', $studentLoginId)->first();

    if (!$studentsForRoute) {
        return response()->json(['error' => 'Student not assigned to any route'], 404);
    }

    // $assignVehicle = Assignvehicles::select('assignvehicles.*')->where('route_id', $studentsForRoute->route_id)->first();
  
    $assignVehicle = Assignvehicles::join('staff', 'staff.id', '=',  'assignvehicles.staff_id')
     ->join('routes', 'routes.id', '=',  'assignvehicles.route_id')
     ->select('assignvehicles.*', 'staff.sf_name', 'staff.sf_phone as mobile', 'routes.routetitle')
     ->where('route_id', $studentsForRoute->route_id)
     ->first();

     $subRoute = DB::table('sub_route_locations')
     ->where('route_id', $studentsForRoute->route_id)
     ->select('sub_route_locations.id','sub_route_locations.name','sub_route_locations.route_id')
     ->get();

    if (!$assignVehicle) {
        return response()->json(['error' => 'AssignVehicle not found for the student'], 404);
    }

    $data = [
        'busno' => $assignVehicle->busno,
        'routeid' => $studentsForRoute->route_id,
        'routeName' => $assignVehicle->routetitle,
        'drivername' => $assignVehicle->sf_name,
        'mobileNumber' => $assignVehicle->mobile,
        'routeList' => $subRoute,
    ];

    return response()->json($data, 200);
}

// private function getRouteList($routeId)
// {
//     // Assuming you have a model for 'Route'
//     $route = Routes::find($routeId);

//     if (!$route) {
//         return [];
//     }

//     return $route->places->pluck('routetitle')->toArray();
// }
}
