<?php

namespace App\Http\Controllers;

use App\Models\Enews;
use App\Models\Student;
use App\Models\Enotices;
use Illuminate\Http\Request;
use App\Models\Class_section;
use App\Models\Examtime;
use App\Models\Examtimetable;
use App\Models\ExamTypes;
use App\Models\Fees;
use App\Models\Staff;
use App\Models\messages;
use Illuminate\Support\Carbon;
use App\Models\Studentattendance;
use Illuminate\Support\Facades\DB;

class StudentdetailsController extends Controller

{

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
        $studentId = session('studentid'); // Retrieve the student ID from the session

        if ($studentId) {
            $studentdetails = DB::table('students')
                ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
                ->where(['students.id' => $studentId, 'students.s_loginstatus' => 1])->first();
            return view('studentdetails.studenthome', compact('studentdetails', 'enewview', 'enoticesview', 'yesenewview', 'yesenoticesview', 'enewcount', 'enoticescount'))->with('success', 'Welcome to homepage');
        } else {
            // Handle the case where student ID is not found in the session
            return redirect()->back()->with('failed', 'You are not logged in.');
        }
    }

    public function studentattendance()
    {
        return view('studentdetails.studentattendance');
    }

    public function myattendancefilter(Request $request)
    {

        $monthid = $request->input('monthid');


        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }
        $MONTH = now()->format('Y-m');

        $studentId = session('studentid');

        $monthview = Studentattendance::where('stud_year', $fyear)->select('stud_month')->distinct()
            ->orderBy('stud_month', 'desc')
            ->get();

        if ($monthid) {

            $attendanceRecords = Studentattendance::where(['stud_id' => $studentId, 'stud_month' => $monthid])->orderBy('stud_date', 'asc')->get();

            $pr = Studentattendance::where(['stud_id' => $studentId, 'stud_month' => $monthid, 'stud_attid' => 1])->count();
            $Ab = Studentattendance::where(['stud_id' => $studentId, 'stud_month' => $monthid, 'stud_attid' => 2])->count();
        } else {

            $attendanceRecords = Studentattendance::where(['stud_id' => $studentId, 'stud_month' => $MONTH])->orderBy('stud_date', 'asc')->get();

            $pr = Studentattendance::where(['stud_id' => $studentId, 'stud_month' => $MONTH, 'stud_attid' => 1])->count();
            $Ab = Studentattendance::where(['stud_id' => $studentId, 'stud_month' => $MONTH, 'stud_attid' => 2])->count();
        }


        return view('studentdetails.studentattendance', compact('fyear', 'attendanceRecords', 'monthview', 'pr', 'Ab'));
    }


    public function classtimetable()
    {
        $studentloginId = session('studentid');

        $getid = Student::where('id', $studentloginId)->first();

        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        $classtime = DB::table('dailyclasstimes')
            ->select('classname')
            ->get();

        $timetableView = DB::table('classtimetables')
            ->join('class_sections', 'class_sections.id', '=', 'classtimetables.class_id')
            ->select('class_sections.id as section_id', 'class_sections.c_class', 'classtimetables.id as timetable_id', 'classtimetables.class_id')
            ->where('classtimetables.class_id', $getid->s_classid)
            ->get();

        if (!empty($timetableView)) {
            foreach ($timetableView as $key => $requested) {
                $result = DB::table('subclasstimetables')
                    ->join('days', 'days.id', '=', 'subclasstimetables.day_id')
                    ->where('tt_id', $requested->timetable_id)
                    ->select(
                        'days.day_name',
                        'subclasstimetables.pre1',
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

                $timetableView[$key]->tableview = $result;
            }
        }
        return view('studentdetails.studendclasstimetable', compact('timetableView', 'fyear', 'classtime'));
    }


    public function exammark()
    {
        return view('studentdetails.exammark');
    }

    public function exammarkfilter(Request $request)
    {
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        $examtype = ExamTypes::all();

        $class = DB::table('class_sections')
            ->where(['c_status' => 1, 'c_delete' => 1])
            ->get();

        $examid = $request->input('examid');
        $classid = $request->input('classid');
        $monthid = $request->input('monthid');
        $examdate = $request->input('examdate');

        $studentloginId = session('studentid');

        $getid = Student::where('id', $studentloginId)->first();
        $clid = $getid->s_classid;
        $stname = $getid->s_name;

        if ($examid == '1') {
            $markshow = DB::table('studentdailyexams')
                ->join('class_sections', 'class_sections.id', '=', 'studentdailyexams.class_id')
                // ->join('subjects', 'subjects.id', '=', 'marks.subject_id')
                ->join('exam_types', 'exam_types.id', '=', 'studentdailyexams.examtype_id')
                // ->select('marks.id as markid', 'marks.exam_year', 'marks.exam_date', 'class_sections.c_class', 'exam_types.name as exaname')

                ->select('studentdailyexams.examtype_id', 'exam_types.name', 'class_sections.c_class', 'studentdailyexams.exam_year', 'studentdailyexams.exam_month', 'studentdailyexams.exam_date')
                ->where(['studentdailyexams.class_id' => $classid, 'studentdailyexams.examtype_id' => $examid, 'studentdailyexams.exam_date' =>  $examdate,])
                ->distinct() // Adjust the class ID as needed
                ->get();

            foreach ($markshow as $key => $requested) {
                $result = DB::table('substudentdailyexams')
                    ->join('subjects', 'subjects.id', '=', 'substudentdailyexams.subject_id')
                    // ->join('students', 'students.id', '=', 'submarkentries.student_id')
                    ->select('subjects.name', 'substudentdailyexams.internal', 'substudentdailyexams.external', 'substudentdailyexams.mark')
                    ->where(['student_id' => $studentloginId, 'examdate' => $examdate])
                    ->get();

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
                    ->join('examtimetables', 'examtimetables.id', '=', 'submarkentries.student_id')
                    ->select('subjects.name', 'submarkentries.internal', 'submarkentries.external', 'submarkentries.mark')
                    ->where(['student_id' => $studentloginId, 'exammonth_id' => $monthid])
                    ->get();

                $markshow[$key]->tableview = $result;
            }
        }


        // dd($markshow);

        return view('studentdetails.exammark', compact('stname', 'fyear', 'examtype', 'class', 'clid', 'markshow'));
    }


    public function examschedule()
    {
        return view('studentdetails.examschedule');
    }

    public function examschedulefilter(Request $request)
    {
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }
        $academicyear = Examtimetable::distinct()->pluck('year')->toArray();


        $examtime = Examtime::all();

        $studentloginId = session('studentid');

        $getid = Student::where('id', $studentloginId)->first();


        $examtype = ExamTypes::all();

        $examtypeid = $request->examid;
        $academicid = $request->academicid;


        // dd( $examtypeid,  $academicid );


        if ($examtypeid && $academicid) {
            $examview = DB::table('examtimetables')
                ->join('class_sections', 'class_sections.id', '=', 'examtimetables.class_id') // Adjust the column name as needed
                ->join('exam_types', 'exam_types.id', '=', 'examtimetables.examtype_id')
                ->join('months', 'months.id', '=', 'examtimetables.months_id') // Assuming months.id is the primary key
                ->select('class_sections.id', 'class_sections.c_class', 'exam_types.name', 'months.monthName', 'examtimetables.year', 'examtimetables.id as timetable_id')
                ->where([
                    'examtype_id' => $examtypeid,
                    'examtimetables.year' => $academicid,  // Assuming year is a column in the examtimetables table
                    'class_sections.id' => $getid->s_classid,
                ])
                ->orderBy('timetable_id', 'desc')
                ->get();

            if (!empty($examview)) {
                foreach ($examview as $key => $requested) {
                    // Querying substafftimetables for sub-timetables associated with the current staff timetable
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

                    // Assigning the sub-timetable result to the 'tableview' property of the current staff timetable
                    $examview[$key]->tableview = $result;
                }
            }
        } else {
            $examview = DB::table('examtimetables')
                ->join('class_sections', 'class_sections.id', '=', 'examtimetables.class_id') // Adjust the column name as needed
                ->join('exam_types', 'exam_types.id', '=', 'examtimetables.examtype_id')
                ->join('months', 'months.id', '=', 'examtimetables.months_id') // Assuming months.id is the primary key
                ->select('class_sections.id', 'class_sections.c_class', 'exam_types.name', 'months.monthName', 'examtimetables.year', 'examtimetables.id as timetable_id')
                ->where([
                    // 'examtype_id' => $examtypeid,
                    'examtimetables.year' => $fyear,  // Assuming year is a column in the examtimetables table
                    'class_sections.id' => $getid->s_classid,
                ])
                ->orderBy('timetable_id', 'desc')
                ->orderBy('examtimetables.id', 'desc')
                // ->limit(2)
                ->get();

            if (!empty($examview)) {
                foreach ($examview as $key => $requested) {
                    // Querying substafftimetables for sub-timetables associated with the current staff timetable
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

                    // Assigning the sub-timetable result to the 'tableview' property of the current staff timetable
                    $examview[$key]->tableview = $result;
                }
            }
        }
        return view('studentdetails.examschedule', compact('examtype', 'fyear', 'examview', 'examtime', 'academicyear'));
    }

    public function feesdetails()
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

        // $classId = $request->class; // Replace with the desired class ID

        $studentloginId = session('studentid');

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
            ->where('students.id', $studentloginId)
            ->where('student_fees_records.academic_year', $fyear)
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
            ->get();

            $previousYearRecords = []; 
        //   dd($feesRecords); 
    
        foreach ($feesRecords as $feesRecord) { 
            $a = $feesRecord->student_id;

        $recordsForCurrentStudent = DB::table('student_fees_records')
            ->select(
                'students.s_name',
                'students.id',
                // 'class_sections.c_class',
                'student_fees_records.total_fees',
                'student_fees_records.academic_year',
                'student_fees_records.balance',
                // 'student_fees_records.total_fees_paid',
                'student_fees_records.student_id'
            )
            ->join('students', 'students.id', '=', 'student_fees_records.student_id')
            ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
            ->where('students.id', $a)
          
            ->where('student_fees_records.academic_year', '<>', $fyear) // Exclude current year
            ->groupBy(
                'students.s_name',
                'students.id',
                // 'class_sections.c_class',
                'student_fees_records.total_fees',
                'student_fees_records.academic_year',
                'student_fees_records.balance',
                // 'student_fees_records.total_fees_paid',
                'student_fees_records.student_id'
            )
            ->get();
    
        // Append the records for the current student to the array
        $previousYearRecords[$a] = $recordsForCurrentStudent;
        }
        // dd( $previousYearRecords);
        // Merge the collections into one

        // $combinedRecords = $feesRecords;

        // Pass $combinedRecords to the view

        // dd($feesRecords,$previousYearRecords);
        if (!$feesRecords) {

            return redirect()->route('error');
        }



        return view('studentdetails.feesdetails', compact('feesRecords', 'previousYearRecords'));
    }
    public function sendmessage()
    {
        return view('studentdetails.sendmessage');
    }


    public function message()
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

        $studentId = session('studentid');

        $senderMessagesStudent = DB::table('messages')
            ->join('students', 'students.id', '=', 'messages.sender_student')
            ->join('staff', 'staff.login_id', '=', 'messages.receiver_staff')
            ->where('messages.sender_student', $studentId)
            // ->where('messages.receiver_staff','=', 'staff.login_id')
            ->select('messages.*', 'staff.sf_name as name')
            ->orderBy('messages.id', 'DESC')
            ->get();

        $inboxMessagesStaff = DB::table('messages')
            ->join('staff', 'staff.login_id', '=', 'messages.sender_staff')
            ->where('messages.receiver_student', $studentId)
            ->select('messages.*', 'staff.sf_name as name')
            ->orderBy('messages.id', 'DESC')
            ->get();

            $inboxBulkMessages = DB::table('bulkclassmessages')
            ->join('class_sections', 'class_sections.id', '=', 'bulkclassmessages.bcm_classid')    
            ->join('students', 'students.s_classid', '=', 'class_sections.id')
            ->join('roles','roles.id', '=', 'bulkclassmessages.bcm_senderid')
            ->select('bulkclassmessages.bcm_subject as subject','bulkclassmessages.datetime','roles.r_name as name')
            ->where('bulkclassmessages.bcm_year',$fyear)
            ->where('students.id',$studentId)
            ->get();
