<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudymaterialController extends Controller
{
    public function dailycontent()
    {

        return view('classteacher.dailycontent');
    }

    public function dailycontentfilter(Request $request)
    {
        


        $subject = DB::table('subjects')
            ->where(['status' => 1])
            ->get();

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->format('Y-m-d');

        $id = Auth::user()->id;
        $staff = Staff::where('login_id', $id)->first();
        $olddate = $request->input('olddate');


        if ($staff) {
            $class = DB::table('assignstaffs')
                ->join('subassignstaffs', 'subassignstaffs.as_id', '=', 'assignstaffs.id')
                ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')
                ->select('class_sections.id', 'class_sections.c_class')
                ->where('subassignstaffs.as_staff_id', $staff->id)->get();


            $stafflist = DB::table('staff')
                ->join('users', 'users.id', '=', 'staff.login_id')
                ->where(['staff.sf_status' => 1, 'staff.sf_delete' => 1, 'staff.id' => $staff->id])->select('staff.staff_id', 'staff.sf_name')->get();


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
                    ->where('staffdailycontents.staffid', $staff->id)
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
                    ->where('staffdailycontents.staffid', $staff->id)
                    ->where('staffdailycontents.date', $formattedDate)
                    ->get();
            }
        } else {
            $class = DB::table('class_sections')
                ->where(['c_status' => 1, 'c_delete' => 1])
                ->get();


            $stafflist = DB::table('staff')
                ->join('users', 'users.id', '=', 'staff.login_id')
                ->where(['staff.sf_status' => 1, 'staff.sf_delete' => 1])->select('staff.staff_id', 'staff.sf_name')->get();

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
                    // ->where('staffdailycontents.staffid', $staff->id)
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
                    // ->where('staffdailycontents.staffid', $staff->id)
                    ->where('staffdailycontents.date', $formattedDate)
                    ->get();
            }
        }


        return view('classteacher.dailycontent', compact('class', 'subject', 'contentview', 'stafflist'));
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

            // Retrieve data from the request
            $date = $request->input('date');
            $classId = $request->input('classid');
            $subject = $request->input('subjectid');
            $title = $request->input('title');
            $staffid = $request->input('staffid');

            // Check if a staff member was found
            if (!$staffid) {
                return redirect()->back()->with('failed', 'Staff member not found');
            }



            // Check if a file is uploaded
            if ($request->hasFile('content')) {
                $contentFile = $request->file('content');
                $contentStore = date('Ymd_His') . '_' . $subject . '.' . $contentFile->getClientOriginalExtension();
                $contentPath = $contentFile->move('Daily/content', $contentStore);
            } else {
                // Handle the case where no file is uploaded
                return redirect()->back()->with('failed', 'No file uploaded');
            }

            // if(){

            // }

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

            // Redirect with a success message
            return redirect()->back()->with('success', 'Saved successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not saved');
        }
    }

    public function dailycontentview($viewid)
    {
        $id = Auth::user()->id;
        $staff = Staff::where('login_id', $id)->first();

        $contentshow = DB::table('staffdailycontents')
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
            ->where('staffdailycontents.staffid', $staff->id)
            ->where('staffdailycontents.id', $viewid)
            ->first();
        return view('classteacher.dailycontentview', compact('contentshow'));
    }

    public function homework()
    {
        return view('classteacher.homework');
    }
    public function homeworkfilter(Request $request)
    {

        $id = Auth::user()->id;

        $staff = Staff::where('login_id', $id)->first();



        $subject = DB::table('subjects')
            ->where(['status' => 1])
            ->get();

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->format('Y-m-d');

        $olddate = $request->input('olddate');


        if ($staff) {
            $class = DB::table('assignstaffs')
                ->join('subassignstaffs', 'subassignstaffs.as_id', '=', 'assignstaffs.id')
                ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')
                ->select('class_sections.id', 'class_sections.c_class')
                ->where('subassignstaffs.as_staff_id', $staff->id)->get();

            $stafflist = DB::table('staff')
                ->join('users', 'users.id', '=', 'staff.login_id')
                ->where(['staff.sf_status' => 1, 'staff.sf_delete' => 1, 'staff.id' => $staff->id])->select('staff.staff_id', 'staff.sf_name')->get();


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
                    ->where('homework.hw_staffid', $staff->id)
                    ->where('homework.hw_date', $olddate)
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
                    ->where('homework.hw_staffid', $staff->id)
                    ->where('homework.hw_date', $formattedDate)
                    ->get();
            }
        } else {
            $class = DB::table('class_sections')
                ->where(['c_status' => 1, 'c_delete' => 1])
                ->get();

            $stafflist = DB::table('staff')
                ->join('users', 'users.id', '=', 'staff.login_id')
                ->where(['staff.sf_status' => 1, 'staff.sf_delete' => 1])->select('staff.staff_id', 'staff.sf_name')->get();


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
                    // ->where('homework.hw_staffid', $staff->id)
                    ->where('homework.hw_date', $olddate)
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
                    // ->where('homework.hw_staffid', $staff->id)
                    ->where('homework.hw_date', $formattedDate)
                    ->get();
            }
        }
        // dd($homeworkview);
        return view('classteacher.homework', compact('class', 'subject', 'homeworkview','stafflist'));
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

            if (!$staffid) {
                return redirect()->back()->with('failed', 'Staff member not found');
            }

            // Retrieve data from the request
          

            // Check if a file is uploaded
            if ($request->hasFile('content')) {
                $contentFile = $request->file('content');
                $contentStore = date('Ymd_His') . '_' . $subject . '.' . $contentFile->getClientOriginalExtension();
                $contentPath = $contentFile->move('Daily/content', $contentStore);
            } else {
                // Handle the case where no file is uploaded
                return redirect()->back()->with('failed', 'No file uploaded');
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

            // Redirect with a success message
            return redirect()->back()->with('success', 'Saved successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not saved');
        }
    }
}
