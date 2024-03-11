<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Day;
use App\Models\Marks;
use App\Models\Month;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Examtime;
use App\Models\subjects;
use App\Models\ExamTypes;
use App\Models\Submarkentry;
use Illuminate\Http\Request;
use App\Models\Class_section;
use App\Models\Examtimetable;
use App\Models\Studentdailyexam;
use App\Models\Subexamtimetable;
use App\Models\Substudentdailyexam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function offlineexam()
    {
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        $examtype = ExamTypes::where('id', '<>', 1)->get();

        $day = Day::all();
        $class = Class_section::where(['c_status' => 1, 'c_delete' => 1])->get();
        $subject = Subjects::all();
        $examtime = Examtime::all();
        return view('exam.offlineexam', compact('fyear', 'examtype', 'day', 'class', 'subject', 'month', 'examtime'));
    }

    public function examadd(Request $request)
    {

        // dd($request);
        try {
            $month = date('m');
            $year = date('Y');
            $shortYear = date('y');

            if ($month >= "06") {
                $fyear = $year . '-' . ($shortYear + 1);
            } else {
                $fyear = ($year - 1) . '-' . $shortYear;
            }

            $classid = $request->input('classes');
            $examtypeid = $request->input('examtype');
            $monthid = $request->input('months');

            $checkexam = Examtimetable::where(['class_id' => $classid, 'examtype_id' => $examtypeid, 'months_id' => $monthid])->first();
            if ($checkexam) {
                return redirect()->back()->with("failed", "Already Added");
            } else {
                // $examtypeid = $request->input('examtype');
                // $monthid = $request->input('months');

                $examtimetableid = Examtimetable::insertGetId([
                    'class_id' => $classid,
                    'examtype_id' => $examtypeid,
                    'months_id' => $monthid,
                    'year' => $fyear,
                ]);


                // Assuming $examtimetableid is correctly assigned
                $DATE = $request->dates;
                $DAY = $request->day;
                $TIME = $request->time;
                $CODE = $request->code;
                $SUBJECT = $request->subject;
                $examtimetables = [];

                // Prepare data for insertion
                for ($i = 0; $i < count($DATE); $i++) {
                    $examtimetables[] = [
                        'dates' => $DATE[$i],
                        'day' => $DAY[$i],
                        'time' => $TIME[$i],
                        'code' => $CODE[$i],
                        'subject' => $SUBJECT[$i],
                    ];
                }

                // Save to the database
                foreach ($examtimetables as $data) {
                    Subexamtimetable::insert([
                        'exam_id' => $examtimetableid, // Link to the main Examtimetable
                        'ett_date' => $data['dates'],
                        'ett_day' => $data['day'],
                        'ett_time' => $data['time'],
                        'ett_code' => $data['code'],
                        'ett_subject' => $data['subject'],
                    ]);
                }

                return redirect()->back()->with('success', 'Save Successfull');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not Save');
        }
    }

    public function offlinetimetable()
    {
        // $month = date('m');
        // $year = date('Y');
        // $shortYear = date('y');

        // if ($month >= "06") {
        //     $fyear = $year . '-' . ($shortYear + 1);
        // } else {
        //     $fyear = ($year - 1) . '-' . $shortYear;
        // }
        // $examview = DB::table('examtimetables')
        //     ->join('class_sections', 'class_sections.id', '=', 'examtimetables.class_id') // Adjust the column name as needed
        //     ->join('exam_types', 'exam_types.id', '=', 'examtimetables.examtype_id')
        //     ->join('months', 'months.id', '=', 'examtimetables.months_id') // Assuming months.id is the primary key
        //     ->select('class_sections.c_class', 'exam_types.name', 'months.monthName', 'examtimetables.year', 'examtimetables.id as timetable_id')
        //     ->where([
        //         'examtimetables.year' => $fyear  // Assuming year is a column in the examtimetables table
        //     ])
        //     ->orderBy('timetable_id', 'desc')
        //     ->get();

        // if (!empty($examview)) {
        //     foreach ($examview as $key => $requested) {
        //         // Querying substafftimetables for sub-timetables associated with the current staff timetable
        //         $result = DB::table('subexamtimetables')
        //             ->where('exam_id', $requested->timetable_id)
        //             ->select(
        //                 'ett_date',
        //                 'ett_day',
        //                 'ett_time',
        //                 'ett_code',
        //                 'ett_subject',
        //             )
        //             ->get();

        //         // Assigning the sub-timetable result to the 'tableview' property of the current staff timetable
        //         $examview[$key]->tableview = $result;
        //     }
        // }
        // , compact('examview')
        return view('exam.offlinetimetable');
    }

    public function offlinetimetablefilter(Request $request)
    {
        $exam = ExamTypes::where('id', '<>', 1)->get();

        $fyear = $request->fyear;
        $examtypeid = $request->examtypeid;
        $months = $request->months;

        $examview = DB::table('examtimetables')
            ->join('class_sections', 'class_sections.id', '=', 'examtimetables.class_id') // Adjust the column name as needed
            ->join('exam_types', 'exam_types.id', '=', 'examtimetables.examtype_id')
            // ->join('months', 'months.id', '=', 'examtimetables.months_id') // Assuming months.id is the primary key
            ->select('class_sections.c_class', 'exam_types.name', 'examtimetables.months_id', 'examtimetables.year', 'examtimetables.id as timetable_id')
            ->where([
                'examtype_id' => $examtypeid,
                'examtimetables.months_id' =>  $months,
                'examtimetables.year' => $fyear  // Assuming year is a column in the examtimetables table
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
                        'ett_subject',
                    )
                    ->get();

                // Assigning the sub-timetable result to the 'tableview' property of the current staff timetable
                $examview[$key]->tableview = $result;
            }
        }
        return view('exam.offlinetimetable', compact('examview', 'exam'));
    }

    public function offlineexamedit($id)
    {
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        $examtype = ExamTypes::where('id', '<>', 1)->get();
        $day = Day::all();
        $class = Class_section::where(['c_status' => 1, 'c_delete' => 1])->get();
        $subject = Subjects::all();
        $month = Month::all();
        $examtime = Examtime::all();

        $examedit = DB::table('examtimetables')
            ->join('class_sections', 'class_sections.id', '=', 'examtimetables.class_id')
            ->join('exam_types', 'exam_types.id', '=', 'examtimetables.examtype_id')
            // ->join('months', 'months.month', '=', 'examtimetables.months_id')
            ->select(
                'class_sections.id as sectionid',
                'class_sections.c_class',
                // 'months.month as monthid',
                // 'months.monthName',
                'exam_types.id as typeid',
                'examtimetables.months_id',
                'exam_types.name',
                'examtimetables.year',
                'examtimetables.id as timetable_id' // Assuming 'id' is the main ID of examtimetables
            )
            ->where([
                'examtimetables.id' => $id
            ])
            ->first();

        // Check if the main exam timetable data exists
        if (!empty($examedit)) {
            // Query subexamtimetables for sub-timetables associated with the current staff timetable
            $result = DB::table('subexamtimetables')
                ->where('exam_id', $examedit->timetable_id) // Use the correct property name
                ->select(
                    'id',
                    'ett_date',
                    'ett_day',
                    'ett_time',
                    'ett_code',
                    'ett_subject'
                )
                ->get();

            // Assign the sub-timetable result to the 'tableedit' property of the current staff timetable
            $examedit->tableedit = $result;

            // Access the main ID (examtimetables.id or timetable_id) here
            // $mainId = $examedit->timetable_id;
        }
        return view('exam.offlineexamedit', compact('fyear', 'examtype', 'day', 'class', 'subject', 'month', 'examtime', 'examedit',));
    }

    public function rowexamdelete($id)
    {
        try {
            DB::table('subexamtimetables')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Row delete successfull');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Row Not delete');
        }
    }

    public function examupdate(Request $request, $examid)
    {
        // dd($request);
        try {
            $classid = $request->input('classes');
            $examtypeid = $request->input('examtype');
            $monthid = $request->input('months');

            // Update the main exam timetable entry
            $examtimetableid = Examtimetable::where('id', $examid)->update([
                'class_id' => $classid,
                'examtype_id' => $examtypeid,
                'months_id' => $monthid,
            ]);

            $subview = Subexamtimetable::where('exam_id', $examid)
                ->select('id')
                ->pluck('id')
                ->toArray();

            $DATE = $request->dates;
            $DAY = $request->day;
            $TIME = $request->time;
            $CODE = $request->code;
            $SUBJECT = $request->subject;
            $examtimetables = [];

            // Prepare data for insertion
            for ($i = 0; $i < count($DATE); $i++) {
                $examtimetables[] = [
                    'dates' => $DATE[$i],
                    'day' => $DAY[$i],
                    'time' => $TIME[$i],
                    'code' => $CODE[$i],
                    'subject' => $SUBJECT[$i],
                ];
            }

            if (!empty($subview)) {
                // Update existing sub-exam timetable entries
                foreach ($subview as $key => $desId) {
                    if (array_key_exists($key, $examtimetables)) {
                        $data = $examtimetables[$key];

                        Subexamtimetable::where('id', $desId)->update([
                            'ett_date' => $data['dates'],
                            'ett_day' => $data['day'],
                            'ett_time' => $data['time'],
                            'ett_code' => $data['code'],
                            'ett_subject' => $data['subject'],
                        ]);
                    }
                }
            }

            $tableid = $request->timetableid;
            $RE_DATE = $request->re_dates;
            $RE_DAY = $request->re_day;
            $RE_TIME = $request->re_time;
            $RE_CODE = $request->re_code;
            $RE_SUBJECT = $request->re_subject;
            $reexamtimetables = [];

            // Prepare data for insertion
            for ($i = 0; $i < count($RE_DATE); $i++) {
                $reexamtimetables[] = [
                    're_dates' => $RE_DATE[$i],
                    're_day' => $RE_DAY[$i],
                    're_time' => $RE_TIME[$i],
                    're_code' => $RE_CODE[$i],
                    're_subject' => $RE_SUBJECT[$i],
                ];
            }

            // Insert new sub-exam timetable entries
            foreach ($reexamtimetables as $data) {
                Subexamtimetable::insert([
                    'exam_id' => $tableid,
                    'ett_date' => $data['re_dates'],
                    'ett_day' => $data['re_day'],
                    'ett_time' => $data['re_time'],
                    'ett_code' => $data['re_code'],
                    'ett_subject' => $data['re_subject'],
                ]);
            }

            return redirect()->back()->with('success', 'update successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Update ');
        }

        // return view('exam.offlinedailyexam');
    }


    public function examresult()
    {
        return view('exam.examresult');
    }

    public function markindex()
    {

        $id = Auth::user()->id;

        $staff = Staff::where('login_id', $id)->first();

        if ($staff) {
            $classdatas = DB::table('assignstaffs')
                ->join('subassignstaffs', 'subassignstaffs.as_id', '=', 'assignstaffs.id')
                ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')
                ->select('class_sections.id', 'class_sections.c_class')
                ->where('subassignstaffs.as_staff_id', $staff->id)->get();
        } else {
            $classdatas = DB::table('class_sections')
                ->select('class_sections.id', 'class_sections.c_class')
                ->get();
        }
        return view('marks.index', compact('classdatas'));
    }


    public function markcreate(Request $request)
    {
        $id = Auth::user()->id;
        $staff = Staff::where('login_id', $id)->first();

        if ($staff) {
            $staffs = Staff::where(['sf_delete' => 1, 'id' => $staff->id])
                ->whereNotNull('login_id')
                ->select('id', 'sf_name') // Use whereNotNull to check for a non-null value
                ->orderBy('sf_name', 'ASC')
                ->get();
        } else {
            $staffs = Staff::where(['sf_delete' => 1,])
                ->whereNotNull('login_id')
                ->select('id', 'sf_name') // Use whereNotNull to check for a non-null value
                ->orderBy('sf_name', 'ASC')
                ->get();
        }



        $exam_types = ExamTypes::where((['status' => 1]))->orderBy('name', 'ASC')->get();
        $subjects = subjects::where((['status' => 1]))->orderBy('name', 'ASC')->get();

        $class = $request->class_id;
        // return response($class);




        $classdatas = Class_section::where('id', $class, (['c_delete' => 1]))->first();
        // return response($classdatas);
        $students = Student::where('s_classid', $class)->orderBy('s_name', 'ASC')->get();

        return view('marks.create', compact('classdatas', 'students', 'staffs', 'exam_types', 'subjects'));
    }



    public function markaddinsert(Request $request)
    {
        // dd($request);
        try {
            // Calculate the academic year
            $currentMonth = date('m');
            $currentYear = date('Y');
            $shortYear = date('y');
            $fyear = ($currentMonth >= "06") ? ($currentYear . '-' . ($shortYear + 1)) : (($currentYear - 1) . '-' . $shortYear);

            // Extract request data
            $class_id = $request->class_id;
            $subject_id = $request->subjectid;
            $staff_id = $request->staffid;
            $exam_type_id = $request->exam_typeid;
            $exam_month = $request->exam_month;



            if ($request->exam_typeid == '1') {
                // Check if the exam record already exists
                $checkExam = Studentdailyexam::where([
                    'class_id' => $class_id,
                    'staff_id' => $staff_id,
                    'subject_id' => $subject_id,
                    'examtype_id' => $exam_type_id,
                    'exam_date' => $request->exam_date,
                    'exam_year' => $fyear
                ])->first();

                if ($checkExam) {
                    return redirect()->back()->with('failed', 'Marks have already been recorded for this exam');
                } else {
                    // Insert the exam record
                    $mark = new Studentdailyexam;
                    $mark->class_id = $class_id;
                    $mark->staff_id = $staff_id;
                    $mark->subject_id = $subject_id;
                    $mark->examtype_id = $exam_type_id;
                    $mark->exam_month = $exam_month;
                    $mark->exam_date = $request->exam_date;
                    $mark->exam_year = $fyear;
                    $mark->save();

                    // Extract mark data from the request
                    $student_ids = $request->student_id; // Assuming 'student_id' is an array
                    $marks = $request->mark; // Assuming 'mark' is an array
                    $internals = $request->internal; // Assuming 'internal' is an array
                    $externals = $request->external; // Assuming 'external' is an array

                    $data = [];

                    // Prepare data for bulk insert
                    for ($i = 0; $i < count($marks); $i++) {
                        $data[] = [
                            'mark_id' => $mark->id,
                            'mark' => $marks[$i],
                            'subject_id' => $subject_id,
                            'internal' => $internals[$i],
                            'external' => $externals[$i],
                            'student_id' => $student_ids[$i],
                            'exammonth_id' => $exam_month,
                            'examdate' => $request->exam_date
                        ];
                    }

                    // Bulk insert the mark entries
                    DB::table('substudentdailyexams')->insert($data);

                    return redirect()->back()->with('success', 'Marks saved successfully');
                }
            } else {
                // Check if the exam record already exists
                $checkExam = Marks::where([
                    'class_id' => $class_id,
                    'staff_id' => $staff_id,
                    'subject_id' => $subject_id,
                    'examtype_id' => $exam_type_id,
                    'exam_year' => $fyear
                ])->first();

                if ($checkExam) {
                    return redirect()->back()->with('failed', 'Marks have already been recorded for this exam');
                } else {
                    // Insert the exam record
                    $mark = new Marks;
                    $mark->class_id = $class_id;
                    $mark->staff_id = $staff_id;
                    $mark->subject_id = $subject_id;
                    $mark->examtype_id = $exam_type_id;
                    $mark->exam_month = $exam_month;
                    $mark->exam_year = $fyear;
                    $mark->save();

                    // Extract mark data from the request
                    $student_ids = $request->student_id; // Assuming 'student_id' is an array
                    $marks = $request->mark; // Assuming 'mark' is an array
                    $internals = $request->internal; // Assuming 'internal' is an array
                    $externals = $request->external; // Assuming 'external' is an array

                    $data = [];

                    // Prepare data for bulk insert
                    for ($i = 0; $i < count($marks); $i++) {
                        $data[] = [
                            'mark_id' => $mark->id,
                            'mark' => $marks[$i],
                            'subject_id' => $subject_id,
                            'internal' => $internals[$i],
                            'external' => $externals[$i],
                            'student_id' => $student_ids[$i],
                            'exammonth_id' => $exam_month
                        ];
                    }

                    // Bulk insert the mark entries
                    DB::table('submarkentries')->insert($data);

                    return redirect()->back()->with('success', 'Marks saved successfully');
                }
            }
        } catch (\Exception $e) {
            // Log the error for further investigation


            return redirect()->back()->with('failed', 'Failed to save marks');
        }
    }

    public function markshow(Request $request)
    {
        return view('marks.show');
    }

    public function markshowfilter(Request $request)
    {

        $id = Auth::user()->id;
        $staff = Staff::where('login_id', $id)->first();
        if ($staff) {

            $classs = DB::table('assignstaffs')
                ->join('subassignstaffs', 'subassignstaffs.as_id', '=', 'assignstaffs.id')
                ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')
                ->select('class_sections.id', 'class_sections.c_class')
                ->where('subassignstaffs.as_staff_id', $staff->id)->get();

            $staffslist = Staff::where(['sf_delete' => 1, 'id' => $staff->id])
                ->whereNotNull('login_id')
                ->select('id', 'sf_name') // Use whereNotNull to check for a non-null value
                ->orderBy('sf_name', 'ASC')
                ->get();
        } else {

            $staffslist = Staff::where(['sf_delete' => 1,])
                ->whereNotNull('login_id')
                ->select('id', 'sf_name') // Use whereNotNull to check for a non-null value
                ->orderBy('sf_name', 'ASC')
                ->get();

            $classs =  DB::table('class_sections')
                ->select('class_sections.id', 'class_sections.c_class')
                ->get();
        }


        $staffid = $request->input('staffid');
        $subjectid = $request->input('subjectid');
        $adyear = $request->input('adyear');
        $classid = $request->input('classid');
        $examid = $request->input('examid');
        $examdate = $request->input('exam_date');

        // return response($students);
        $subjects = subjects::where((['status' => 1]))->orderBy('name', 'ASC')->get();
        // $classs = Class_section::where(['c_delete' => 1])->get();

        // $classs  = Class_section::where('c_status', 1)
        //     ->where('c_delete', 1)
        //     ->whereNotNull('c_teacherid')
        //     ->get();


        $exams = ExamTypes::where((['status' => 1]))->get();

        $Adyear = Marks::where('status', 1)
            ->select('exam_year')
            ->distinct()
            ->get();



        if ($examid == '1') {
            // Assuming you have defined $classid, $subjectid, $examid, and $adyear earlier
            $markshow = DB::table('studentdailyexams')
                ->join('class_sections', 'class_sections.id', '=', 'studentdailyexams.class_id')
                ->join('staff', 'staff.id', '=', 'studentdailyexams.staff_id')
                ->join('subjects', 'subjects.id', '=', 'studentdailyexams.subject_id')
                ->join('exam_types', 'exam_types.id', '=', 'studentdailyexams.examtype_id')
                ->select('studentdailyexams.examtype_id', 'studentdailyexams.id as markid', 'studentdailyexams.exam_year', 'studentdailyexams.exam_month', 'studentdailyexams.exam_date', 'class_sections.c_class', 'subjects.name as subname', 'exam_types.name as exaname')
                ->where([
                    'studentdailyexams.staff_id' => $staffid, // Use the actual column name, not the alias
                    'studentdailyexams.class_id' => $classid, // Use the actual column name, not the alias
                    'studentdailyexams.subject_id' => $subjectid, // Use the actual column name, not the alias
                    'studentdailyexams.examtype_id' => $examid, // Use the actual column name, not the alias
                    'studentdailyexams.exam_year' => $adyear,
                    'studentdailyexams.exam_date' => $examdate
                ])
                ->get();

            if (!empty($markshow)) {
                foreach ($markshow as $key => $requested) {
                    // Querying substafftimetables for sub-timetables associated with the current staff timetable
                    $result = DB::table('substudentdailyexams')
                        ->join('students', 'students.id', '=', 'substudentdailyexams.student_id')
                        ->where('mark_id', $requested->markid)
                        ->select('s_name', 'mark', 'internal', 'external')
                        ->orderBy('s_name', 'asc')
                        ->get();

                    // Assigning the sub-timetable result to the 'tableview' property of the current staff timetable
                    $markshow[$key]->tableview = $result;
                }
            }
        } else {
            // Assuming you have defined $classid, $subjectid, $examid, and $adyear earlier
            $markshow = DB::table('marks')
                ->join('class_sections', 'class_sections.id', '=', 'marks.class_id')
                ->join('staff', 'staff.id', '=', 'marks.staff_id')
                ->join('subjects', 'subjects.id', '=', 'marks.subject_id')
                ->join('exam_types', 'exam_types.id', '=', 'marks.examtype_id')
                ->select('marks.examtype_id', 'marks.id as markid', 'marks.exam_month', 'marks.exam_year', 'marks.exam_date', 'class_sections.c_class', 'subjects.name as subname', 'exam_types.name as exaname')
                ->where([
                    'marks.staff_id' => $staffid, // Use the actual column name, not the alias
                    'marks.class_id' => $classid, // Use the actual column name, not the alias
                    'marks.subject_id' => $subjectid, // Use the actual column name, not the alias
                    'marks.examtype_id' => $examid, // Use the actual column name, not the alias
                    'marks.exam_year' => $adyear
                ])
                ->get();


            if (!empty($markshow)) {
                foreach ($markshow as $key => $requested) {
                    // Querying substafftimetables for sub-timetables associated with the current staff timetable
                    $result = DB::table('submarkentries')
                        ->join('students', 'students.id', '=', 'submarkentries.student_id')
                        ->where('mark_id', $requested->markid)
                        ->select('s_name', 'mark', 'internal', 'external')
                        ->orderBy('s_name', 'asc')
                        ->get();

                    // Assigning the sub-timetable result to the 'tableview' property of the current staff timetable
                    $markshow[$key]->tableview = $result;
                }
            }
        }

        // dd($markshow);
        return view('marks.show', compact('subjects', 'Adyear', 'classs', 'exams', 'markshow', 'staffslist'));
    }

    public function dailymarkedit($markid)
    {
        // return response($students);
        $subjects = subjects::where((['status' => 1]))->orderBy('name', 'ASC')->get();
        $classs = Class_section::where(['c_delete' => 1])->get();
        $exams = ExamTypes::where((['status' => 1]))->get();
        $Adyear = Marks::where((['status' => 1]))->select('exam_year')->distinct()
            ->get();
        $staffslist = Staff::where(['sf_delete' => 1,])
            ->whereNotNull('login_id')
            ->select('id', 'sf_name') // Use whereNotNull to check for a non-null value
            ->orderBy('sf_name', 'ASC')
            ->get();
        $id = Auth::user()->id;
        $staff = Staff::where('login_id', $id)->first();

        // Assuming you have defined $classid, $subjectid, $examid, and $adyear earlier
        $markshow = DB::table('studentdailyexams')
            ->join('class_sections', 'class_sections.id', '=', 'studentdailyexams.class_id')
            ->join('staff', 'staff.id', '=', 'studentdailyexams.staff_id')
            ->join('subjects', 'subjects.id', '=', 'studentdailyexams.subject_id')
            ->join('exam_types', 'exam_types.id', '=', 'studentdailyexams.examtype_id')
            ->select('studentdailyexams.subject_id', 'studentdailyexams.examtype_id', 'staff.sf_name', 'studentdailyexams.staff_id', 'studentdailyexams.class_id', 'studentdailyexams.id as markid', 'studentdailyexams.exam_year', 'studentdailyexams.exam_month', 'studentdailyexams.exam_date', 'class_sections.c_class', 'subjects.name as subname', 'exam_types.name as exaname')
            ->where('studentdailyexams.id', $markid)
            ->first();

        if (!empty($markshow)) {
            // Query submarkentries for sub-timetables associated with the current staff timetable
            $result = DB::table('substudentdailyexams')
                ->join('students', 'students.id', '=', 'substudentdailyexams.student_id')
                ->where('mark_id', $markshow->markid)
                ->select('students.s_name', 'substudentdailyexams.mark', 'students.id', 'substudentdailyexams.internal', 'substudentdailyexams.external',)
                ->orderBy('students.s_name', 'asc')
                ->get();
            // Assigning the sub-timetable result to the 'tableview' property of the current staff timetable
            $markshow->tableview = $result;
        }
        return view('marks.edit', compact('subjects', 'Adyear', 'classs', 'exams', 'markshow', 'staffslist'));
    }



    public function markedit($markid)
    {


        // return response($students);
        $subjects = subjects::where((['status' => 1]))->orderBy('name', 'ASC')->get();
        $classs = Class_section::where(['c_delete' => 1])->get();
        $exams = ExamTypes::where((['status' => 1]))->get();
        $Adyear = Marks::where((['status' => 1]))->select('exam_year')->distinct()
            ->get();



        $id = Auth::user()->id;
        $staff = Staff::where('login_id', $id)->first();




        // Assuming you have defined $classid, $subjectid, $examid, and $adyear earlier
        $markshow = DB::table('marks')
            ->join('class_sections', 'class_sections.id', '=', 'marks.class_id')
            ->join('staff', 'staff.id', '=', 'marks.staff_id')
            ->join('subjects', 'subjects.id', '=', 'marks.subject_id')
            ->join('exam_types', 'exam_types.id', '=', 'marks.examtype_id')
            ->select('marks.subject_id', 'marks.examtype_id', 'staff.sf_name', 'marks.staff_id', 'marks.class_id', 'marks.id as markid', 'marks.exam_year', 'marks.exam_month', 'marks.exam_date', 'class_sections.c_class', 'subjects.name as subname', 'exam_types.name as exaname')
            ->where('marks.id', $markid)
            ->first();

        if (!empty($markshow)) {
            // Query submarkentries for sub-timetables associated with the current staff timetable
            $result = DB::table('submarkentries')
                ->join('students', 'students.id', '=', 'submarkentries.student_id')
                ->where('mark_id', $markshow->markid)
                ->select('students.s_name', 'submarkentries.mark', 'students.id', 'submarkentries.internal', 'submarkentries.external',)
                ->orderBy('students.s_name', 'asc')
                ->get();
            // Assigning the sub-timetable result to the 'tableview' property of the current staff timetable
            $markshow->tableview = $result;
        }
        return view('marks.edit', compact('subjects', 'Adyear', 'classs', 'exams', 'markshow',));
    }


    public function markupdate(Request $request, $markid)
    {
        try {
            $subjectid = $request->subjectid;
            $exam_typeid = $request->exam_typeid;
            $exam_month = $request->exam_month;

            if ($exam_typeid == '1') {
                // Update the main mark entry
                Studentdailyexam::where('id', $markid)->update([
                    'subject_id' => $subjectid,
                    'examtype_id' => $exam_typeid,
                    'exam_date' => $request->exam_date,
                    'exam_month' => $exam_month,
                ]);

                $student_ids = $request->student_id; // Assuming 'student_id' is an array
                $marks = $request->mark; // Assuming 'mark' is an array
                $internal = $request->internal; // Assuming 'student_id' is an array
                $external = $request->external;
                // Prepare an array to update submarkentries
                $data = [];

                for ($i = 0; $i < count($marks); $i++) {
                    $data[] = [
                        'mark' => $marks[$i],
                        'student_id' => $student_ids[$i],
                        'internal' => $internal[$i],
                        'external' => $external[$i],
                    ];
                }

                // Loop through and update submarkentries
                foreach ($data as $key => $entryData) {
                    Substudentdailyexam::where('mark_id', $markid)
                        ->where('student_id', $entryData['student_id']) // Assuming 'student_id' is unique per mark entry
                        ->update([
                            'internal' => $entryData['internal'],
                            'external' => $entryData['external'],
                            'mark' => $entryData['mark'],
                        ]);
                }

                return redirect()->back()->with('success', 'Marks saved successfully');
            } else {
                // Update the main mark entry
                Marks::where('id', $markid)->update([
                    'subject_id' => $subjectid,
                    'examtype_id' => $exam_typeid,
                    'exam_date' => $request->exam_date,
                    'exam_month' => $exam_month,
                ]);

                $student_ids = $request->student_id; // Assuming 'student_id' is an array
                $marks = $request->mark; // Assuming 'mark' is an array
                $internal = $request->internal; // Assuming 'student_id' is an array
                $external = $request->external;
                // Prepare an array to update submarkentries
                $data = [];

                for ($i = 0; $i < count($marks); $i++) {
                    $data[] = [
                        'mark' => $marks[$i],
                        'student_id' => $student_ids[$i],
                        'internal' => $internal[$i],
                        'external' => $external[$i],
                    ];
                }

                // Loop through and update submarkentries
                foreach ($data as $key => $entryData) {
                    Submarkentry::where('mark_id', $markid)
                        ->where('student_id', $entryData['student_id']) // Assuming 'student_id' is unique per mark entry
                        ->update([
                            'internal' => $entryData['internal'],
                            'external' => $entryData['external'],
                            'mark' => $entryData['mark'],
                        ]);
                }

                return redirect()->back()->with('success', 'Marks saved successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Failed to save marks');
        }
    }
}
