<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Attendancetype;
use App\Models\Class_section;
use App\Models\Staffattandance;
use App\Models\Staffdailycontent;
use App\Models\Studentattendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ClassteacherController extends Controller
{
    public function studenttimetable()
    {
        return view('classteacher.classtimetable');
    }

    public function studenttimetablefilter(Request $request)
    {

        $id = Auth::user()->id;

        $staff = Staff::where('login_id', $id)->first();

        
        $class = DB::table('assignstaffs')
            ->join('subassignstaffs', 'subassignstaffs.as_id', '=', 'assignstaffs.id')
            ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')
            ->select('class_sections.id', 'class_sections.c_class')
            ->where('subassignstaffs.as_staff_id', $staff->id)->get();

        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        $classid = $request->input('class');

        $timetableView = DB::table('classtimetables')
            ->join('class_sections', 'class_sections.id', '=', 'classtimetables.class_id')
            ->select('class_sections.id as section_id', 'class_sections.c_class', 'classtimetables.id as timetable_id', 'classtimetables.class_id')
            ->where('classtimetables.class_id', $classid)
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

        return view('classteacher.classtimetable', compact('timetableView', 'fyear', 'class'));
    }

    public function classteacherdailytimetable()
    {

        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        $id = Auth::user()->id;
        $staff = Staff::where('login_id', $id)->select('id')->first();

        $timetableView = DB::table('stafftimetables')
            ->join('staff', 'staff.id', '=', 'stafftimetables.staff_id')
            ->select('staff.id as section_id', 'staff.sf_name', 'stafftimetables.id as timetable_id', 'stafftimetables.staff_id')
            ->where('staff.id', $staff->id)
            ->get();

        // Checking if staff timetables were retrieved successfully
        if (!empty($timetableView)) {
            foreach ($timetableView as $key => $requested) {
                // Querying substafftimetables for sub-timetables associated with the current staff timetable
                $result = DB::table('substafftimetables')
                    ->join('days', 'days.id', '=', 'substafftimetables.day_id')
                    ->where('tt_id', $requested->timetable_id)
                    ->select(
                        'days.day_name',
                        'substafftimetables.pre1',
                        'substafftimetables.pre2',
                        'substafftimetables.pre3',
                        'substafftimetables.pre4',
                        'substafftimetables.pre5',
                        'substafftimetables.pre6',
                        'substafftimetables.pre7',
                        'substafftimetables.pre8'
                    )
                    ->get();

                // Assigning the sub-timetable result to the 'tableview' property of the current staff timetable
                $timetableView[$key]->tableview = $result;
            }
        }

        return view('classteacher.dailytimetable', compact('timetableView', 'fyear'));
    }

    public function classteacherinbox()
    {
        return view('classteacher.message.inbox');
    }
    public function classteachersent()
    {
        return view('classteacher.message.sent');
    }



    public function studentattendance()
    {
        return view('classteacher.studentatt.studentattendance', compact('class'));
    }
    public function studentattendancefilter(Request $request)
    {
        $id = Auth::user()->id;

        $staff = Staff::where('login_id', $id)->first();

        if ($staff) {
            $class = DB::table('class_sections')
                ->where(['c_status' => 1, 'c_delete' => 1, 'c_teacherid' => $staff->id])
                ->get();
        } else {
            $class = DB::table('class_sections')
                ->where(['c_status' => 1, 'c_delete' => 1,])
                ->get();
        }



        $currentDate = Carbon::now();
        $formattedDate = $currentDate->format('Y-m-d');
        $classid = $request->input('classid');
        $date = $request->input('date');

        $query = DB::table('studentattendances')
            ->join('students', 'students.id', '=', 'studentattendances.stud_id')
            ->join('class_sections', 'class_sections.id', '=', 'studentattendances.stud_classid')
            ->join('attendancetypes', 'attendancetypes.tt_id', '=', 'studentattendances.stud_attid')
            ->select('studentattendances.stud_date', 'class_sections.c_class', 'attendancetypes.tt_name', 'students.s_name')
            ->orderBy('students.s_name', 'asc');

        if (!empty($classid)) {
            $query->where('studentattendances.stud_classid', $classid);
        }

        if (!empty($date)) {
            $query->where('studentattendances.stud_date', $date);
        } else {
            $query->where(['studentattendances.stud_date' => $formattedDate, 'studentattendances.stud_classid' => $classid,]);
        }

        $studentatt = $query->where('students.s_delete', 1)->get();

        return view('classteacher.studentatt.studentattendance', compact('studentatt', 'class'));
    }

    public function studentattendanceedit()
    {
        return view('classteacher.studentatt.studentattendanceedit');
    }
    public function studenttakeattendance()
    {

        return view('classteacher.studentatt.takeattendance', compact('class'));
    }

    public function takeattendancefilter(Request $request)
    {
        // Calculate the academic year
        $currentMonth = date('m');
        $year = date('Y');
        $shortYear = date('y');
        $fyear = ($currentMonth >= "06") ? ($year . '-' . ($shortYear + 1)) : (($year - 1) . '-' . $shortYear);

        // Fetch all attendance types (assuming you have a model for Attendancetype)
        $att = Attendancetype::all();

        // Get the selected class ID from the request
        $classid = $request->input('classid');

        // Fetch students of the selected class
        $students = DB::table('students')
            ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
            ->select('students.id as stid', 'students.s_name as stname', 'class_sections.c_class as cname', 'class_sections.id as cid')
            ->where('s_classid', $classid)
            ->where('s_delete', 1)
            ->orderBy('stname', 'asc')
            ->get();

        // Get the currently logged-in user's ID (assuming you're using the Auth facade)
        $id = Auth::user()->id;

        // Fetch the staff member using the logged-in user's ID
        $staff = Staff::where('login_id', $id)->first();

        // Fetch classes taught by the staff member
        if ($staff) {
            $class = DB::table('class_sections')
                ->where(['c_status' => 1, 'c_delete' => 1, 'c_teacherid' => $staff->id])
                ->get();
        } else {
            $class = DB::table('class_sections')
                ->where(['c_status' => 1, 'c_delete' => 1,])
                ->get();
        }


        return view('classteacher.studentatt.takeattendance', compact('students', 'att', 'fyear', 'class'));
    }


    public function takeattendanceinsert(Request $request)
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

            $DATE = $request->input('att_date');
            $CLASSID = $request->input('studentclass');

            $checkatt = Studentattendance::where(['stud_date' => $DATE, 'stud_classid' => $CLASSID])->first();
            if ($checkatt) {
                return redirect()->back()->with('failed', 'Already Took Attendance');
            } else {
                  $rules = [
                    'studentname' => 'required',
                           ];
            
                // Validate the request
                $validator = Validator::make($request->all(), $rules);
            
                // Check if the validation fails
                if ($validator->fails()) {
                    // return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
                    return redirect()->back()->with('failed', 'Select Class First');
                }
                
                
                
                $STUDENTNAME = $request->input('studentname');
                $ATTENDANCE = $request->input('attendance');
                $MONTH = now()->format('Y-m');

                $savearray = [];

                for ($i = 0; $i < count($STUDENTNAME); $i++) {
                    $savearray[] = [
                        'studentclass' => $CLASSID[$i],
                        'studentname' => $STUDENTNAME[$i],
                        'attendance' => $ATTENDANCE[$i],
                    ];
                }

                foreach ($savearray as $data) {
                    Studentattendance::insert([
                        'stud_id' => $data['studentname'],
                        'stud_classid' => $data['studentclass'],
                        'stud_attid' => $data['attendance'],
                        'stud_year' => $fyear,
                        'stud_date' => $DATE,
                        'stud_month' => $MONTH,
                    ]);
                }
                return redirect()->back()->with('success', 'Attendance Saved Successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Unable to Save Attendance');
        }
    }


    public function studentfilterattendance()
    {

        return view('classteacher.studentatt.filterattendance', compact('class'));
    }

    public function monthattendancefiltersdsd(Request $request)
    {
        $id = Auth::user()->id;

        $staff = Staff::where('login_id', $id)->first();

        if ($staff) {
            $class = DB::table('class_sections')
                ->where(['c_status' => 1, 'c_delete' => 1, 'c_teacherid' => $staff->id])
                ->get();
        } else {
            $class = DB::table('class_sections')
                ->where(['c_status' => 1, 'c_delete' => 1,])
                ->get();
        }


        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        // Get the current date and generate an array of date strings for the current month
        $today = Carbon::today();
        $dates = [];

        for ($i = 1; $i <= $today->daysInMonth; ++$i) {
            $dates[] = Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
            $dateses[] = Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
        }

        // Get the staff position from the request
        $classid = $request->input('classid');
        $MONTH = now()->format('m-Y');

        // Query to retrieve staff attendance data and organize it into the $attendanceData array
        $studentatt = DB::table('studentattendances')
            ->join('students', 'students.id', '=', 'studentattendances.stud_id')
            ->select('students.id', 'students.s_name', 'studentattendances.stud_id as stuid')
            ->where(['s_delete' => 1, 'students.s_classid' => $classid, 'studentattendances.stud_year' => $fyear])
            ->distinct()
            ->get();

        $attendanceData = [];

        foreach ($studentatt as $student) {
            $attendanceData[$student->stuid]['name'] = $student->s_name;
            $attendanceData[$student->stuid]['sid'] = $student->stuid;

            foreach ($dates as $date) {
                $check_attd = DB::table('studentattandances')
                    ->where('stud_id', $student->stuid)
                    ->where(['stud_date' => $date, 'stud_year' => $fyear])
                    ->first();

                $attendanceData[$student->stuid]['attendance'][$date] = $check_attd ? $check_attd->att_id : null;
            }
        }

        return view('classteacher.studentatt.filterattendanceff',  compact('dateses', 'attendanceData', 'dates', 'class'));
    }
    public function monthattendancefilter(Request $request)
    {

        $id = Auth::user()->id;

        $staff = Staff::where('login_id', $id)->first();


        if ($staff) {
            $class = DB::table('class_sections')
                ->where(['c_status' => 1, 'c_delete' => 1, 'c_teacherid' => $staff->id])
                ->get();
        } else {
            $class = DB::table('class_sections')
                ->where(['c_status' => 1, 'c_delete' => 1,])
                ->get();
        }

        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        // Get the current date and generate an array of date strings for the current month
        $today = Carbon::today();
        $dates = [];

        for ($i = 1; $i <= $today->daysInMonth; ++$i) {
            $dates[] = $today->copy()->day($i)->format('Y-m-d');
        }

        // Get the class ID from the request
        $classid = $request->input('classid');
        $MONTH = now()->format('m-Y');

        // Query to retrieve student attendance data and organize it into the $attendanceData array
        $studentatt = DB::table('studentattendances')
            ->join('students', 'students.id', '=', 'studentattendances.stud_id')
            ->select('students.id', 'students.s_name', 'studentattendances.stud_id as stuid', 'studentattendances.stud_year')
            ->where(['students.s_delete' => 1, 'students.s_classid' => $classid, 'studentattendances.stud_year' => $fyear])
            ->distinct()->orderBy('students.s_name', 'asc')
            ->get();

        $attendanceData = [];

        foreach ($studentatt as $student) {
            $attendanceData[$student->stuid]['name'] = $student->s_name;
            $attendanceData[$student->stuid]['sid'] = $student->stuid;

            foreach ($dates as $date) {
                $check_attendance = DB::table('studentattendances')
                    ->where('stud_id', $student->stuid)
                    ->where(['stud_date' => $date, 'stud_year' => $fyear])
                    ->first();

                $attendanceData[$student->stuid]['attendance'][$date] = $check_attendance ? $check_attendance->stud_attid : null;
            }
        }

        // Now you have the attendance data organized in the $attendanceData array

        return view('classteacher.studentatt.filterattendance', ['attendanceData' => $attendanceData, 'dates' => $dates, 'class' => $class]);
    }

    public function myattendance()
    {
        return view('classteacher.myattendance');
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

        $monthview = Staffattandance::where('att_year', $fyear)->select('att_month')->distinct()
            ->orderBy('att_month', 'desc')
            ->get();

        $id = Auth::user()->id;

        $staff = Staff::where('login_id', $id)->first();

        if ($monthid) {
            if ($staff) {
                $staffId = $staff->id;
                $attendanceRecords = Staffattandance::where(['staff_id' => $staffId, 'att_month' => $monthid])->orderBy('att_date', 'asc')->get();
            } else {
                echo "No staff member found for the given login ID.";
            }
            $pr = Staffattandance::where(['staff_id' => $staffId, 'att_month' => $monthid, 'att_id' => 1])->count();
            $Ab = Staffattandance::where(['staff_id' => $staffId, 'att_month' => $monthid, 'att_id' => 2])->count();
        } else {
            if ($staff) {
                $staffId = $staff->id;
                $attendanceRecords = Staffattandance::where(['staff_id' => $staffId, 'att_month' => $MONTH])->orderBy('att_date', 'asc')->get();
            } else {
                echo "No staff member found for the given login ID.";
            }
            $pr = Staffattandance::where(['staff_id' => $staffId, 'att_month' => $MONTH, 'att_id' => 1])->count();
            $Ab = Staffattandance::where(['staff_id' => $staffId, 'att_month' => $MONTH, 'att_id' => 2])->count();
        }

        return view('classteacher.myattendance', compact('attendanceRecords', 'monthview', 'pr', 'Ab'));
    }

    public function studentdetailslist()
    {
        return view('classteacher.studentatt.studentdetailslist');
    }

    public function studentstatus($id)
    {
        try {
            $loginstatus = Student::where(array('id' => $id))->select('s_loginstatus')->first();

            switch ($loginstatus->s_loginstatus) {
                case 1:
                    $status = 0;
                    break;
                case 0:
                    $status = 1;
                    break;
                default:

                    break;
            }
            Student::where(array('id' => $id))->update(['s_loginstatus' => $status]);
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'not change');
        }
    }

    public function studentdetailslistfilter(Request $request)
    {
        $id = Auth::user()->id;

        $staff = Staff::where('login_id', $id)->first();


        $class = DB::table('class_sections')
            ->where(['c_status' => 1, 'c_delete' => 1, 'c_teacherid' => $staff->id])
            ->get();

        $classid = $request->input('class');

        $students = DB::table('students')
            ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
            ->select('students.*', 'class_sections.c_class as cname')
            ->where('s_classid',  $classid)
            ->where('s_delete', 1)
            ->get();

        return view('classteacher.studentatt.studentdetailslist', compact('students', 'class'));
    }


    public function studentdetailsview($id)
    {
        // Use the DB facade to query the database
        $student = DB::table('students')
            ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
            ->select('students.*', 'class_sections.c_class as cname')
            ->where('students.id', $id) // Filter by student ID
            ->where('s_delete', 1) // Filter by s_delete column (assuming 1 means not deleted)
            ->first(); // Retrieve the data

        // Pass the retrieved data to a view and compact it as 'students'
        return view('classteacher.studentatt.studentdetailview', compact('student'));
    }



    public function monthlycount()
    {

        return view('classteacher.studentatt.studenttotalATT');
    }

    public function monthlycountfilter(Request $request)
    {
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        $id = Auth::user()->id;

        $staff = Staff::where('login_id', $id)->first();

        if ($staff) {
            $class = DB::table('class_sections')
                ->where(['c_status' => 1, 'c_delete' => 1, 'c_teacherid' => $staff->id])
                ->get();
        } else {
            $class = DB::table('class_sections')
                ->where(['c_status' => 1, 'c_delete' => 1,])
                ->get();
        }

        $classid = $request->input('classid');
        $monthid = $request->input('monthid');

        if ($classid) {
            // Get the class name based on the selected class ID
            $studentclass = DB::table('class_sections')->where('id', $classid)->select('c_class')->first();
            $classname = $studentclass->c_class;
        } else {
            // Handle the case where no class ID is provided
            $classname = "No class selected";
        }

        $studentatt = DB::table('studentattendances')
            ->join('students', 'students.id', '=', 'studentattendances.stud_id')
            ->select('students.id', 'students.s_name', 'studentattendances.stud_id as stuid', 'studentattendances.stud_year')
            ->where(['students.s_delete' => 1, 'students.s_classid' => $classid])
            ->distinct()->orderBy('students.s_name', 'asc')
            ->get();

        $attendanceData = [];

        foreach ($studentatt as $student) {
            $attendanceData[$student->stuid]['name'] = $student->s_name;
            $attendanceData[$student->stuid]['sid'] = $student->stuid;

            // Calculate presences for the current student
            $check_pres = DB::table('studentattendances')
                ->join('students', 'students.id', '=', 'studentattendances.stud_id')
                ->where('studentattendances.stud_id', $student->stuid)
                ->where('stud_attid', '1')
                ->where('stud_month', $monthid)
                ->count();

            // Calculate absences for the current student
            $check_abs = DB::table('studentattendances')
                ->join('students', 'students.id', '=', 'studentattendances.stud_id')
                ->where('studentattendances.stud_id', $student->stuid)
                ->where('stud_attid', '2')
                ->where('stud_month', $monthid)
                ->count();

            // Store the presence and absence counts in the attendanceData array
            $attendanceData[$student->stuid]['presences'] = $check_pres;
            $attendanceData[$student->stuid]['absences'] = $check_abs;
        }

        return view('classteacher.studentatt.studenttotalATT', compact('class', 'fyear', 'attendanceData', 'classname'));
    }

    public function staffsider()
    {
        $id = Auth::user()->id;

        $staff = Staff::where('login_id', $id)->first();
      

        if ($staff) {
            $siderass = DB::table('class_sections')
                ->where(['c_status' => 1, 'c_delete' => 1, 'c_teacherid' => $staff->id])
                ->get();
        } else {
            $siderass = DB::table('class_sections')
                ->where(['c_status' => 1, 'c_delete' => 1,])
                ->get();
        }
        return view('include.classteachersidebar', compact('siderass'));
    }
}
