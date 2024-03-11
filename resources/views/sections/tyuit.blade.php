<?php

namespace App\Http\Controllers;

use App\Models\Assignstaff;
use Carbon\Carbon;
use App\Models\Day;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Class_section;
use App\Models\Classpromotion;
use App\Models\Classtimetable;
use App\Models\Stafftimetable;
use App\Models\Subassignstaff;
use App\Models\Subclasstimetable;
use App\Models\Substafftimetable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



class ClassController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $stafflist = DB::table('staff')
            ->join('users', 'users.id', '=', 'staff.login_id')
            ->where(['sf_position' => 1, 'sf_status' => 1])
            ->select('staff.id', 'staff.sf_name', 'staff.sf_subject_taken')
            ->get();

        $classdata = DB::table('class_sections')
            // ->join('staff', 'staff.sf_classid', '=', 'class_sections.id')
            ->where(['c_delete' => 1])
            // ->where(['c_status' => 1])
            ->orderBy('id', 'asc')
            ->select('class_sections.id', 'class_sections.c_class', 'class_sections.c_status')
            ->get();
        $classlist = DB::table('class_sections')
            // ->join('staff', 'staff.sf_classid', '=', 'class_sections.id')
            ->where(['c_delete' => 1])
            ->where(['c_status' => 1])
            ->where(['c_teacherid' => NULL])
            ->orderBy('id', 'asc')
            ->select('class_sections.id', 'class_sections.c_class')
            ->get();

        $classstaffdata = DB::table('class_sections')
            ->join('staff', 'staff.id', '=', 'class_sections.c_teacherid')
            ->where(['c_delete' => 1])
            ->where(['c_status' => 1])
            ->orderBy('c_class', 'asc')
            ->select('class_sections.id', 'class_sections.c_class', 'class_sections.c_status', 'staff.sf_name')
            ->get();

        // dd($stafflist);

        return view('sections.class_section', compact('classdata', 'stafflist', 'classstaffdata', 'classlist'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        try {
            // $request->validate([
            //     'section' => 'required'
            // ]);


            $class = $request->input('section');
            $teacher = $request->input('teacher');


            // dd($teacher);



            $checkclass = Class_section::where(['c_class' => $class])->first();

            if ($checkclass) {
                return redirect()->back()->withErrors(['Class Already Exist']);
            } elseif ($teacher == NULL) {
                $class = Class_section::insertGetId(['c_class' => $class]);

                // $staff = Staff::where('id', $teacher)->update(['sf_classid' => $class]);
                return redirect()->back()->with('success', 'class Added successfully');
            } else {
                Class_section::where(['id' => $class])->update(['c_teacherid' => $teacher]);
                // $class = Class_section::insertGetId(['c_class' => $class]);

                // $staff = Staff::where('id', $teacher)->update(['sf_classid' => $class]);
                return redirect()->back()->with('sucess', 'class Staff Added successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Failed');
        }
    }
    /**
     * Display the specified resource.
     */
    public function class($id)
    {
        try {

            $loginstatus = Class_section::where(array('id' => $id))->select('c_status')->first();

            switch ($loginstatus->c_status) {
                case 1:
                    $status = 0;
                    break;
                case 0:
                    $status = 1;
                    break;
                default:

                    break;
            }
            Class_section::where(array('id' => $id))->update(['c_status' => $status]);
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'not change');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function classedit($section)
    {
        $id = $section;
        // return response($id);
        $classdata = DB::table('class_sections')->where('id', $id)->first();
        $staffdata = DB::table('class_sections')
            ->join('staff', 'staff.id', '=', 'class_sections.c_teacherid')
            ->select('class_sections.id as class_id', 'class_sections.c_class', 'class_sections.c_delete', 'staff.sf_name as staffname', 'staff.id as staffid', 'staff.sf_subject_taken')
            ->where('class_sections.id', $id)
            // ->orderBy('class_sections.c_class', 'asc')
            ->first();


        // $staffdata = DB::table('staff')->where('sf_classid', $id)->first();
        $stafflist = DB::table('staff')
            ->join('users', 'users.id', '=', 'staff.login_id')
            ->where(['sf_position' => 1])
            ->select('staff.id', 'staff.sf_name', 'staff.sf_subject_taken')
            ->get();

        // dd($staffdata);
        return view('sections.sectionedit', compact('classdata', 'staffdata', 'stafflist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function classupdate(Request $request, $id)
    {
        try {
            // $old_class_staff_id = $request->old_class_staff;
            // $old_staff = Staff::find($old_class_staff_id);

            // $old_staff->sf_classid = NULL;
            // $old_staff->save();
            $class_id = $request->class_id;
            // dd($class_id);
            $class = $request->class;
            $current_staff = Class_section::find($class_id);
            // dd($current_staff);
            $current_staff->c_class = $class;
            $current_staff->save();
            return redirect()->back()->with('success', 'Update successfull');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'not change');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Class_section $class)
    {
        //
        $id = $class->id;
        return response($id);
        $post = Class_section::find($id);
        return response($post);
        $post->c_delete = "0";
        $post->save();

        return redirect()->back()
            ->with('success', 'Staff deleted successfully');
    }

    public function studenttimetablefilter()
    {
        return view('sections.studenttimetable');
    }


    public function studenttimetable()
    {

        $days = Day::where(['day_status' => 1])->get();

        $timetableView = DB::table('classtimetables')
            ->join('class_sections', 'class_sections.id', '=', 'classtimetables.class_id')
            ->select('class_sections.id as section_id', 'class_sections.c_class', 'classtimetables.id as timetable_id', 'classtimetables.class_id')
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

        return view('sections.studenttimetable', compact('days', 'timetableView'));
    }

    public function studenttimetableinsert(Request $request)
    {
        try {
            $classid = $request->classid;

            $checkclassid = Classtimetable::where('class_id', $classid)->first();

            if ($checkclassid) {
                return redirect()->back()->with('failed', 'Timetable Already Exist');
            } else {
                $classtimetableid = Classtimetable::insertGetId(['class_id' => $classid]);

                $Dayid = $request->dayid;
                $Pre1 = $request->pre1;
                $Pre2 = $request->pre2;
                $Pre3 = $request->pre3;
                $Pre4 = $request->pre4;
                $Pre5 = $request->pre5;
                $Pre6 = $request->pre6;
                $Pre7 = $request->pre7;
                $Pre8 = $request->pre8;
                $studenttimetable = [];

                for ($i = 0; $i < count($Dayid); $i++) {
                    $studenttimetable[] = [
                        'dayid' => $Dayid[$i],
                        'pre1' => $Pre1[$i],
                        'pre2' => $Pre2[$i],
                        'pre3' => $Pre3[$i],
                        'pre4' => $Pre4[$i],
                        'pre5' => $Pre5[$i],
                        'pre6' => $Pre6[$i],
                        'pre7' => $Pre7[$i],
                        'pre8' => $Pre8[$i],
                    ];
                }


                // Save the descriptions to the database
                foreach ($studenttimetable as $data) {
                    Subclasstimetable::insert([
                        'tt_id' => $classtimetableid,
                        'day_id' => $data['dayid'],
                        'pre1' => $data['pre1'],
                        'pre2' => $data['pre2'],
                        'pre3' => $data['pre3'],
                        'pre4' => $data['pre4'],
                        'pre5' => $data['pre5'],
                        'pre6' => $data['pre6'],
                        'pre7' => $data['pre7'],
                        'pre8' => $data['pre8'],
                    ]);
                }

                return redirect()->back()->with('success', 'save successfull');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not save');
        }
    }


    public function studenttimetableedit($id)
    {
        $timetableView = DB::table('classtimetables')
            ->join('class_sections', 'class_sections.id', '=', 'classtimetables.class_id')
            ->where('classtimetables.id', $id) // Use 'classtimetables.id' instead of 'id'
            ->select('classtimetables.id', 'classtimetables.class_id', 'class_sections.c_class')
            ->get();

        if (!$timetableView->isEmpty()) {
            foreach ($timetableView as $key => $requested) {
                $result = DB::table('subclasstimetables')
                    ->join('days', 'days.id', '=', 'subclasstimetables.day_id')
                    ->where('tt_id', $requested->id) // Use 'tt_id' instead of 'id'
                    ->select(
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

                $timetableView[$key]->tableview = $result;
            }
        }

        return view('sections.studenttimetableedit', compact('timetableView'));
    }

    public function studenttimetableupdate(Request $request, $id)
    {

        try {
            $classid = $request->input('classid');
            $classtimetableid = Classtimetable::where('id', $id)->update(['class_id' => $classid]);

            $desc = Subclasstimetable::where('tt_id', $id)
                ->select('id')
                ->pluck('id')
                ->toArray();
            $Pre1 = $request->pre1;
            $Pre2 = $request->pre2;
            $Pre3 = $request->pre3;
            $Pre4 = $request->pre4;
            $Pre5 = $request->pre5;
            $Pre6 = $request->pre6;
            $Pre7 = $request->pre7;
            $Pre8 = $request->pre8;

            $studenttimetable = [];

            // Determine the count of items to loop over
            $itemCount = count($Pre1);

            for ($i = 0; $i < $itemCount; $i++) {
                $studenttimetable[] = [
                    'pre1' => $Pre1[$i],
                    'pre2' => $Pre2[$i],
                    'pre3' => $Pre3[$i],
                    'pre4' => $Pre4[$i],
                    'pre5' => $Pre5[$i],
                    'pre6' => $Pre6[$i],
                    'pre7' => $Pre7[$i],
                    'pre8' => $Pre8[$i],
                ];
            }

            if (!empty($desc)) {
                // Save the descriptions to the database
                foreach ($desc as $key => $desId) {
                    if (array_key_exists($key, $studenttimetable)) {
                        $data = $studenttimetable[$key];

                        Subclasstimetable::where('id', $desId)->update([
                            // This line might be missing
                            'pre1' => $data['pre1'],
                            'pre2' => $data['pre2'],
                            'pre3' => $data['pre3'],
                            'pre4' => $data['pre4'],
                            'pre5' => $data['pre5'],
                            'pre6' => $data['pre6'],
                            'pre7' => $data['pre7'],
                            'pre8' => $data['pre8'],
                        ]);
                    }
                }
            }

            return redirect()->back()->with('success', 'Update successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Update failed');
        }
    }

    public function stafftimetable()
    {
        $staffdetails = Staff::where(['sf_position' => 1, 'sf_delete' => 1])
            ->leftJoin('stafftimetables', function ($join) {
                $join->on('staff.id', '=', 'stafftimetables.staff_id');
            })
            ->whereNull('stafftimetables.staff_id')
            ->select('staff.staff_id', 'staff.sf_name', 'staff.sf_subject_taken')
            ->get();

        $days = Day::where(['day_status' => 1])->get();

        // Retrieving staff timetables and their associated sub-timetables
        $timetableView = DB::table('stafftimetables')
            ->join('staff', 'staff.id', '=', 'stafftimetables.staff_id')
            ->select('staff.id as section_id', 'staff.sf_name', 'stafftimetables.id as timetable_id', 'stafftimetables.staff_id')
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

        return view('sections.stafftimetable', compact('staffdetails', 'days', 'timetableView'));
    }




    public function stafftimetableinsert(Request $request)
    {
        try {
            $staffid = $request->staffid;
            // dd( $staffid);
            $checkstaffid = Stafftimetable::where('staff_id', $staffid)->first();

            if ($checkstaffid) {
                return redirect()->back()->with('failed', 'Timetable Already Exist');
            } else {

                $classtimetableid = Stafftimetable::insertGetId(['staff_id' => $staffid]);

                // dd($classtimetableid);
                $Dayid = $request->dayid;
                $Pre1 = $request->pre1;
                $Pre2 = $request->pre2;
                $Pre3 = $request->pre3;
                $Pre4 = $request->pre4;
                $Pre5 = $request->pre5;
                $Pre6 = $request->pre6;
                $Pre7 = $request->pre7;
                $Pre8 = $request->pre8;
                $stafftimetables = [];

                for ($i = 0; $i < count($Dayid); $i++) {
                    $stafftimetables[] = [
                        'dayid' => $Dayid[$i],
                        'pre1' => $Pre1[$i],
                        'pre2' => $Pre2[$i],
                        'pre3' => $Pre3[$i],
                        'pre4' => $Pre4[$i],
                        'pre5' => $Pre5[$i],
                        'pre6' => $Pre6[$i],
                        'pre7' => $Pre7[$i],
                        'pre8' => $Pre8[$i],
                    ];
                }


                // Save the descriptions to the database
                foreach ($stafftimetables as $data) {
                    Substafftimetable::insert([
                        'tt_id' => $classtimetableid,
                        'day_id' => $data['dayid'],
                        'pre1' => $data['pre1'],
                        'pre2' => $data['pre2'],
                        'pre3' => $data['pre3'],
                        'pre4' => $data['pre4'],
                        'pre5' => $data['pre5'],
                        'pre6' => $data['pre6'],
                        'pre7' => $data['pre7'],
                        'pre8' => $data['pre8'],
                    ]);
                }

                return redirect()->back()->with('success', 'save successfull');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not save');
        }
    }


    public function stafftimetableedit($id)
    {


        $timetableView = DB::table('stafftimetables')
            ->join('staff', 'staff.id', '=', 'stafftimetables.staff_id')
            ->where('stafftimetables.id', $id) // Use 'stafftimetables.id' instead of 'id'
            ->select('stafftimetables.id', 'stafftimetables.staff_id', 'staff.sf_name', 'staff.sf_subject_taken')
            ->get();

        if (!$timetableView->isEmpty()) {
            foreach ($timetableView as $key => $requested) {
                $result = DB::table('substafftimetables')
                    ->join('days', 'days.id', '=', 'substafftimetables.day_id')
                    ->where('tt_id', $requested->id) // Use 'tt_id' instead of 'id'
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

                $timetableView[$key]->tableview = $result;
            }
        }

        return view('sections.stafftimetableedit', compact('timetableView'));
    }

    public function stafftimetableupdate(Request $request, $id)
    {

        try {
            $staffid = $request->input('staffid');
            $classtimetableid = Stafftimetable::where('id', $id)->update(['staff_id' => $staffid]);

            $desc = Substafftimetable::where('tt_id', $id)
                ->select('id')
                ->pluck('id')
                ->toArray();
            $Pre1 = $request->pre1;
            $Pre2 = $request->pre2;
            $Pre3 = $request->pre3;
            $Pre4 = $request->pre4;
            $Pre5 = $request->pre5;
            $Pre6 = $request->pre6;
            $Pre7 = $request->pre7;
            $Pre8 = $request->pre8;

            $stafftimetable = [];

            // Determine the count of items to loop over
            $itemCount = count($Pre1);

            for ($i = 0; $i < $itemCount; $i++) {
                $stafftimetable[] = [
                    'pre1' => $Pre1[$i],
                    'pre2' => $Pre2[$i],
                    'pre3' => $Pre3[$i],
                    'pre4' => $Pre4[$i],
                    'pre5' => $Pre5[$i],
                    'pre6' => $Pre6[$i],
                    'pre7' => $Pre7[$i],
                    'pre8' => $Pre8[$i],
                ];
            }

            if (!empty($desc)) {
                // Save the descriptions to the database
                foreach ($desc as $key => $desId) {
                    if (array_key_exists($key, $stafftimetable)) {
                        $data = $stafftimetable[$key];

                        Substafftimetable::where('id', $desId)->update([
                            // This line might be missing
                            'pre1' => $data['pre1'],
                            'pre2' => $data['pre2'],
                            'pre3' => $data['pre3'],
                            'pre4' => $data['pre4'],
                            'pre5' => $data['pre5'],
                            'pre6' => $data['pre6'],
                            'pre7' => $data['pre7'],
                            'pre8' => $data['pre8'],
                        ]);
                    }
                }
            }

            return redirect()->back()->with('success', 'Update successful');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Update failed');
        }
    }



    public function studentpromotion()
    {

        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        $studentslist = Student::all();

        $studentclass = DB::table('students')
            ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
            ->select('class_sections.c_class', 'class_sections.id', 'students.acdm_year')
            ->where(function ($query) use ($fyear) {
                $query->where('students.acdm_year', '!=', $fyear)
                    ->orWhereNull('students.acdm_year');
            })
            ->distinct()
            ->get();

        // $classPromotions = DB::table('classpromotions')
        // ->join('class_sections as fromSection', 'fromSection.id', '=', 'classpromotions.cp_from')
        // ->join('class_sections as toSection', 'toSection.id', '=', 'classpromotions.cp_to')

        // ->select(
        //     'fromSection.c_class as from_class',
        //     'classpromotions.cp_year',
        //     'classpromotions.id',
        //     'classpromotions.cp_from',
        //     'classpromotions.cp_to',
        //     'toSection.c_class as to_class'
        // )
        // ->where('cp_year', $fyear)
        // ->get();
        $classPromotions = DB::table('classpromotions')
            ->join('class_sections as fromSection', 'fromSection.id', '=', 'classpromotions.cp_from')
            ->join('class_sections as toSection', 'toSection.id', '=', 'classpromotions.cp_to',)
            ->select(
                'fromSection.c_class as from_class',
                'classpromotions.cp_year',
                'classpromotions.id',
                'classpromotions.cp_from',
                'classpromotions.cp_to',
                'toSection.c_class as to_class',
                'classpromotions.cp_lastyear'
            )
            ->where('cp_year', $fyear)
            ->get();


        $promotionct = DB::table('classpromotions')
            ->join('class_sections', 'class_sections.id', '=', 'classpromotions.cp_from')
            ->select('class_sections.c_class', 'classpromotions.cp_year', 'classpromotions.id', 'cp_lastyear', 'classpromotions.cp_from', 'classpromotions.cp_to')
            ->where(['cp_year' => $fyear, 'cp_to' => 'CT'])
            ->get();

        // $promotionct = DB::table('classpromotions')
        //     ->join('class_sections', 'class_sections.id', '=', 'classpromotions.cp_to')
        //     ->select('class_sections.c_class', 'classpromotions.cp_year')
        //     ->where('cp_year', $fyear)
        //     ->get();


        // dd($classPromotions);
        return view('sections.studentpromotion', compact('studentclass', 'fyear', 'promotionct', 'classPromotions', 'studentslist'));
    }

    public function promotioninsert(Request $request)
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

            $fromid = $request->input('fromid');
            $toid = $request->input('toid');
            $lastyear = $request->input('lastyear');
            $student_ids = $request->student_ids;

            $promotion = Classpromotion::where([
                'cp_from' => $fromid,
                'cp_to' => $toid, 'cp_year' => $fyear
            ])
                ->first();

            if ($promotion) {
                return redirect()->back()->withErrors(['Promotion Already Exist']);
            } else {
                $promotionmodel = Classpromotion::insert([
                    'cp_from' => $fromid,
                    'cp_to' => $toid,
                    'cp_lastyear' => $lastyear,
                    'cp_year' => $fyear
                ]);
                // $studentmodel = Student::where(['s_classid' => $fromid])
                //     ->update(['s_classid' => $toid, 'acdm_year' => $fyear]);


                $desc = Student::where('s_classid', $fromid)
                    ->select('id')
                    ->pluck('id')
                    ->toArray();

                $student_ids = $request->student_ids;

                $studentlist = [];

                // Determine the count of items to loop over
                $itemCount = count($student_ids);

                for ($i = 0; $i < $itemCount; $i++) {
                    $studentlist[] = [
                        '$student_ids' => $student_ids[$i],


                    ];
                }

                if (!empty($desc)) {
                    // Save the descriptions to the database
                    foreach ($desc as $key => $desId) {
                        if (array_key_exists($key, $studentlist)) {
                            $data = $studentlist[$key];

                            Student::where('id', $desId)->update([
                                // This line might be missing
                                's_classid' => $toid,
                                'acdm_year' => $fyear,

                            ]);
                        }
                    }
                }



                return redirect()->back()->with('success', 'promotion successfull');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Promotion failed');
        }
    }

    public function promotiondelete(Request $request, $id)
    {
        try {

            $getfrom = $request->input('froms');
            $getto = $request->input('tos');
            $lastyear = $request->input('lastyear');

            $restpromotion =  Student::where(['s_classid' => $getto])
                ->update([
                    's_classid' => $getfrom, 'acdm_year' => $lastyear
                ]);

            $promotions = Classpromotion::find($id)->delete();
            return redirect()->back()->with('success', 'Rest successfull');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'failed not Rest');
        }
    }

    public function getstudent(Request $request)
    {

        // $a = $request->class_id;
        // return response($a);
        $data['students'] = DB::table('students')
            ->join('fees', 'fees.student_id', '=', 'students.id')
            ->select('students.id', 'students.s_name', 'fees.admission as admission')
            ->where("s_classid", $request->class_id)
            ->where('s_delete', 1)
            ->get();

        // $data['students'] = DB::table('students')
        // ->join('class_section', 'class_section.id', '=', 'students.s_classid')
        // ->select('id', 's_name')
        // ->where("s_classid", $request->class_id)
        // ->where('s_delete', 1)
        // ->get();

        return response()->json($data);
    }

    public function getstudentbyfees(Request $request)
    {
        // $currentDate = now();
        // $nextYe = $currentDate->format('y');
        // $nextYear = $currentDate->addYear()->format('Y');
        // $academic_year = $nextYe . '-' . $nextYear;

        // $students = DB::table('students')
        //     ->select('id', 's_name', 's_classid')
        //     ->where("s_classid", $request->class_id)
        //     ->where('s_delete', 1)
        //     ->get();

        // $feeStructures = DB::table('fee_structures')
        // ->join('class_sections', 'class_sections.id', '=', 'fee_structures.class_id')
        // ->join('students', 'students.s_classid', '=', 'fee_structures.class_id')    
        // ->select('students.s_name','fee_structures.id as fees_id', 'fee_structures.academic_year', 'fee_structures.annual_fee', 'fee_structures.exam_fees', 'fee_structures.status', 'class_sections.c_class') // Include the columns you need
        // ->where('fee_structures.class_id', $request->class_id)
        // ->where('fee_structures.academic_year', $academic_year)
        // ->where('fee_structures.status', 'active')
        // ->get();
        $data['students'] = DB::table('students')

            ->select('students.id', 'students.s_name', 'students.s_admissionno')
            ->where("s_classid", $request->class_id)
            ->where('s_delete', 1)
            ->get();
        // $data['students'] = DB::table('student_fees_records')
        // ->select(
        //     'student_id',
        // 'total_fees',
        // 'academic_year',
        // 'balance',
        // 'total_fees_paid')

        // ->where('student_id', $request->input('student_id'))
        // ->orderBy('created_at', 'desc') // Assuming there's a timestamp column named 'created_at'
        // ->groupBy('student_id','total_fees',
        // 'academic_year',
        // 'balance',
        // 'total_fees_paid')
        // ->first();


        return response()->json($data);
    }

    public function getstudentfees(Request $request)
    {

        $data['fees'] = DB::table('fees')
            ->join('students', 'students.id', '=',  'fees.student_id')
            ->select('students.*', 'fees.*')
            ->where("student_id", $request->student_id)
            ->where('status', 1)
            ->first();
        // $data1['paidfees'] = DB::table('paidfees')
        // ->join('students','students.id' , '=',  'fees.student_id')
        // ->select('students.*','paidfees.*')
        // ->where("student_id",$request->student_id)
        // ->where('status', 1)
        // ->first();

        return response()->json($data);
    }
    public function getstudentpaidfees(Request $request)
    {

        $data['paidfees'] = DB::table('paidfees')

            ->join('students', 'students.id', '=',  'paidfees.student_id')
            ->select('students.*', 'paidfees.*')
            ->where("student_id", $request->student_id)
            ->where('status', 1)
            ->first();


        return response()->json($data);
    }


    public function getoldstudent(Request $request)
    {

        $class = $request->class_id;
        $data['students'] = DB::table('paidfees')
            ->select('students.s_name as studentname', 'students.id as studentid')
            ->join('students', 'students.id', '=', 'paidfees.student_id')
            ->where('paidfees.class_id', $class)
            ->groupBy('paidfees.class_id')
            ->get();

        // dd($students);
        return response()->json($data);
    }

    public function assignclassstaff()
    {
        $class_staff = Assignstaff::select('as_class_id')
            ->pluck('as_class_id')
            ->toArray();

        $class = DB::table('class_sections')
            ->where(['c_status' => 1, 'c_delete' => 1])
            ->whereNotIn('id', $class_staff)
            ->get();

        $staffdetails = Staff::where(['sf_position' => 1, 'sf_delete' => 1])
            ->get();


        $assignstaff = DB::table('assignstaffs')
            ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')
            ->select('class_sections.c_class', 'assignstaffs.id')
            ->get();

        if (!empty($assignstaff)) {
            foreach ($assignstaff as $key => $requested) {
                $result = DB::table('subassignstaffs')
                    ->join('staff', 'staff.id', '=', 'subassignstaffs.as_staff_id')
                    ->where('as_id', $requested->id)
                    ->select(
                        'staff.sf_name',
                        'staff.sf_subject_taken',
                    )
                    ->get();

                $assignstaff[$key]->view = $result;
            }
        }

        return view('sections.assignclass_staff', compact('class', 'staffdetails', 'assignstaff'));
    }

    public function classstaffadd(Request $request)
    {
        try {
            $classid = $request->classid;
            $staff_id = $request->staff_id;
            if ($staff_id) {

                $assignstaffid = Assignstaff::insertGetId(['as_class_id' => $classid]);

                $classstaff = [];

                // Data Preparation
                for ($i = 0; $i < count($staff_id); $i++) {
                    $classstaff[] = [
                        'staffs' => $staff_id[$i],
                    ];
                }
            } else {
                return redirect()->back()->with('failed', 'First You select staff ');
            }

            // Database Insertion within a Transaction
            DB::beginTransaction();

            try {
                foreach ($classstaff as $classstaffs) {
                    Subassignstaff::insert([
                        'as_id' => $assignstaffid, // Note: This assumes $classid is a single value, not an array
                        'as_staff_id' => $classstaffs['staffs'],
                    ]);
                }

                DB::commit(); // Commit the transaction if all inserts are successful

                return redirect()->back()->with('success', 'Save successful');
            } catch (\Exception $e) {
                DB::rollBack(); // Roll back the transaction in case of an exception
                return redirect()->back()->with('failed', 'Not saved. Error: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not saved. Error: ' . $e->getMessage());
        }
    }

    public function assignclassstaffedit($id)
    {

        $class = DB::table('class_sections')
            ->where(['c_status' => 1, 'c_delete' => 1])
            ->get();

        $staffdetails = Staff::where(['sf_position' => 1, 'sf_delete' => 1])
            ->get();



        $assignstaff = DB::table('assignstaffs')
            ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')
            ->select('class_sections.c_class', 'assignstaffs.id')
            ->get();

        if (!empty($assignstaff)) {
            foreach ($assignstaff as $key => $requested) {
                $result = DB::table('subassignstaffs')
                    ->join('staff', 'staff.id', '=', 'subassignstaffs.as_staff_id')
                    ->where('as_id', $requested->id)
                    ->select(
                        'staff.sf_name',
                        'staff.sf_subject_taken',
                    )
                    ->get();

                $assignstaff[$key]->view = $result;
            }
        }

        $assignstaffedit = DB::table('assignstaffs')
            ->join('class_sections', 'class_sections.id', '=', 'assignstaffs.as_class_id')
            ->select('class_sections.id as classid', 'class_sections.c_class',  'assignstaffs.id')
            ->where('assignstaffs.id', $id)
            ->first();

        if (!empty($assignstaffedit)) {
            $result = DB::table('subassignstaffs')
                ->join('staff', 'staff.id', '=', 'subassignstaffs.as_staff_id')
                ->where('as_id', $id)
                ->select(
                    'subassignstaffs.id as subassignid',
                    'staff.id',
                    'staff.sf_name',
                    'staff.sf_subject_taken',
                )
                ->get();

            // Add the result to the original object
            $assignstaffedit->views = $result;
        }

        $staffdetailsadd = DB::table('staff')
            ->leftJoin('subassignstaffs', function ($join) use ($id) {
                $join->on('staff.id', '=', 'subassignstaffs.as_staff_id')
                    ->where('as_id', '=', $id);
            })
            ->select('staff.id', 'staff.sf_subject_taken', 'staff.sf_name')
            ->where(['sf_position' => 1, 'sf_delete' => 1])
            ->whereNull('subassignstaffs.as_staff_id') // Add this line to filter only rows where there is no matching entry in subassignstaffs
            ->get();

        // dd($staffdetailsadd);

        return view('sections.assignclass_staffedit', compact('class', 'staffdetails', 'assignstaff', 'assignstaffedit', 'staffdetailsadd'));
    }

    public function assignclassstaffupdate(Request $request, $id)
    {
        try {
            $newstaff_id = $request->newstaff_id;
            $classstaff = [];

            // Check if $newstaff_id is not null and is an array
            if (!is_null($newstaff_id) && is_array($newstaff_id)) {
                // Data Preparation
                for ($i = 0; $i < count($newstaff_id); $i++) {
                    $classstaff[] = [
                        'staffs' => $newstaff_id[$i],
                    ];
                }
            } else {
                // Handle the case where $newstaff_id is null or not an array
                // You may want to log an error, redirect the user, or take appropriate action
            }

            // Database Insertion within a Transaction
            DB::beginTransaction();

            try {
                foreach ($classstaff as $classstaffs) {
                    Subassignstaff::insert([
                        'as_id' => $id,
                        'as_staff_id' => $classstaffs['staffs'],
                    ]);
                }

                DB::commit(); // Commit the transaction if all inserts are successful

                return redirect()->back()->with('success', 'Save successful');
            } catch (\Exception $e) {
                DB::rollBack(); // Roll back the transaction in case of an exception
                dd('Exception caught: ' . $e->getMessage());
                // Add more specific logging or debugging here if needed
                return redirect()->back()->with('failed', 'Not saved. Error: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            dd('Exception caught outside the transaction: ' . $e->getMessage());
            // Add more specific logging or debugging here if needed
            return redirect()->back()->with('failed', 'Not saved. Error: ' . $e->getMessage());
        }
    }

    public function assignclassstaffdelete($subassignid)
    {
        try {
            $deletestaff = Subassignstaff::where("id", "=", "$subassignid")->delete();
            return redirect()->back()->with('success', 'Delete successful');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not Delete.');
        }
    }

    public function classteacheredit($id)
    {
        $stafflist = DB::table('staff')
            ->join('users', 'users.id', '=', 'staff.login_id')
            ->where(['sf_position' => 1, 'sf_status' => 1])
            ->select('staff.id', 'staff.sf_name', 'staff.sf_subject_taken')
            ->get();


        $classlist = DB::table('class_sections')
            // ->join('staff', 'staff.sf_classid', '=', 'class_sections.c_teacherid')
            ->where(['class_sections.c_delete' => 1, 'class_sections.c_status' => 1, 'class_sections.id' => $id])
            ->select('class_sections.id', 'class_sections.c_class', 'class_sections.c_teacherid')
            ->first();

        return view('sections.classteacheredit', compact('stafflist', 'classlist'));
    }
    public function classteacherupdate(Request $request, $id)
    {
        try {
            $teacherid = $request->input('teacherid');
            Class_section::where('id', $id)->update(['c_teacherid' => $teacherid]);
            return redirect()->back()->with('success', 'update successful');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not update.');
        }
    }
}
