<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Marks;
use App\Models\Staff;
use App\Models\Student;
use App\Models\messages;
use App\Models\subjects;
use App\Models\ExamTypes;
use App\Models\Assignstaff;
use App\Models\Submarkentry;
use Illuminate\Http\Request;
use App\Models\Class_section;
use Illuminate\Support\Carbon;
use App\Models\Staffattandance;
use App\Models\Studentdailyexam;
use App\Models\Studentattendance;
use Illuminate\Support\Facades\DB;
use App\Models\Substudentdailyexam;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClassteacherController extends Controller
{

    public function classteacherlogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response(['errors' => $validator->errors()->all()]);
            }

            $email = $request->input('email');
            $password = $request->input('password');

            // Retrieve the user from the database based on the email
            $staff = User::where(['email' => $email, 'type' => 2, 'status' => 1])->first();

            if (!$staff) {
                // User not found
                return response()->json([
                    'status' => false,
                    'message' => 'User not found',
                ], 401);
            }

            // Check if the provided password matches the stored hashed password
            if (Hash::check($password, $staff->password)) {
                // Passwords match, user is a class teacher and is active
                $staffdetails = Staff::where(['login_id' => $staff->id, 'sf_status' => 1, 'sf_delete' => 1])->select('id', 'sf_name', 'sf_email')->first();

                $classteacherget = Class_section::where(['c_teacherid' => $staffdetails->id])->select('id as class_id', 'c_class')->first();

                $gh = $classteacherget ? true : false;
                $class_id = $classteacherget ? $classteacherget->class_id : null;
                $class_name = $classteacherget ? $classteacherget->c_class : null;

                return response()->json(['staff_details' => $staffdetails, 'class_id' => $class_id, 'class_name' => $class_name, 'is_class_teacher' => $gh]);
            } else {
                // Details don't match, return an error response
                return response()->json([
                    'status' => false,
                    'message' => 'Details do not match',
                ], 401);
            }
        } catch (\Exception $e) {
            // Handle other exceptions if needed
            return response()->json([
                'status' => false,
                'message' => 'An error occurred',
            ], 500);
        }
    }

    public function classteacherdetails(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'staffid' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()], 422);
            }

            $staffid = $request->input('staffid');

            $staffdetails = DB::table('staff')
                ->select('staff.*')
                ->where(['staff.staff_id' => $staffid, 'staff.sf_status' => 1, 'staff.sf_delete' => 1])
                ->first();

            $class =  DB::table('class_sections')
                ->select('class_sections.id as class_id', 'class_sections.c_class')
                ->where(['class_sections.c_teacherid' => $staffid])
                ->first();

            if (!$staffdetails) {
                return response()->json(['message' => 'Staff not found'], 404);
            }

            // Merge staff details and class details into a single object
            // $mergedObject = (object) array_merge((array) $staffdetails, ['class' => $class]);

            return response()->json($staffdetails);
        } catch (\Exception $e) {
            // Handle other exceptions if needed
            return response()->json([
                'status' => false,
                'message' => 'An error occurred',
            ], 500);
        }
    }

    public function dailycontentadd(Request $request)
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
            $currentDate = Carbon::now();
            $date = $currentDate->format('Y-m-d');
            // Retrieve data from the request
            // $date = $request->input('date');
            $classId = $request->input('classid');
            $subject = $request->input('subjectid');
            $title = $request->input('title');
            $staffid = $request->input('staffid');



            // Check if a file is uploaded
            if ($request->hasFile('content')) {
                $contentFile = $request->file('content');
                $contentStore = date('Ymd_His') . '_' . $subject . '.' . $contentFile->getClientOriginalExtension();
                $contentPath = $contentFile->move('Daily/content', $contentStore);
            } else {

                return response()->json([
                    'status' => false,
                    'message' => 'No file uploaded',
                ]);
            }


            // Insert the daily content record into the database
            DB::table('staffdailycontents')->insert([
                'staffid' => $staffid, // Use the staff ID obtained earlier
                'date' => $date,
                'classid' => $classId,
                'subjectid' => $subject,
                'title' => $title,
                'content' => $contentStore,
                'content_path' => $contentPath,
                'acd_year' => $fyear,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred',
            ], 500);
        }
    }

    public function class_subject(Request $request)
    {
        try {
            $staffid = $request->input('staffid');

            $class = DB::table('assignstaffs')
                ->join('subassignstaffs', 'subassignstaffs.as_id', '=', 'assignstaffs.id')
                ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')
                ->select('class_sections.id', 'class_sections.c_class')
                ->where('subassignstaffs.as_staff_id', $staffid)->get();

            $subject = DB::table('subjects')->select('id', 'name')
                ->where(['status' => 1])
                ->get();

            return response()->json(
                ['class' => $class, 'subject' => $subject,]
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred',
            ], 500);
        }
    }


    public function dailycontentfilter(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'staffid' => 'required',

            ]);

            if ($validator->fails()) {
                return response(['errors' => $validator->errors()->all()]);
            }
            $currentDate = Carbon::now();
            $formattedDate = $currentDate->format('Y-m-d');

            $staffid = $request->input('staffid');
            $olddate = $request->input('olddate');

            $class = DB::table('assignstaffs')
                ->join('subassignstaffs', 'subassignstaffs.as_id', '=', 'assignstaffs.id')
                ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')
                ->select('class_sections.id', 'class_sections.c_class')
                ->where('subassignstaffs.as_staff_id', $staffid)->get();




            if ($olddate) {
                $contentview = DB::table('staffdailycontents')
                    ->join('subjects', 'subjects.id', '=', 'staffdailycontents.subjectid')
                    ->join('class_sections', 'class_sections.id', '=', 'staffdailycontents.classid')
                    ->select(
                        'class_sections.c_class',
                        'subjects.name',
                        'staffdailycontents.staffid',
                        'staffdailycontents.date',
                        'staffdailycontents.title',
                        'staffdailycontents.content_path',
                        'staffdailycontents.id'
                    )
                    ->where('staffdailycontents.staffid', $staffid)
                    ->where('staffdailycontents.date', $olddate)
                    ->get();
            } else {
                $contentview = DB::table('staffdailycontents')
                    ->join('subjects', 'subjects.id', '=', 'staffdailycontents.subjectid')
                    ->join('class_sections', 'class_sections.id', '=', 'staffdailycontents.classid')
                    ->select(
                        'class_sections.c_class',
                        'subjects.name',
                        'staffdailycontents.staffid',
                        'staffdailycontents.date',
                        'staffdailycontents.title',
                        'staffdailycontents.content_path',
                        'staffdailycontents.id'
                    )
                    ->where('staffdailycontents.staffid', $staffid)
                    ->where('staffdailycontents.date', $formattedDate)
                    ->get();
            }

            return response()->json(
                $contentview
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred',
            ], 500);
        }
    }

    public function homeworkadd(Request $request)
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

            $currentDate = Carbon::now();
            $formattedDate = $currentDate->format('Y-m-d');
            // Get the ID of the currently authenticated user
            $date = $formattedDate;
            $classId = $request->input('classid');
            $subject = $request->input('subjectid');
            $title = $request->input('title');
            $staffid = $request->input('staffid');
            $contentFile = $request->file('content');

            if ($request->hasFile('content')) {
                $contentFile = $request->file('content');
                $contentStore = date('Ymd_His') . '_' . $subject . '.' . $contentFile->getClientOriginalExtension();
                $contentPath = $contentFile->move('Daily/content', $contentStore);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'No file uploaded',
                ]);
            }

            // Insert the daily content record into the database
            DB::table('homework')->insert([
                'hw_staffid' => $staffid, // Use the staff ID obtained earlier
                'hw_date' => $date,
                'hw_classid' => $classId,
                'hw_subjectid' => $subject,
                'hw_title' => $title,
                'hw_content' => $contentStore,
                'hw_content_path' => $contentPath,
                'acd_year' => $fyear,
            ]);

            return response()->json([

                'status' => true,
                'message' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred',
            ], 500);
        }
    }

    public function homeworkfilter(Request $request)
    {
        try {
            $currentDate = Carbon::now();
            $formattedDate = $currentDate->format('Y-m-d');

            $olddate = $request->input('olddate');
            $staffid = $request->input('staffid');
            $class_id = $request->input('class_id');


            if ($olddate) {
                $homeworkview = DB::table('homework')
                    ->join('subjects', 'subjects.id', '=', 'homework.hw_subjectid')
                    ->join('class_sections', 'class_sections.id', '=', 'homework.hw_classid')
                    ->select(
                        'class_sections.c_class',
                        'subjects.name',
                        'homework.hw_staffid',
                        'homework.hw_date',
                        'homework.hw_title',
                        'homework.hw_content_path',
                        'homework.id'
                    )
                    ->where('homework.hw_staffid', $staffid)
                    ->where('homework.hw_date', $olddate)
                    ->get();
            } elseif ($class_id) {
                $homeworkview = DB::table('homework')
                    ->join('subjects', 'subjects.id', '=', 'homework.hw_subjectid')
                    ->join('class_sections', 'class_sections.id', '=', 'homework.hw_classid')
                    ->select(
                        'class_sections.c_class',
                        'subjects.name',
                        'homework.hw_staffid',
                        'homework.hw_date',
                        'homework.hw_title',
                        'homework.hw_content_path',
                        'homework.id'
                    )
                    ->where('homework.hw_staffid', $staffid)
                    ->where('homework.hw_classid', $class_id)
                    // ->where('homework.hw_date', $olddate)
                    ->get();
            } else {
                $homeworkview = DB::table('homework')
                    ->join('subjects', 'subjects.id', '=', 'homework.hw_subjectid')
                    ->join('class_sections', 'class_sections.id', '=', 'homework.hw_classid')
                    ->select(
                        'class_sections.c_class',
                        'subjects.name',
                        'homework.hw_staffid',
                        'homework.hw_date',
                        'homework.hw_title',
                        'homework.hw_content_path',
                        'homework.id'
                    )
                    ->where('homework.hw_staffid', $staffid)
                    ->where('homework.hw_date', $formattedDate)
                    ->get();
            }


            return response()->json(
                $homeworkview
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred',
            ], 500);
        }
    }


    public function classteacherdailytimetable(Request $request)
    {
        try {
            $staffId = $request->input('staffid');

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

            $timetableView = DB::table('stafftimetables')
                ->join('staff', 'staff.id', '=', 'stafftimetables.staff_id')
                ->select('staff.sf_name', 'stafftimetables.id as timetable_id',)
                ->where('staff.id', $staffId)
                ->get();

            $response = [
                'staffid' => $staffId,
                'days' => [],
                'fyear' => $fyear,
                'classtime' => $classtime,
                'success' => true,
            ];

            // Checking if staff timetables were retrieved successfully
            if (!empty($timetableView)) {
                foreach ($timetableView as $key => $requested) {
                    // Querying substafftimetables for sub-timetables associated with the current staff timetable
                    $result = DB::table('substafftimetables')
                        ->join('days', 'days.id', '=', 'substafftimetables.day_id')
                        ->where('tt_id', $requested->timetable_id)
                        ->select(
                            'days.id as day_id',
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

                    // Grouping by day
                    $groupedResult = $result->groupBy('day_id');

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

                        $response['days'][] = $day;
                    }
                }
            }

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred',
            ], 500);
        }
    }



    public function studenttimetable(Request $request)
    {
        try {
            $staffId = $request->input('staffid');
            // $studentId = $request->input('s_admissionno');
            // $getid = Student::where(['s_admissionno' => $studentId, 'students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->first();

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
                ->select('c_class', 'id')
                ->where('class_sections.c_teacherid', $staffId)
                ->first();
            $classid = $classname->id;
            $class = $classname->c_class;

            $timetableView = DB::table('classtimetables')
                ->join('class_sections', 'class_sections.id', '=', 'classtimetables.class_id')
                ->select('class_sections.id as section_id', 'class_sections.c_class', 'classtimetables.id as timetable_id', 'classtimetables.class_id')
                ->where('classtimetables.class_id', $classid)
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


    public function myattendancefilter(Request $request)
    {
        try {
            $monthid = $request->input('monthid');
            $staffid = $request->input('staffid');

            $month = date('m');
            $year = date('Y');
            $shortYear = date('y');

            if ($month >= "06") {
                $fyear = $year . '-' . ($shortYear + 1);
            } else {
                $fyear = ($year - 1) . '-' . $shortYear;
            }
            $MONTH = now()->format('Y-m');

            // $monthview = Staffattandance::where('att_year', $fyear)->select('att_month')->distinct()
            //     ->orderBy('att_month', 'desc')
            //     ->get();


            $attendanceRecords = null;
            $pr = 0;
            $Ab = 0;

            if ($monthid) {


                $attendanceRecords = Staffattandance::where(['staff_id' =>  $staffid, 'att_month' => $monthid])->select('staff_id', 'att_id', 'permission', 'att_year', 'att_date', 'att_month')->orderBy('att_date', 'asc')->get();

                $pr = Staffattandance::where(['staff_id' =>  $staffid, 'att_month' => $monthid, 'att_id' => 1])->count();
                $Ab = Staffattandance::where(['staff_id' =>  $staffid, 'att_month' => $monthid, 'att_id' => 2])->count();
                $total_days = $pr + $Ab;
                $monthview = $monthid;
            } else {
                $attendanceRecords = Staffattandance::where(['staff_id' =>  $staffid, 'att_month' => $MONTH])->select('staff_id', 'att_id', 'permission', 'att_year', 'att_date', 'att_month')->orderBy('att_date', 'asc')->get();

                $pr = Staffattandance::where(['staff_id' =>  $staffid, 'att_month' => $MONTH, 'att_id' => 1])->count();
                $Ab = Staffattandance::where(['staff_id' =>  $staffid, 'att_month' => $MONTH, 'att_id' => 2])->count();
                $total_days = $pr + $Ab;
                $monthview = $MONTH;
            }

            return response()->json(
                [
                    'monthview' => $monthview,
                    'attendanceRecords' => $attendanceRecords,
                    'Totaldays' => $total_days,
                    'present' => $pr,
                    'absent' => $Ab
                ]

            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred',
            ], 500);
        }
    }

    public function markadd(Request $request)
    {
        try {
            // Calculate the academic year
            $month = date('m');
            $year = date('Y');
            $shortYear = date('y');
            $fyear = ($month >= "06") ? $year . '-' . ($shortYear + 1) : ($year - 1) . '-' . $shortYear;

            // Extract request data
            $class_id = $request->class_id;
            $subject_id = $request->subject_id;
            $staff_id = $request->staff_id;
            $exam_type_id = $request->examtype_id;
            $exam_date = $request->exam_date;
            $exam_month = Carbon::parse($exam_date)->format('Y-m');

            if ($exam_type_id == '1') {
                // Check if the exam record already exists
                $checkExam = Studentdailyexam::where([
                    'class_id' => $class_id,
                    'staff_id' => $staff_id,
                    'subject_id' => $subject_id,
                    'examtype_id' => $exam_type_id,
                    'exam_date' => $exam_date,
                    'exam_year' => $fyear
                ])->first();

                if ($checkExam) {
                    return response()->json(['success' => false, 'message' => 'Marks have already been recorded for this exam'], 400);
                } else {
                    // Insert the exam record
                    $mark = new Studentdailyexam;
                    $mark->class_id = $class_id;
                    $mark->staff_id = $staff_id;
                    $mark->subject_id = $subject_id;
                    $mark->examtype_id = $exam_type_id;
                    $mark->exam_month = $exam_month;
                    $mark->exam_date = $exam_date;
                    $mark->exam_year = $fyear;
                    $mark->save();

                    // Extract mark data from the request

                    // Extract mark data from the request
                    $markLists = $request->input('markLists');

                    // Prepare data for bulk insert
                    $data = [];
                    foreach ($markLists as $markData) {
                        $data[] = [
                            'mark_id' => $mark->id,
                            'mark' => $markData['mark'],
                            'subject_id' => $subject_id,
                            'internal' => $markData['internal'],
                            'external' => $markData['external'],
                            'student_id' => $markData['student_id'],
                            'exammonth_id' => $exam_month,
                            // 'exam_date' => $exam_date
                        ];
                    }

                    // Bulk insert the mark entries
                    DB::table('substudentdailyexams')->insert($data);

                    return response()->json(['data' => $data, 'success' => true, 'message' => 'Daily Marks saved successfully'], 201);
                }
            } else {
                // Check if the exam record already exists
                $checkExam = Marks::where([
                    'class_id' => $class_id,
                    'staff_id' => $staff_id,
                    'subject_id' => $subject_id,
                    'examtype_id' => $exam_type_id,
                    'exam_month' => $exam_month,
                    'exam_year' => $fyear
                ])->first();

                if ($checkExam) {
                    return response()->json(['success' => false, 'message' => 'Marks have already been recorded for this exam'], 400);
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
                    $markLists = $request->input('markLists');

                    // Prepare data for bulk insert
                    $data = [];
                    foreach ($markLists as $markData) {
                        $data[] = [
                            'mark_id' => $mark->id,
                            'mark' => $markData['mark'],
                            'subject_id' => $subject_id,
                            'internal' => $markData['internal'],
                            'external' => $markData['external'],
                            'student_id' => $markData['student_id'],
                            'exammonth_id' => $exam_month
                            // 'exam_date' => $exam_date
                        ];
                    }

                    // Bulk insert the mark entries
                    DB::table('submarkentries')->insert($data);

                    return response()->json(['data' => $data, 'success' => true, 'message' => 'Daily Marks saved successfully'], 201);
                }
            }
        } catch (\Exception $e) {
            // Log the error for further investigation
            return response()->json([
                'success' => false,
                'message' => 'Failed to save marks',
                'error' => $e->getMessage(), // Include the exception message
            ], 500);
        }
    }

    public function markshowfilter(Request $request)
    {
        $staffid = $request->input('staff_id');

        $staff = Staff::join('subjects', 'subjects.name', '=', 'staff.sf_subject_taken')
            ->select('subjects.id as subject_id')
            ->where('staff_id', $staffid)->first();
        // if ($staff) {

        //     $classs = DB::table('assignstaffs')
        //         ->join('subassignstaffs', 'subassignstaffs.as_id', '=', 'assignstaffs.id')
        //         ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')
        //         ->select('class_sections.id', 'class_sections.c_class')
        //         ->where('subassignstaffs.as_staff_id', $staff->id)->get();

        //     $staffslist = Staff::where(['sf_delete' => 1, 'id' => $staff->id])
        //         ->whereNotNull('login_id')
        //         ->select('id', 'sf_name') // Use whereNotNull to check for a non-null value
        //         ->orderBy('sf_name', 'ASC')
        //         ->get();
        // } else {

        //     $staffslist = Staff::where(['sf_delete' => 1,])
        //         ->whereNotNull('login_id')
        //         ->select('id', 'sf_name') // Use whereNotNull to check for a non-null value
        //         ->orderBy('sf_name', 'ASC')
        //         ->get();

        //     $classs =  DB::table('class_sections')
        //         ->select('class_sections.id', 'class_sections.c_class')
        //         ->get();
        // }
        $subject = $staff->subject_id;


        $subjectid = $subject;
        $adyear = $request->input('adyear');
        $classid = $request->input('class_id');
        $examid = $request->input('examtype_id');
        $examdate = $request->input('exam_date');

        // return response($students);
        // $subjects = subjects::where((['status' => 1]))->orderBy('name', 'ASC')->get();


        // $exams = ExamTypes::where((['status' => 1]))->get();

        // $Adyear = Marks::where('status', 1)
        //     ->select('exam_year')
        //     ->distinct()
        //     ->get();

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
                    'studentdailyexams.exam_month' => $examdate
                ])
                ->orderBy('studentdailyexams.exam_date', 'desc')
                ->get();

            if (!empty($markshow)) {
                foreach ($markshow as $key => $requested) {
                    // Querying substafftimetables for sub-timetables associated with the current staff timetable
                    $result = DB::table('substudentdailyexams')
                        ->join('students', 'students.id', '=', 'substudentdailyexams.student_id')
                        ->where('mark_id', $requested->markid)
                        ->select('s_name', 'mark', 'internal', 'external')
                        ->orderBy('s_name', 'desc')
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
                    'marks.exam_year' => $adyear,
                    'marks.exam_month' => $examdate
                ])
                ->get();


            if (!empty($markshow)) {
                foreach ($markshow as $key => $requested) {
                    // Querying substafftimetables for sub-timetables associated with the current staff timetable
                    $result = DB::table('submarkentries')
                        ->join('students', 'students.id', '=', 'submarkentries.student_id')
                        ->where('mark_id', $requested->markid)
                        ->select('s_name', 'mark', 'internal', 'external')
                        ->orderBy('s_name', 'desc')
                        ->get();

                    // Assigning the sub-timetable result to the 'tableview' property of the current staff timetable
                    $markshow[$key]->tableview = $result;
                }
            }
        }

        return response()->json([

            // 'subjects' => $subject,
            // 'Adyear' => $Adyear,
            // 'classs' => $classs,
            // 'exams' => $exams,
            'markshow' => $markshow,
            // 'staffslist' => $staffslist,
        ]);
        // dd($markshow);
        // return view('marks.show', compact('subjects', 'Adyear', 'classs', 'exams', 'markshow', 'staffslist'));
    }



    public function staffclass(Request $request)
    {


        try {
            $staffId = $request->input('staffid');

            $result = DB::table('subassignstaffs')
                ->join('staff', 'staff.id', '=', 'subassignstaffs.as_staff_id')
                ->join('assignstaffs', 'assignstaffs.as_class_id', '=', 'subassignstaffs.as_id')
                ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')
                ->join('subjects', 'subjects.name', '=', 'staff.sf_subject_taken')
                ->leftJoin('students', 'students.s_classid', '=', 'class_sections.id')
                ->where('subassignstaffs.as_staff_id', $staffId)
                ->select(
                    'staff.sf_name',
                    'staff.staff_id',
                    'class_sections.c_class',
                    'class_sections.id as class_id',
                    'staff.sf_subject_taken',
                    'subjects.id as sub_id',
                    'students.s_name',
                    'students.id as stud_id',

                )
                ->get();

            // Group the results by class_id
            $groupedResults = $result->groupBy('class_id');

            // Transform the result to have a simpler structure
            // $finalResult = [];
            foreach ($groupedResults as $classId => $classData) {
                $classInfo = $classData->first(); // Take the first row for class information
                $students = [];

                foreach ($classData->pluck('s_name', 'stud_id') as $studId => $studentName) {
                    $students[] = [
                        'student_id' => $studId,
                        'name' => $studentName,
                    ];
                }

                $finalResult[] = [
                    'class_id' => $classId,
                    'class_name' => $classInfo->c_class,
                    'staff_name' => $classInfo->sf_name,
                    'staff_id' => $classInfo->staff_id,
                    'subject_id' => $classInfo->sub_id,
                    'subject_taken' => $classInfo->sf_subject_taken,
                    'students' => $students,
                ];
            }

            return response()->json(
                $finalResult
            );
        } catch (\Exception $e) {
            // Log the error for further investigation


            return response()->json(['success' => false, 'message' => 'Failed']);
        }
    }
    public function examtype()
    {
        try {
            $examtypes = ExamTypes::select('id', 'name')->get();
            return response()->json([
                'Examtype' =>  $examtypes
            ]);
        } catch (\Exception $e) {
            // Log the error for further investigation


            return response()->json(['success' => false, 'message' => 'Failed']);
        }
    }
    public function attendanceinsert(Request $request)
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
            $CLASSID = $request->input('class_id');

            $checkatt = Studentattendance::where(['stud_date' => $DATE, 'stud_classid' => $CLASSID])->first();
            if ($checkatt) {
                return response()->json(['success' => false, 'message' => 'Already Took Attendance'], 400);
            } else {
                $attendanceLists = $request->input('attendanceLists');

                // Validate the presence of required fields
                $validator = Validator::make($request->all(), [
                    'attendanceLists' => 'required|array|min:1',
                ]);

                // Check if the validation fails
                if ($validator->fails()) {
                    return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
                }

                $savearray = [];

                foreach ($attendanceLists as $attendanceData) {
                    $savearray[] = [
                        'studentclass' => $CLASSID,
                        'student_id' => $attendanceData['student_id'],
                        'attendance' => $attendanceData['attendance'],
                    ];
                }

                try {
                    foreach ($savearray as $data) {
                        Studentattendance::insert([
                            'stud_id' => $data['student_id'],
                            'stud_classid' => $data['studentclass'],
                            'stud_attid' => $data['attendance'],
                            'stud_year' => $fyear,
                            'stud_date' => $DATE,
                            'stud_month' => now()->format('Y-m'),
                        ]);
                    }

                    return response()->json([
                        'success' => true,
                        'message' => 'Attendance Saved Successfully',
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unable to Save Attendance',
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error occurred',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function monthattendancefilter(Request $request)
    {

        try {
            $staff = Staff::where('staff_id', $request->staffid)->first();

            // Check if staff exists
            if ($staff) {
                $class = Class_section::where(['c_status' => 1, 'c_delete' => 1, 'c_teacherid' => $staff->staff_id])->first();
            } else {
                $class = Class_section::where(['c_status' => 1, 'c_delete' => 1])->first();
            }

            $month = date('m');
            $year = date('Y');
            $shortYear = date('y');

            // Determine the academic year
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
            }

            // Get the class ID
            $classid = $class ? $class->id : null;

            // Corrected date format for month
            $MONTH = now()->format('Y-m');

            // Query to retrieve student attendance data
            $studentatt = DB::table('studentattendances')
                ->join('students', 'students.id', '=', 'studentattendances.stud_id')
                ->select('students.s_name as student_name', 'students.id as student_id', 'studentattendances.stud_attid')
                ->where(['students.s_delete' => 1, 'students.s_classid' => $classid, 'studentattendances.stud_year' => $fyear])
                ->where('studentattendances.stud_date', $request->date)
                ->get();

            // Organize student attendance data into the $attendanceData array
            $attendanceData = [];

            foreach ($studentatt as $student) {
                $attendanceData[] = [
                    'student_name' => $student->student_name,
                    'student_id' => $student->student_id,
                    'att_id' => $student->stud_attid,
                ];
            }

            return response()->json([
                'class_name' => $class->c_class,
                'class_id' => $classid,
                'date' => $request->date,
                'student_list' => $attendanceData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error occurred',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function dashboardattendance(Request $request)
    {
       
        try {
            $staff = Staff::where('staff_id', $request->staffid)->first();
        
            // Check if staff exists
            if (!$staff) {
                return response()->json([
                    'success' => false,
                    'message' => 'Staff not found'
                ]);
            }
        
            // Determine the academic year
            $month = date('m');
            $year = date('Y');
            $shortYear = date('y');
            $fyear = ($month >= "06") ? ($year . '-' . ($shortYear + 1)) : (($year - 1) . '-' . $shortYear);
        
            // Get all classes assigned to the staff
            $staffAssignments = Assignstaff::
               join('subassignstaffs', 'subassignstaffs.as_id', '=', 'assignstaffs.id')
                ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')
                ->select('class_sections.id as class_id', 'class_sections.c_class as class_name')
               ->where('subassignstaffs.as_staff_id', $staff->staff_id)
                ->get();
        
            $attendanceData = [];
        
            // Iterate over each class assigned to the staff
            foreach ($staffAssignments as $assignment) {
                $classId = $assignment->class_id;
                $className = $assignment->class_name;
        
                // Get today's attendance for the class
                $todayAttendance = StudentAttendance::where('stud_classid', $classId)
                    ->where('stud_date', now()->format('Y-m-d'))
                    ->get();
        
                // Calculate present and absent counts
                $presentCount = $todayAttendance->where('stud_attid', 1)->count();
                $absentCount = $todayAttendance->where('stud_attid', 2)->count();
                $totalStudents = Student::where('s_classid', $classId)->count();
        
                // Add class attendance data to the response
                $attendanceData[] = [
                    'class_name' => $className,
                    'present_count' => $presentCount,
                    'absent_count' => $absentCount,
                    'total_students' => $totalStudents
                ];
            }
        
            return response()->json([
                'success' => true,
                'attendanceData' => $attendanceData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error occurred',
                'error' => $e->getMessage()
            ], 400);
        }
                     
    }

    public function messagestore(Request $request)
    {
        $stafflogId = $request->input('sender_staff');
        $getstaffid = Staff::where('staff_id', $stafflogId)
            ->where(['sf_status' => 1, 'sf_delete' => 1])
            ->first();
        $senderstaffId = $getstaffid->login_id;


        $staffId = $request->input('receiver_staff');
        if ($staffId != '') {
            $getstafid = Staff::where('staff_id', $staffId)
                ->where(['sf_status' => 1, 'sf_delete' => 1])
                ->first();
            $receiverstaffId = $getstafid->login_id;
        } else {
            $receiverstaffId = NULL;
        }
        $post = new messages;

        // $post->sender_admin = $request->sender_admin;
        $post->sender_staff = $senderstaffId;
        // $post->sender_student = $studentId;
        $post->receiver_admin = $request->receiver_admin;
        $post->receiver_staff = $receiverstaffId;
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
        // $studentlogId = $request->input('student_id');
        // $getid = Student::where('s_admissionno', $studentlogId)
        //     ->where(['students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])
        //     ->first();

        // $studentId = $getid->id;
        $stafflogId = $request->input('staffId');
        $getstaffid = Staff::where('staff_id', $stafflogId)
            ->where(['sf_status' => 1, 'sf_delete' => 1])
            ->first();
        $staffId = $getstaffid->login_id;
        // $studentId = 1;
        // $staffId = 1;

        $send = DB::table('messages')
            ->leftJoin('staff as sender', 'sender.login_id', '=', 'messages.sender_staff')
            ->leftJoin('staff as receiver', 'receiver.login_id', '=', 'messages.receiver_staff')
            ->leftJoin('students', 'students.id', '=', 'messages.receiver_student')
            ->where(function ($query) use ($staffId) {
                $query->where('messages.sender_staff', $staffId);
            })
            ->select(
                'messages.id',
                'messages.subject',
                'messages.message',
                DB::raw("DATE_FORMAT(STR_TO_DATE(messages.datetime, '%a, %b %d, %Y %h:%i %p'), '%d/%m/%Y ') date"),
                DB::raw("DATE_FORMAT(STR_TO_DATE(messages.datetime, '%a, %b %d, %Y %h:%i %p'), '%h:%i %p') time"),
                'sender.sf_name as sender_staff_name',
                'sender.sf_image_path as sender_image',
                'receiver.sf_name as receiver_staff_name',
                'receiver.sf_image_path as receiver_staff_image',
                'students.s_name as receiver_student_name',
                'students.image_path as receiver_student_image',
                DB::raw("
            CASE
                WHEN messages.receiver_staff IS NOT NULL THEN 'staff'
                WHEN messages.receiver_student IS NOT NULL THEN 'student'
                ELSE 'unknown'
            END as receiver_status
        ")
            )
            ->orderBy('messages.id', 'DESC')
            ->get();


        $inbox = DB::table('messages')
            ->leftJoin('staff as sender', 'sender.login_id', '=', 'messages.sender_staff')
            ->leftJoin('staff as receiver', 'receiver.login_id', '=', 'messages.receiver_staff')
            ->leftJoin('students', 'students.id', '=', 'messages.sender_student')
            ->leftJoin('users as senderadmin', 'senderadmin.id', '=', 'messages.sender_admin')
            ->where(function ($query) use ($staffId) {
                $query->where('messages.receiver_staff', $staffId);
            })
            ->select(
                'messages.id',
                'messages.subject',
                'messages.message',
                DB::raw("DATE_FORMAT(STR_TO_DATE(messages.datetime, '%a, %b %d, %Y %h:%i %p'), '%d/%m/%Y ') date"),
                DB::raw("DATE_FORMAT(STR_TO_DATE(messages.datetime, '%a, %b %d, %Y %h:%i %p'), '%h:%i %p') time"),
                'sender.sf_name as sender_staff_name',
                'sender.sf_image_path as sender_staff_image',
                'senderadmin.name as sender_admin_name',
                'receiver.sf_name as receiver_staff_name',
                'receiver.sf_image_path as _staff_image',
                'students.s_name as sender_student_name',
                'students.image_path as sender_student_image',
                DB::raw("
        CASE
            WHEN messages.sender_staff IS NOT NULL THEN 'staff'
            WHEN messages.sender_student IS NOT NULL THEN 'student'
            ELSE 'admin'
        END as sender_status
    ")
            )
            ->orderBy('messages.id', 'DESC')
            ->get();



        return response()->json([
            // 'studentlogId' => $studentlogId,
            // 'studentId' => $studentId,
            // 'staffId' => $staffId,
            'send' => $send,
            'inbox' => $inbox,
            // 'inboxMessagesStaff' => $inboxMessages,
            'success' => true
        ]);
    }
    public function stafflist(Request $request)
    {
        $stafflogId = $request->input('staffId');

        $staff = Staff::where('id', '!=', $stafflogId)
            ->where('sf_position', 1)
            ->where('sf_status', 1)
            ->get();


        return response()->json(['staff' => $staff]);
    }




    public function academicyear()
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

            return response()->json(['academic_year' => $fyear]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unexpected error occurred',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