// dd($inboxBulkMessages);
        // dd($studentId);

        $studentclass = Student::where('id', $studentId)->select('s_classid')->first();

        $assignstaff = DB::table('assignstaffs')
            ->select('as_class_id', 'id')
            ->where('as_class_id', $studentclass->s_classid) // Use the actual value from the object
            ->get();

        if (!empty($assignstaff)) {
            foreach ($assignstaff as $key => $requested) {
                $result = DB::table('subassignstaffs')
                    ->join('staff', 'staff.id', '=', 'subassignstaffs.as_staff_id')
                    ->where('as_id', $requested->id)
                    ->select(
                        'staff.login_id',
                        'staff.id',
                        'staff.sf_name',
                        'staff.sf_subject_taken',
                    )
                    ->get();

                $assignstaff[$key]->view = $result;
            }
        }

        return view('studentdetails.message.messagedetails', compact('inboxMessagesStaff', 'assignstaff', 'senderMessagesStudent','inboxBulkMessages'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function messagestore(Request $request)
    {

        // dd($request);

        $post = new messages;

        $post->sender_admin = $request->sender_admin;
        $post->sender_staff = $request->sender_staff;
        $post->sender_student = $request->sender_student;
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
        return redirect()->back()

            ->with('success', 'Message Send successfully.');
    }

    public function subject()
    {
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        $studentloginId = session('studentid');

        $getid = Student::where('id', $studentloginId)->first();
        $clid = $getid->s_classid;

        $subject = DB::table('staffdailycontents')
            ->join('subjects', 'subjects.id', '=', 'staffdailycontents.subjectid')
            ->select('subjects.id as subid', 'subjects.name', 'staffdailycontents.classid')
            ->where(['staffdailycontents.classid' => $clid, 'acd_year' => $fyear])
            ->distinct()->get();


        return view('studentdetails.dailytopic.subjectview', compact('subject'));
    }

    public function dailytopicshow()
    {

        return view('studentdetails.dailytopic.dailytopicview');
    }


    public function dailytopic(Request $request)
    {

        $subject = $request->input('sub_id');
        // Get the current month, year, and short year
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        // Calculate the academic year based on the current month
        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        // Get the current date using Carbon
        $todayDate = Carbon::now()->format('Y-m-d');

        // Retrieve the student's ID from the session
        $studentloginId = session('studentid');

        // Query the database to fetch relevant data
        $getid = Student::where('id', $studentloginId)->first();
        $clid = $getid->s_classid;



        $contentview = DB::table('staffdailycontents')
            ->join('subjects', 'subjects.id', '=', 'staffdailycontents.subjectid')
            ->select('subjects.id as subid', 'subjects.name', 'staffdailycontents.classid', 'staffdailycontents.title', 'staffdailycontents.content_path', 'staffdailycontents.id')
            ->where([
                'date' => $todayDate,
                'classid' => $clid,
                'subjects.id' => $subject,
                'acd_year' => $fyear,
            ])
            ->first();


        // Return the view with the contentview data
        return view('studentdetails.dailytopic.dailytopicview', compact('contentview', 'fyear'));
    }


    public function dailytopicfilter(Request $request)
    {

        $olddate = $request->input('olddate');
        // $subject = $request->input('sub_id');
        // Get the current month, year, and short year
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        // Calculate the academic year based on the current month
        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        // Get the current date using Carbon
        $todayDate = Carbon::now()->format('Y-m-d');

        // Retrieve the student's ID from the session
        $studentloginId = session('studentid');

        // Query the database to fetch relevant data
        $getid = Student::where('id', $studentloginId)->first();
        $clid = $getid->s_classid;

        if ($olddate) {
            $contentview = DB::table('staffdailycontents')
                ->join('subjects', 'subjects.id', '=', 'staffdailycontents.subjectid')
                ->select('subjects.name', 'staffdailycontents.date', 'staffdailycontents.classid', 'staffdailycontents.title', 'staffdailycontents.content_path', 'staffdailycontents.id')
                ->where([
                    'date' => $olddate,
                    'classid' => $clid,
                    // 'subjects.id' => $subject,
                    'acd_year' => $fyear,
                ])
                ->get();
        } else {
            $contentview = DB::table('staffdailycontents')
                ->join('subjects', 'subjects.id', '=', 'staffdailycontents.subjectid')
                ->select('subjects.name', 'staffdailycontents.date', 'staffdailycontents.classid', 'staffdailycontents.title', 'staffdailycontents.content_path', 'staffdailycontents.id')
                ->where([
                    'date' => $todayDate,
                    'classid' => $clid,
                    // 'subjects.id' => $subject,
                    'acd_year' => $fyear,
                ])
                ->get();
        }



        // Return the view with the contentview data
        return view('studentdetails.dailytopic.dailytopicview', compact('contentview', 'fyear'));
    }

    public function homework()
    {
        return view('studentdetails.dailytopic.homework');
    }

    public function homeworkfilter(Request $request)
    {

        $olddate = $request->input('olddate');

        // Get the current month, year, and short year
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        // Calculate the academic year based on the current month
        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        // Get the current date using Carbon
        $todayDate = Carbon::now()->format('Y-m-d');

        // Retrieve the student's ID from the session
        $studentloginId = session('studentid');

        // Query the database to fetch relevant data
        $getid = Student::where('id', $studentloginId)->first();
        $clid = $getid->s_classid;

        if ($olddate) {
            $homework = DB::table('homework')
                ->join('subjects', 'subjects.id', '=', 'homework.hw_subjectid')
                ->select('homework.hw_title', 'homework.hw_content', 'homework.hw_date', 'subjects.name', 'homework.id', 'homework.hw_content_path',)
                ->where([
                    'hw_date' => $olddate,
                    'hw_classid' => $clid,
                    // 'subjects.id' => $subject,
                    'acd_year' => $fyear,
                ])
                ->get();
        } else {
            $homework = DB::table('homework')
                ->join('subjects', 'subjects.id', '=', 'homework.hw_subjectid')
                ->select('homework.hw_title', 'homework.hw_content', 'homework.hw_date', 'subjects.name', 'homework.id', 'homework.hw_content_path',)
                ->where([
                    'hw_date' => $todayDate,
                    'hw_classid' => $clid,
                    // 'subjects.id' => $subject,
                    'acd_year' => $fyear,
                ])
                ->get();
        }
        return view('studentdetails.dailytopic.homework', compact('homework'));
    }

    public function staff()
    {

        $studentloginId = session('studentid');
        $getid = Student::where('id', $studentloginId)->first();
        $clid = $getid->s_classid;

        $assignstaff = DB::table('assignstaffs')
            ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')    
            ->join('subassignstaffs', 'subassignstaffs.as_id', '=', 'assignstaffs.id') 
            ->join('staff', 'staff.id', '=', 'subassignstaffs.as_staff_id')
            ->select('staff.*')
            ->where('class_sections.id', $clid)
            ->get();
        // dd($assignstaff);

        return view('studentdetails.staffdetails', compact('assignstaff'));
    }

    public function getstudent(Request $request)
    {

        $a = $request->class_id;
       
        // return response($a);
        $data['students'] = DB::table('class_sections')
            ->join('students', 'students.s_classid', '=', 'class_sections.id')
            ->select('students.id', 'students.s_name')
            ->where('students.s_classid', $request->class_id)
            // ->where('s_delete', 1)
            ->get();

        // $data['students'] = DB::table('students')
        // ->join('class_section', 'class_section.id', '=', 'students.s_classid')
        // ->select('id', 's_name')
        // ->where("s_classid", $request->class_id)
        // ->where('s_delete', 1)
        // ->get();

        return response()->json($data);
    }

















}
