<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use App\Models\Routes;

use App\Models\Student;
use App\Models\paidfees;
use App\Models\BloodGroup;
use App\Models\newadmission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Models\{Country, Oldstudentclass, State, studentcompletereport};
use Illuminate\Support\Facades\DB;
use App\Models\studenttransferreport;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */




    public function index()
    {
        // $students = Student::where('s_delete', 1)->get();

        // $students = DB::table('students')
        // ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
        // ->select('students.*','class_sections.c_class as cname')
        // ->where('s_delete', 1)
        // ->get();

        return view('students.index', compact('students'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  dd($students);
        $data1['countries'] = Country::get(["name", "id"]);
        $data2['bloods'] = BloodGroup::all();
        $students =  Student::select('id', 's_admissionno')->orderBy('id', 'DESC')
            ->first();

        // $assignvehicles = DB::table('assignvehicles')
        //     ->join('vehicles', 'vehicles.id', '=',  'assignvehicles.vehicle_id')
        //     ->join('routes', 'routes.id', '=',  'assignvehicles.route_id')
        //     ->join('staff', 'staff.id', '=',  'vehicles.staff_id')
        //     ->select('assignvehicles.*', 'vehicles.vehiclenumber as vehicle', 'routes.routetitle as route', 'staff.sf_name as name')
        //     // ->where('assignvehicles.status', 1)
        //     ->get();

        //   return response($students);
        if ($students == '') {
            $students = 0;
        } else {
            $students =  $students;
        }
        //   return response($students);
        return view('students.create', $data1, $data2)->with(['students' => $students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        $request->validate([
            's_admissionno' => [
                'required',
                'string',
                'max:255',
                Rule::unique('students', 's_admissionno')
                    ->ignore($request->id), // Exclude the current record when updating
            ],
            // Add other validation rules for your other fields here...
        ], [
            's_admissionno.unique' => 'The admission number has already been taken.',
            // Customize messages for other validation rules as needed...
        ]);
        // return response($request);
        //   $date =   date('d-m-Y', strtotime($request->s_dob));

        $studentcheck = Student::where(['s_name' => $request->s_name, 's_dob' => $request->s_dob, 's_gender' => $request->s_gender,])->first();

        if ($studentcheck) {
            return redirect()->back()->with('failed', 'Student Already Register');
        } else {
            $post = new Student;

            $post->s_admissionno = $request->s_admissionno;
            $post->s_rollno = $request->s_rollno;
            $post->s_firstname = $request->s_firstname;
            $post->s_lastname = $request->s_lastname;
            $post->s_name = $request->s_firstname . ' ' . $request->s_lastname;
            $post->s_dob = $request->s_dob;
            $post->s_gender = $request->s_gender;
            $post->s_email = $request->s_email;
            $post->s_religion = $request->s_religion;
            $post->s_aadharno = $request->s_aadharno;
            $post->s_bloodgroup = $request->s_bloodgroup;
            $post->s_permanentaddress = $request->s_permanentaddress;
            $post->s_presentaddress = $request->s_presentaddress;
            $post->s_nationality = $request->s_nationality;
            $post->s_state = $request->s_state;
            $post->acdm_year = $fyear;
            $post->s_fathername = $request->s_fathername;
            $post->s_fatheroccupation = $request->s_fatheroccupation;
            $post->s_mothername = $request->s_mothername;
            $post->s_vanid = $request->route;
            $post->s_motheroccupation = $request->s_motheroccupation;
            $post->s_phone = $request->s_phone;
            $post->s_disabledperson = $request->s_disabledperson;

            //profile
            if (!empty($request->s_profile)) {
                $profile = time() . '.' . $request->s_profile->getClientOriginalName();
                $profile_store = uniqid() . '.' . $profile; // Generate a unique filename
                $profile_path = $request->s_profile->move('student/profile', $profile_store);
            } else {
                $profile = null;
                $profile_path = null;
            }

            $post->s_profile = $profile;
            $post->image_path = "$profile_path";
            $post->s_classid = $request->class;

            if (!empty($request->s_certificate)) {
                $certificate = time() . '.' . $request->s_certificate->getClientOriginalName();
                $certificate_store = uniqid() . '.' . $certificate; // Generate a unique filename
                $certificate_path = $request->s_certificate->move('student/certificate', $certificate_store);
            } else {
                $certificate = null;
                $certificate_path = null;
            }

            $post->s_certificate = $certificate;
            $post->file_path = $certificate_path;
            $post->s_admissiondate = $request->s_admissiondate;

            // return response("$post");
            // $post->save();
            // Student::create($post->all());
            $post->save();

            $fee =  Student::select('id')
                ->orderBy('id', 'DESC')
                ->first();

            Oldstudentclass::insert([
                'student_id' => $post->id,
                'oldclass_id' => $request->class,
                'oldyear' => $fyear,
            ]);
            // // return response($fee);
            // $fees = new Fees;
            // $fees->student_id = $fee->id;
            // $fees->save();

            // // $paidfees = new paidfees;
            // // $paidfees->student_id = $fee->id;
            // // $paidfees->save();

            // $feesid = Fees::where('student_id', $fee->id)->select('id')->first();
            // $feesstudent = Student::find($fee->id);
            // $feesstudent->s_feesid = $feesid->id;
            // $feesstudent->save();


            return redirect()->back()->with('success', 'Student save successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {

        // $student=$id;
        $previousclass = DB::table('oldstudentclasses')
            ->join('class_sections', 'class_sections.id', '=', 'oldstudentclasses.oldclass_id')
            ->select('c_class', 'oldyear')
            ->where('student_id', $student->id)->get();
        $previousct = DB::table('oldstudentclasses')
            ->select('oldclass_id', 'oldyear')
            ->where(['student_id' => $student->id, 'oldclass_id' => 'CT'])->get();


        return view('students.show', compact('student', 'previousclass', 'previousct'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $sid = $student->id;
        $fee = Fees::where('student_id', $sid)->first();
        // return response($fee);
        $countries = Country::get(["name", "id", "country_code"]);
        $bloods = BloodGroup::get(["name"]);

        $routes = Routes::get();
        // $assignvehicles = DB::table('assignvehicles')
        //     ->join('vehicles', 'vehicles.id', '=',  'assignvehicles.vehicle_id')
        //     ->join('routes', 'routes.id', '=',  'assignvehicles.route_id')
        //     ->join('staff', 'staff.id', '=',  'vehicles.staff_id')
        //     ->select('assignvehicles.*', 'vehicles.vehiclenumber as vehicle', 'routes.routetitle as route', 'staff.sf_name as name')
        //     // ->where('assignvehicles.status', 1)
        //     ->get();

        // dd($assignvehicles);
        return view('students.edit', compact('student', 'countries', 'bloods', 'fee', 'routes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $id = $request->s_id;

        $post = Student::find($id);

        $profile = $request->s_profile;
        // return response($request->s_profile);
        $profile_old = $request->s_profileold;
        // return response($profile_old);

        $image_pathold = $request->image_pathold;
        // $profile_count =count($request->s_profile);

        if ($profile == '') {
            # code...
            $profile = $profile_old;
            $profile_path = $image_pathold;
            //  response($profile_old);
            //  return response($profile);

        } else {
            # code...
            $profile = time() . '.' . $request->s_profile->getClientOriginalName();
            $profile_store = uniqid() . '.' . $profile; // Generate a unique filename
            $profile_path = $request->s_profile->move('student/profile', $profile_store);
        }


        $certificate_old = $request->s_certificateold;
        $certificate = $request->s_certificate;
        $file_pathold = $request->file_pathold;

        if ($certificate == '') {
            # code...
            $certificate = $certificate_old;
            $certificate_path = $file_pathold;
        } else {
            # code...
            $certificate = $request->s_name . '.' . $request->s_certificate->getClientOriginalName();

            $certificate_store = uniqid() . '.' . $certificate; // Generate a unique filename

            $certificate_path = $request->s_certificate->move('student/certificate', $certificate_store);
            //   dd($certificate_path);
        }
        // $post = new Student;

        $post->s_admissionno = $request->s_admissionno;
        $post->s_rollno = $request->s_rollno;
        $post->s_firstname = $request->s_firstname;
        $post->s_lastname = $request->s_lastname;
        $post->s_name = $request->s_firstname . ' ' . $request->s_lastname;
        $post->s_dob = $request->s_dob;
        $post->s_gender = $request->s_gender;
        $post->s_email = $request->s_email;
        $post->s_religion = $request->s_religion;
        $post->s_aadharno = $request->s_aadharno;
        $post->s_bloodgroup = $request->s_bloodgroup;
        $post->s_permanentaddress = $request->s_permanentaddress;
        $post->s_presentaddress = $request->s_presentaddress;
        $post->s_nationality = $request->s_nationality;
        $post->s_state = $request->s_state;
        $post->s_fathername = $request->s_fathername;
        $post->s_fatheroccupation = $request->s_fatheroccupation;
        $post->s_mothername = $request->s_mothername;
        $post->s_motheroccupation = $request->s_motheroccupation;
        $post->s_phone = $request->s_phone;
        $post->s_disabledperson = $request->s_disabledperson;
        $post->s_profile = $profile;
        $post->image_path = "$profile_path";
        $post->s_classid = $request->class;
        $post->s_vanid = $request->route;
        $post->s_certificate = $certificate;
        $post->file_path = "$certificate_path";
        $post->s_admissiondate = $request->s_admissiondate;

        // return response("$post");
        $post->save();

        // $id = $request->s_id;

        // $fee = Fees::where('student_id', $id)->first();
        // // return response($fee);
        // $fee->admission = $request->admission;
        // $fee->term1 = $request->term1;
        // $fee->term2 = $request->term2;
        // $fee->term3 = $request->term3;
        // $fee->extra = $request->extra;
        // $fee->books = $request->book;
        // $fee->uniform = $request->uniform;
        // $fee->fine = $request->fine;
        // $fee->fine_reason = $request->fine_reason;
        // $fee->total = $request->totalfees;

        // $fee->save();

        return redirect()->back()->with('success', 'Student updated successfully');
        // ->route('students.index')
        //     ->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $id = $student->id;

        $post = Student::find($id);
        $post->s_delete = "0";
        $post->save();
        // $student->delete();

        return redirect()->back()
            ->with('success', 'Student deleted successfully');
    }

    // public function getCountry()
    // {
    //     $data1['countries'] = Country::get(["name","id"]);
    //     $data2['bloods'] = BloodGroup::all();
    //     // $countries = Country::get(["name","id"]);
    //     return view('students.create',$data1,$data2);
    // }

    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)
            ->get(["name", "id"]);
        return response()->json($data);
    }

    // public function getBlood()
    // {
    //     // $data['bloods'] = BloodGroup::all();
    //     // // $countries = Country::get(["name","id"]);
    //     // return view('students.create',$data);
    //     $bloods = BloodGroup::all();

    //     return view('students.create',compact('bloods'));
    // }


    public function newadmissiondetails()
    {

        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');
        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }
        // return response($fyear);

        $data6['students'] = newadmission::where('s_delete', 1)->where('s_class_id', NULL)->where('academic_year', $fyear)->get();

        // $data3['students'] = DB::table('newadmissions')
        // ->join('class_sections','class_sections.id' , '=',  'newadmissions.s_class_id')
        // ->select('newadmissions.*','class_sections.c_class as class')
        // ->where('newadmissions.s_delete', 1)
        // ->where('newadmissions.academic_year',$fyear)
        // ->get();

        // dd(   $data3['students'] );

        $data5['classes'] = DB::table('class_sections')
            ->where(['c_status' => 1, 'c_delete' => 1])
            ->get();

        return view('schoolstudent.newadmissiondetails', $data5, $data6)
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function newadmissiondetailsfilter(Request $request)
    {

        $year = $request->input('year');

        // return response($year);
        // $data['students'] = newadmission::where('s_delete', 1)->where('academic_year',$year)->get();

        $data3['students'] = DB::table('newadmissions')
            ->join('class_sections', 'class_sections.id', '=',  'newadmissions.s_class_id')
            ->select('newadmissions.*', 'class_sections.c_class as class')
            ->where('newadmissions.s_delete', 1)
            ->where('newadmissions.academic_year', $year)
            ->get();

        $data5['classes'] = DB::table('class_sections')
            ->where(['c_status' => 1, 'c_delete' => 1])
            ->get();
        // dd($data5['classes']);
        return view('schoolstudent.newadmissiondetails', $data3, $data5)
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function newadmission()
    {

        $data1['countries'] = Country::get(["name", "id"]);
        $data2['bloods'] = BloodGroup::all();
        // $data3['students'] = newadmission::where('s_delete', 1)->get();

        $students =  newadmission::select('id', 's_admissionno')->orderBy('id', 'DESC')
            ->first();


        //   return response($students);
        if ($students == '') {
            $students = 0;
        } else {
            $students =  $students;
        }

        return view('schoolstudent.newadmissionadd', $data1, $data2)->with('students', $students);
    }
    public function addnewadmission(Request $request)
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

            // $profile = time() . '.' . $request->s_profile->getClientOriginalName();
            // $profile_store = uniqid() . '.' . $profile; // Generate a unique filename
            // $profile_path = $request->s_profile->move('student/profile', $profile_store);
            // // $profile_path->move('staff/profile', $profile_store);
            // $certificate = time() . '.' . $request->s_certificate->getClientOriginalName();
            // $certificate_store = uniqid() . '.' . $certificate; // Generate a unique filename
            // $certificate_path = $request->s_certificate->move('student/certificate', $certificate_store);


            $studentcheck = newadmission::where(['s_name' => $request->s_name, 's_dob' => $request->s_dob, 's_gender' => $request->s_gender,])->first();

            if ($studentcheck) {
                return redirect()->back()->with('failed', 'Student Already Admission');
            } else {


                $post = new newadmission;

                $post->s_admissionno = $request->s_admissionno;
                $post->s_firstname = $request->s_firstname;
                $post->s_lastname = $request->s_lastname;
                $post->s_name = $request->s_firstname . ' ' . $request->s_lastname;
                $post->s_dob = $request->s_dob;
                $post->s_gender = $request->s_gender;
                $post->s_email = $request->s_email;
                $post->s_religion = $request->s_religion;
                $post->s_aadharno = $request->s_aadharno;
                $post->s_bloodgroup = $request->s_bloodgroup;
                $post->s_permanentaddress = $request->s_permanentaddress;
                $post->s_presentaddress = $request->s_presentaddress;
                $post->s_nationality = $request->s_nationality;
                $post->s_state = $request->s_state;
                $post->s_fathername = $request->s_fathername;
                $post->s_fatheroccupation = $request->s_fatheroccupation;
                $post->s_mothername = $request->s_mothername;
                $post->s_motheroccupation = $request->s_motheroccupation;
                $post->s_phone = $request->s_phone;
                $post->s_disabledperson = $request->s_disabledperson;

                //profile
                if (!empty($request->s_profile)) {
                    $profile = time() . '.' . $request->s_profile->getClientOriginalName();
                    $profile_store = uniqid() . '.' . $profile; // Generate a unique filename
                    $profile_path = $request->s_profile->move('student/profile', $profile_store);
                } else {
                    $profile = null;
                    $profile_path = null;
                }


                $post->s_profile = $profile;
                $post->image_path = "$profile_path";


                if (!empty($request->s_certificate)) {
                    $certificate = time() . '.' . $request->s_certificate->getClientOriginalName();
                    $certificate_store = uniqid() . '.' . $certificate; // Generate a unique filename
                    $certificate_path = $request->s_certificate->move('student/certificate', $certificate_store);
                } else {
                    $certificate = null;
                    $certificate_path = null;
                }

                $post->s_certificate = $certificate;
                $post->file_path = "$certificate_path";
                $post->s_admissiondate = $request->s_admissiondate;
                $post->academic_year = $fyear;
                // return response("$fyear");
                // $post->save();
                // Student::create($post->all());
                $post->save();
                // return response($post);

                return redirect()->back()->with('success', 'Admission successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not save');
        }
    }
    public function newadmissionview($id)
    {

        // return response($id);
        $data3['student'] = newadmission::where('id', $id)
            ->where('s_delete', 1)->first();

        return view('schoolstudent.newadmissionview', $data3);
    }
    public function newadmissionedit($id)
    {

        $data3['student'] = newadmission::where('s_delete', 1)->first();

        return view('schoolstudent.newadmissionedit', $data3);
    }
    public function newadmissiontoold(Request $request)
    {
        // return response($request);

        $post = new Student;

        $post->s_admissionno = $request->s_admissionno;
        $post->s_firstname = $request->s_firstname;
        $post->s_lastname = $request->s_lastname;
        $post->s_name = $request->s_firstname . ' ' . $request->s_lastname;
        $post->s_dob = $request->s_dob;
        $post->s_gender = $request->s_gender;
        $post->s_email = $request->s_email;
        $post->s_religion = $request->s_religion;
        $post->s_aadharno = $request->s_aadharno;
        $post->s_bloodgroup = $request->s_bloodgroup;
        $post->s_permanentaddress = $request->s_permanentaddress;
        $post->s_presentaddress = $request->s_presentaddress;
        $post->s_nationality = $request->s_nationality;
        $post->s_state = $request->s_state;
        $post->s_fathername = $request->s_fathername;
        $post->s_fatheroccupation = $request->s_fatheroccupation;
        $post->s_mothername = $request->s_mothername;
        $post->s_motheroccupation = $request->s_motheroccupation;
        $post->s_phone = $request->s_phone;
        $post->s_disabledperson = $request->s_disabledperson;
        $post->s_profile = $request->s_profile;
        $post->image_path = $request->image_path;
        $post->s_certificate = $request->s_certificate;
        $post->file_path = $request->file_path;
        $post->s_admissiondate = $request->s_admissiondate;
        $post->s_classid = $request->classid;
        $post->acdm_year = $request->academic_year;
        // return response("$post");
        // $post->save();
        // Student::create($post->all());
        $post->save();

        $fee =  Student::select('id')
            ->orderBy('id', 'DESC')
            ->first();
        // return response($fee);
        // $fees = new Fees;
        // $fees->student_id = $fee->id;
        // $fees->save();



        $id = $request->id;
        $posts = newadmission::find($id);

        $posts->s_class_id = $request->classid;
        $posts->status = "1";
        $posts->save();


        Oldstudentclass::insert([
            'student_id' => $post->id,
            'oldclass_id' => $request->classid,
            'oldyear' => $request->academic_year,
        ]);


        return redirect()->back()->with('success', 'save successfully');
    }

    public function classfilter(Request $request)
    {
        $class = $request->input('class');
        $admissionno = $request->input('admissionno');

        // return response($class);
        // $students = Student::where('s_delete', 1)->get();
        if ($admissionno) {
            $students = DB::table('students')
                ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
                ->select('students.*', 'class_sections.c_class as cname')
                ->where('s_admissionno',  $admissionno)
                ->where('s_delete', 1)
                ->get();
        } else {
            $students = DB::table('students')
                ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
                ->select('students.*', 'class_sections.c_class as cname')
                ->where('s_classid',  $class)
                ->where('s_delete', 1)
                ->get();
        }

        return view('students.index', compact('students'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function studenttransfer(Request $request)
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

            $todayDate = Carbon::now()->format('Y-m-d');


            $transfer = new studenttransferreport;
            $transfer->tr_student_id = $request->student_id;
            $transfer->tr_class_id = $request->class_id;
            $transfer->tr_date = $todayDate;
            $transfer->tr_year = $fyear;
            $transfer->save();

            $transferupdate = Student::where('id', $request->student_id)->update(['s_classid' => 'TR', 's_loginstatus' => '0']);

            return redirect()->back()->with('success', 'Transfer successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Transfer Not Change');
        }
    }

    public function studentcompleted(Request $request)
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

            $todayDate = Carbon::now()->format('Y-m-d');


            $complete = new studentcompletereport();
            $complete->cr_student_id = $request->student_id;
            $complete->cr_class_id = $request->class_id;
            $complete->cr_date = $todayDate;
            $complete->cr_year = $fyear;
            $complete->save();

            $transferupdate = Student::where('id', $request->student_id)->update(['s_classid' => 'CT', 's_loginstatus' => '0']);

            return redirect()->back()->with('success', 'change successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', ' Not Change');
        }
    }
}
