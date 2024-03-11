<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\salary;
use App\Models\Country;
use App\Models\BloodGroup;
use App\Models\Staffaccount;
use Illuminate\Http\Request;
use App\Models\Salaryexpense;
use Illuminate\Support\Facades\DB;
use App\Models\{Attendancetype, Staffattandance, State, subjects};

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function staffdetails()
    {
        // $staffs = Staff::where('sf_delete', 1)->get();
        // $staffs = DB::table('staff')
        //     ->join('staffpositions', 'staffpositions.sp_id', '=', 'staff.sf_position')
        //     ->select('staff.*', 'staffpositions.*')
        //     ->where([])
        //     ->get();

        // dd($staffs); compact('staffs')

        return view('staffs.index')
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $max_staff_no = Staff::latest('id')->first();
        $next_no = $max_staff_no->id + 1;
// dd(  $next_no);
        $subjecttaken = subjects::get();

        $data = [
            'countries' => Country::get(["name", "id"]),
            'bloods' => BloodGroup::all(),
            'next_no' => $next_no,
        ];

        return view('staffs.create', $data, compact('subjecttaken'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sf_staffid',
            'sf_name',
            'sf_dob',
            'sf_gender',
            'sf_email',
            'sf_religion',
            'sf_aadharno',
            'sf_bloodgroup',
            'sf_nationality',
            'sf_state',
            'sf_permanentaddress',
            'sf_presentaddress',
            'sf_fathername',
            'sf_fatheroccupation',
            'sf_mothername',
            'sf_motheroccupation',
            'sf_phone',
            'sf_qualification',
            'sf_experience',
            'sf_language',
            'sf_position',
            'sf_subject_taken',
            'sf_disabledperson',
            'sf_profile',
            'sf_certificate',
            'sf_joindate',

        ]);

        // $extension = $image->getClientOriginalExtension(); // Get the file extension
        // $filename = uniqid() . '.' . $extension; // Generate a unique filename
        // $image->move('myimage/administrative', $filename); // Move the uploaded file to a destination folder




        // // return response($request);
        // $profile = time() . '.' . $request->sf_profile->getClientOriginalName();
        // $profile_store = uniqid() . '.' . $profile; // Generate a unique filename
        // $profile_path = $request->sf_profile->move('staff/profile', $profile_store);
        // // $profile_path->move('staff/profile', $profile_store);
        // $certificate = time() . '.' . $request->sf_certificate->getClientOriginalName();
        // $certificate_store = uniqid() . '.' . $certificate; // Generate a unique filename
        // $certificate_path = $request->sf_certificate->move('staff/certificate', $certificate_store);

        $post = new Staff;

        $post->staff_id = $request->sf_staffid;
        $post->sf_firstname = $request->sf_firstname;
        $post->sf_lastname = $request->sf_lastname;
        $post->sf_name = $request->sf_firstname . ' ' . $request->sf_lastname;
        $post->sf_dob = $request->sf_dob;
        $post->sf_gender = $request->sf_gender;
        $post->sf_email = $request->sf_email;
        $post->sf_religion = $request->sf_religion;
        $post->sf_aadharno = $request->sf_aadharno;
        $post->sf_bloodgroup = $request->sf_bloodgroup;
        $post->sf_nationality = $request->sf_nationality;
        $post->sf_state = $request->sf_state;
        $post->sf_permanentaddress = $request->sf_permanentaddress;
        $post->sf_presentaddress = $request->sf_presentaddress;
        $post->sf_fathername = $request->sf_fathername;
        $post->sf_fatheroccupation = $request->sf_fatheroccupation;
        $post->sf_mothername = $request->sf_mothername;
        $post->sf_motheroccupation = $request->sf_motheroccupation;
        $post->sf_phone = $request->sf_phone;
        $post->sf_designation = $request->sf_designation;
        $post->sf_qualification = $request->sf_qualification;
        $post->sf_experience = $request->sf_experience;
        $post->sf_language = $request->sf_language;
        $post->sf_position = $request->sf_position;
        $post->sf_subject_taken = $request->sf_subject_taken;
        $post->sf_disabledperson = $request->sf_disabledperson;
        // $post->sf_profile = $profile;
        // $post->sf_image_path = "$profile_path";
        // $post->sf_certificate = $certificate;
        // $post->sf_file_path = "$certificate_path";
        //profile
        if (!empty($request->sf_profile)) {
            $profile = time() . '.' . $request->sf_profile->getClientOriginalName();
            $profile_store = uniqid() . '.' . $profile; // Generate a unique filename
            $profile_path = $request->sf_profile->move('staff/profile', $profile_store);
        } else {
            $profile = null;
            $profile_path = null;
        }
        $post->sf_profile = $profile;
        $post->sf_image_path = "$profile_path";

        if (!empty($request->$request->sf_certificate)) {
            $certificate = time() . '.' . $request->sf_certificate->getClientOriginalName();
            $certificate_store = uniqid() . '.' . $certificate; // Generate a unique filename
            $certificate_path = $request->sf_certificate->move('staff/certificate', $certificate_store);
        } else {
            $certificate = null;
            $certificate_path = null;
        }
        $post->sf_joindate = $request->sf_joindate;

        // return response("$post");
        // $post->save();
        // Student::create($post->all());
        $post->save();

        $staff =  Staff::select('id')
            ->orderBy('id', 'DESC')
            ->first();

        $sf_acount = new Staffaccount;

        $sf_acount->staff_id = $staff->id;
        $sf_acount->account_no = $request->account_no;
        $sf_acount->account_holder_name = $request->account_holder_name;
        $sf_acount->branch_name = $request->branch_name;
        $sf_acount->branch_code = $request->branch_code;
        $sf_acount->ifsc_code = $request->ifsc_code;
        $sf_acount->bank_address = $request->bank_address;
        $sf_acount->account_type = $request->account_type;

        $sf_acount->save();

        $sf_salary = new salary;

        $sf_salary->staff_id = $staff->id;
        // $sf_salary->basic_salary = $request->basic_salary;
        // $sf_salary->overtime = $request->overtime;
        // $sf_salary->bonus = $request->bonus;
        // $sf_salary->allowance = $request->allowance;
        // $sf_salary->reduction = $request->reduction;
        // $sf_salary->reduction_reason = $request->reduction_reason;
        // $sf_salary->net_salary = $request->net_salary;
        // $sf_salary->payment_method = $request->payment_type;


        $sf_salary->save();

        // return redirect()->route('staffs.index')
        return redirect()->back()
            // return view('staffs.index')
            ->with('success', 'Staff added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        // $student=$id;
        return view('staffs.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff, Staffaccount $staffac)
    {
        $id = $staff->id;
        $countries = Country::get(["name", "id", "country_code"]);
        $bloods = BloodGroup::get(["name"]);
        $staffac = Staffaccount::where('staff_id', $staff->id)->get();
        $staffsal = salary::where('staff_id', $staff->id)->get();

        $subjecttaken = subjects::get();
        // return response($staffac);
        return view('staffs.edit', compact('staff', 'countries', 'bloods', 'staffac', 'staffsal', 'subjecttaken'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff,  Staffaccount $staffac)
    {
        $id = $staff->id;
        // return response($id);
        $post = Staff::find($id);
        $profile = $request->sf_profile;
        $profile_old = $request->sf_profileold;
        $image_pathold = $request->sf_image_pathold;


        if ($profile == '') {
            # code...
            $profile = $profile_old;
            $profile_path = $image_pathold;
        } else {
            # code...
            $profile = time() . '.' . $request->sf_profile->getClientOriginalName();
            $profile_store = uniqid() . '.' . $profile; // Generate a unique filename
            $profile_path = $request->sf_profile->move('staff/profile', $profile_store);
        }


        $certificate_old = $request->sf_certificateold;
        $certificate = $request->sf_certificate;
        $file_pathold = $request->sf_file_pathold;

        if ($certificate == '') {
            # code...
            $certificate = $certificate_old;
            $certificate_path = $file_pathold;
        } else {
            # code...
            $certificate = time() . '.' . $request->sf_certificate->getClientOriginalName();
            $certificate_store = uniqid() . '.' . $certificate; // Generate a unique filename
            $certificate_path = $request->sf_certificate->move('staff/certificate', $certificate_store);
        }
        // $post = new Student;

        $post->staff_id = $request->sf_staffid;
        // $post->sf_name = $request->sf_name;
        $post->sf_firstname = $request->sf_firstname;
        $post->sf_lastname = $request->sf_lastname;
        $post->sf_name = $request->sf_firstname . ' ' . $request->sf_lastname;
        $post->sf_dob = $request->sf_dob;
        $post->sf_gender = $request->sf_gender;
        $post->sf_email = $request->sf_email;
        $post->sf_religion = $request->sf_religion;
        $post->sf_aadharno = $request->sf_aadharno;
        $post->sf_bloodgroup = $request->sf_bloodgroup;
        $post->sf_nationality = $request->sf_nationality;
        $post->sf_state = $request->sf_state;
        $post->sf_permanentaddress = $request->sf_permanentaddress;
        $post->sf_presentaddress = $request->sf_presentaddress;
        $post->sf_fathername = $request->sf_fathername;
        $post->sf_fatheroccupation = $request->sf_fatheroccupation;
        $post->sf_mothername = $request->sf_mothername;
        $post->sf_motheroccupation = $request->sf_motheroccupation;
        $post->sf_phone = $request->sf_phone;
        $post->sf_designation = $request->sf_designation;
        $post->sf_qualification = $request->sf_qualification;
        $post->sf_experience = $request->sf_experience;
        $post->sf_language = $request->sf_language;
        $post->sf_position = $request->sf_position;
        $post->sf_subject_taken = $request->sf_subject_taken;
        $post->sf_disabledperson = $request->sf_disabledperson;
        $post->sf_profile = $profile;
        $post->sf_image_path = "$profile_path";
        $post->sf_certificate = $certificate;
        $post->sf_file_path = "$certificate_path";
        $post->sf_joindate = $request->sf_joindate;

        $post->save();
        $staff_id = $id;
        // return response($staff_id);
        // $sf_acount =Staffaccount::find($staff_id);
        $sf_acount = Staffaccount::where('staff_id', $staff_id)->first();

        $sf_acount->staff_id = $staff_id;
        $sf_acount->account_no = $request->account_no;
        $sf_acount->account_holder_name = $request->account_holder_name;
        $sf_acount->branch_name = $request->branch_name;
        $sf_acount->branch_code = $request->branch_code;
        $sf_acount->ifsc_code = $request->ifsc_code;
        $sf_acount->bank_address = $request->bank_address;
        $sf_acount->account_type = $request->account_type;

        //  return response($request->account_no);
        // $post->save();
        $sf_acount->save();
        // }
        // DB::table('facilities')->where('propID',$id)->get();
        //  return response($staffid);
        $sf_salary = salary::where('staff_id', $staff_id)->first();

        $sf_salary->staff_id = $staff_id;
        $sf_salary->basic_salary = $request->basic_salary;
        $sf_salary->overtime = $request->overtime;
        $sf_salary->bonus = $request->bonus;
        $sf_salary->allowance = $request->allowance;
        $sf_salary->reduction = $request->reduction;
        $sf_salary->reduction_reason = $request->reduction_reason;
        $sf_salary->net_salary = $request->net_salary;
        $sf_salary->payment_method = $request->payment_type;

        $sf_salary->save();


        return redirect()->back()
            ->with('success', 'Staff Details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        $id = $staff->id;

        $post = Staff::find($id);
        $post->sf_delete = "0";
        $post->save();

        return redirect()->back()
            ->with('success', 'Staff deleted successfully');
    }



    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)
            ->get(["name", "id"]);
        return response()->json($data);
    }



    public function staffsalary()
    {
        $month = date('M Y');

        $salaryChecks = DB::table('staff')
            ->select('sf_name', 'id')
            ->get();

        $salarys = DB::table('salaryexpenses')
            ->join('staff', 'salaryexpenses.staff_id', '=', 'staff.id')
            ->select('salaryexpenses.*', 'staff.sf_name as staffname', 'staff.id as staffid')
            ->where('month', $month)
            ->get();
        // return response( $salarychecks);
        return view('staff.staffsalary', compact('salarys', 'salaryChecks'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function staffsalaryfilter(Request $request)
    {
        $month = $request->month;
        // dd($month);
        $salaryChecks = DB::table('staff')
            ->select('sf_name', 'id')
            ->get();

        $salarys = DB::table('salaryexpenses')
            ->join('staff', 'salaryexpenses.staff_id', '=', 'staff.id')
            ->select('salaryexpenses.*', 'staff.sf_name as staffname', 'staff.id as staffid')
            ->where('month', $month)
            ->get();
        // return response( $salarychecks);
        return view('staff.staffsalary', compact('salarys', 'salaryChecks'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function salaryadd(Request $request)
    {

        $month = date('M Y');
        $todayDate = Carbon::now()->format('Y-m-d');

        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }


        $sf_salary = new Salaryexpense;

        $sf_salary->staff_id = $request->staff_name;
        $sf_salary->date = $todayDate;
        $sf_salary->month = $month;
        $sf_salary->academic_year = $fyear;
        $sf_salary->position = $request->sf_position;

        $sf_salary->basic_salary = $request->basic_salary;
        $sf_salary->overtime = $request->overtime;
        $sf_salary->bonus = $request->bonus;
        $sf_salary->allowance = $request->allowance;
        $sf_salary->reduction = $request->reduction;
        $sf_salary->reduction_reason = $request->reduction_reason;
        $sf_salary->net_salary = $request->net_salary;
        $sf_salary->payment_method = $request->payment_type;
        //  return response($sf_salary);
        // $post->save();

        $sf_salary->save();

        // $id = $request->staff_name;

        // $post = Staff::find($id);
        // $post->salary_status = "0";
        // $post->save();

        // return response($id);
        return redirect()->back()
            ->with('success', 'Staff Salary added successfully');
    }
    public function staffsalaryedit(salary $salary, $staff_id, $date)
    {

        // return response($staff_id);
        $staffs = Staff::where('sf_delete', 1)->get();
        $salarys = Salaryexpense::where('staff_id', $staff_id)->where('date', $date)->first();
        // return response($salarys);
        return view('staff.staffsalaryedit', compact('salarys', 'staffs'));
    }
    public function salaryupdate(Request $request, $staff_id)
    {
// dd($request, $staff_id);
        $sf_salary = Salaryexpense::where('staff_id', $staff_id)->where('date',$request->date)->first();
// dd( $sf_salary);
        // $sf_salary = new salary;
        // return response($request->staff_name);
        // $sf_salary->net_salary = $request->net_salary;
        $sf_salary->staff_id = $request->staff_name;
        $sf_salary->basic_salary = $request->basic_salary;
        $sf_salary->overtime = $request->overtime;
        $sf_salary->bonus = $request->bonus;
        $sf_salary->allowance = $request->allowance;
        $sf_salary->reduction = $request->reduction;
        $sf_salary->reduction_reason = $request->reduction_reason;
        $sf_salary->net_salary = $request->net_salary;
        $sf_salary->payment_method = $request->payment_type;
        //  return response($request->account_no);
        // $post->save();

        $sf_salary->save();



        return redirect()->back()->with('success', 'Staff Salary Updated successfully');

        // return route('/staffsalary');
        //  return redirect()->back();
    }


    public function positiondetails(Request $request)
    {




        $staffposition = $request->input('staffposition');



        $staffs = DB::table('staff')
            ->join('staffpositions', 'staffpositions.sp_id', '=', 'staff.sf_position')
            ->select('staff.*', 'staffpositions.*', 'staff.id as staffsid')
            ->where(['sf_delete' => 1, 'staff.sf_position' => $staffposition])
            ->get();

        return view('staffs.index', compact('staffs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function staffattendance()
    {
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->format('Y-m-d'); // Change the format as needed

        $staffs = DB::table('staffattandances')
            ->join('staff', 'staff.id', '=', 'staffattandances.staff_id')
            ->join('staffpositions', 'staffpositions.sp_id', '=', 'staffattandances.position_id')
            ->join('attendancetypes', 'attendancetypes.tt_id', '=', 'staffattandances.att_id')
            ->select('staffattandances.staff_id', 'staff.id', 'staffpositions.sp_id', 'attendancetypes.tt_id', 'staff.sf_name', 'staffpositions.sp_name', 'attendancetypes.tt_name', 'staffattandances.permission', 'staffattandances.att_year', 'staffattandances.att_month', 'staffattandances.att_date')
            ->where(['staff.sf_delete' => 1, 'staffattandances.position_id' => 1, 'staffattandances.att_date' => $formattedDate])
            ->get();

        return view('staff.staffattendance', compact('staffs'));
    }

    public function todayfilter(Request $request)
    {

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->format('Y-m-d');
        $staffpostion = $request->input('staffpostion');
        $date = $request->input('date');

        $query = DB::table('staffattandances')
            ->join('staff', 'staff.id', '=', 'staffattandances.staff_id')
            ->join('staffpositions', 'staffpositions.sp_id', '=', 'staffattandances.position_id')
            ->join('attendancetypes', 'attendancetypes.tt_id', '=', 'staffattandances.att_id')
            ->select('staffattandances.id as staffattid', 'staffattandances.staff_id', 'staff.id', 'staffpositions.sp_id', 'attendancetypes.tt_id', 'staff.sf_name', 'staffpositions.sp_name', 'attendancetypes.tt_name', 'staffattandances.permission', 'staffattandances.att_year', 'staffattandances.att_month', 'staffattandances.att_date');

        if (!empty($staffpostion)) {
            $query->where('staffattandances.position_id', $staffpostion);
        }

        if (!empty($date)) {
            $query->where('staffattandances.att_date', $date);
        } else {
            $query->where(['staffattandances.att_date' => $formattedDate, 'staffattandances.position_id' => $staffpostion,]);
        }

        $staffs = $query->where('staff.sf_delete', 1)->get();

        return view('staff.staffattendance', compact('staffs'));
    }

    public function takeattendance()
    {
        return view('staff.takeattendance');
    }

    public function takeattendancefilter(Request $request)
    {
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }
        $att = Attendancetype::all();
        $lastdateObject = DB::table('staffattandances')->select('att_date')->orderBy('id', 'desc')->first();

        if ($lastdateObject) {
            $lastdate = $lastdateObject->att_date;
            $encoded_lastdate = htmlspecialchars($lastdate);
        } else {
            // Handle the case when there are no records in the table
            $encoded_lastdate = "";
        }

        $staffpostion = $request->input('staffpostion');

        $staffs = DB::table('staff')
            ->join('staffpositions', 'staffpositions.sp_id', '=', 'staff.sf_position')
            ->select('staffpositions.sp_id', 'staffpositions.sp_name', 'staff.id', 'staff.sf_name')
            ->where(['sf_delete' => 1, 'staff.sf_position' => $staffpostion])
            ->get();

        return view('staff.takeattendance', compact('staffs', 'fyear', 'att'));
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
            $STAFFPOSITION = $request->input('staffposition');


            $checkatt = Staffattandance::where(['att_date' => $DATE, 'position_id' => $STAFFPOSITION])->first();
            if ($checkatt) {
                return redirect()->back()->with('failed', 'Already Take Attendance');
            } else {
                $STAFFNAME = $request->input('staffname');
                $ATTENDANCE = $request->input('attendance');
                $PERMISSION = $request->input('permission');
                $MONTH = now()->format('Y-m');

                $savearray = [];
                if ($STAFFNAME) {
                    for ($i = 0; $i < count($STAFFNAME); $i++) {
                        $savearray[] = [
                            'staffposition' => $STAFFPOSITION[$i],
                            'staffname' => $STAFFNAME[$i],
                            'attendance' => $ATTENDANCE[$i],
                            'permission' => $PERMISSION[$i],
                        ];
                    }
                } else {
                    return redirect()->back()->with('failed', 'First You select staff Position');
                }



                foreach ($savearray as $data) {
                    Staffattandance::insert([
                        'staff_id' => $data['staffname'],
                        'position_id' => $data['staffposition'],
                        'att_id' => $data['attendance'],
                        'permission' => $data['permission'],
                        'att_year' => $fyear,
                        'att_date' => $DATE,
                        'att_month' => $MONTH,

                    ]);
                }
                return redirect()->back()->with('success', 'Save successfull');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not Save');
        }
    }

    public function showattendance()
    {
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        $today = today();
        $dates = [];

        for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
        }
        $staffsatt = DB::table('staffattandances')
            ->join('staff', 'staff.id', '=', 'staffattandances.staff_id')
            ->select('staff.id', 'staff.sf_name', 'staffattandances.staff_id')
            ->where(['sf_delete' => 1, 'staff.sf_position' => 1, 'att_year' => $fyear])
            ->distinct()
            ->get();

        // $date_picker = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
        // $check_attd = DB::table('staffattandances')
        //     ->join('staff', 'staff.id', '=', 'staffattandances.staff_id')
        //     ->where('id', $staffsatt->staff_id)
        //     ->where('att_date', $date_picker)
        //     ->first();


        return view('staff.filterattendance', compact('dates', 'staffsatt'));
    }

    public function filterattendance(Request $request)
    {
        // Calculate the current fiscal year based on the current month and year
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
        $staffpostion = $request->input('staffpostion');
        $MONTH = now()->format('m-Y');

        // Query to retrieve staff attendance data and organize it into the $attendanceData array
        $staffsatt = DB::table('staffattandances')
            ->join('staff', 'staff.id', '=', 'staffattandances.staff_id')
            ->select('staff.id', 'staff.sf_name', 'staffattandances.staff_id as stid')
            ->where(['sf_delete' => 1, 'staff.sf_position' => $staffpostion, 'att_year' => $fyear])
            ->distinct()
            ->get();

        $attendanceData = [];

        foreach ($staffsatt as $staff) {
            $attendanceData[$staff->stid]['name'] = $staff->sf_name;
            $attendanceData[$staff->stid]['sid'] = $staff->stid;

            foreach ($dates as $date) {
                $check_attd = DB::table('staffattandances')
                    ->where('staff_id', $staff->stid)
                    ->where(['att_date' => $date, 'att_year' => $fyear])
                    ->first();

                $attendanceData[$staff->stid]['attendance'][$date] = $check_attd ? $check_attd->att_id : null;
            }
        }

        // // Query to count the number of present staff members
        // $staffpresent = DB::table('staffattandances')
        //     ->join('staff', 'staff.id', '=', 'staffattandances.staff_id as stid')
        //     ->whereIn('stid', $staffsatt->pluck('stid'))
        //     ->where(['sf_delete' => 1, 'att_id' => 1, 'att_month' => $MONTH])
        //     ->count();

        //     dd($staffpresent);

        // Returning the view with the data
        return view('staff.filterattendance', compact('dateses', 'attendanceData', 'dates'));
    }




    public function staffattendanceedit($id)
    {
        $att = Attendancetype::all();
        $staffedit = DB::table('staffattandances')
            ->join('staff', 'staff.id', '=', 'staffattandances.staff_id')
            ->join('staffpositions', 'staffpositions.sp_id', '=', 'staffattandances.position_id')
            ->join('attendancetypes', 'attendancetypes.tt_id', '=', 'staffattandances.att_id')
            ->select('staffattandances.id  as staffattid', 'staffattandances.staff_id', 'staff.id', 'staffpositions.sp_id', 'attendancetypes.tt_id', 'staff.sf_name', 'staffpositions.sp_name', 'attendancetypes.tt_name', 'staffattandances.permission', 'staffattandances.att_year', 'staffattandances.att_month', 'staffattandances.att_date')
            ->where(['staffattandances.id' => $id])
            ->first();
        return view('staff.staffattendanceedit', compact('staffedit', 'att'));
    }
    public function staffattendanceupdate(Request $request, $id)
    {
        try {
            $attendance = $request->input('attendance');
            $permission = $request->input('permission');

            Staffattandance::where('id', $id)->update(['att_id' => $attendance, 'permission' => $permission]);

            return redirect()->back()->with('success', 'Update successfull');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not Update');
        }
    }

    public function staffsalaryview()
    {
        return view('staff.staffsalaryview');
    }

    public function staffmonthlycount()
    {
        return view('staff.stafftotalATT');
    }
    public function staffmonthlycountfilter(Request $request)
    {
        $currentMonth = date('m');
        $currentYear = date('Y');
        $shortYear = date('y');


        // Determine the fiscal year based on the selected month
        if ($currentMonth >= "06") {
            $fiscalYear = $currentYear . '-' . ($shortYear + 1);
        } else {
            $fiscalYear = ($currentYear - 1) . '-' . $shortYear;
        }


        $selectedMonth = $request->input('monthid');
        $selectedStaffPosition = $request->input('staffpostion');
        $MONTH = now()->format('Y-m');
        // Fetch staff positions
        $positions = DB::table('staffpositions')
            ->select('sp_id', 'sp_name')
            ->get();

        // Fetch staff name based on the selected staff position
        $staffName = "No class selected";
        if ($selectedStaffPosition) {
            $selectedStaffPositionData = DB::table('staffpositions')
                ->where('sp_id', $selectedStaffPosition)
                ->select('sp_name')
                ->first();

            if ($selectedStaffPositionData) {
                $staffName = $selectedStaffPositionData->sp_name;
            }
        }


        // Fetch staff attendance data
        $staffAttendanceData = DB::table('staffattandances')
            ->join('staff', 'staff.id', '=', 'staffattandances.staff_id')
            ->select('staff.id', 'staff.sf_name', 'staffattandances.staff_id as stid')
            ->where(['sf_delete' => 1, 'staff.sf_position' => $selectedStaffPosition])
            ->distinct()
            ->get();

        $attendanceData = [];

        foreach ($staffAttendanceData as $staff) {
            $attendanceData[$staff->stid]['name'] = $staff->sf_name;
            $attendanceData[$staff->stid]['sid'] = $staff->stid;

            $checkPresences = DB::table('staffattandances')
                ->where('staffattandances.staff_id', $staff->stid)
                ->where('att_id', 1)
                ->where('att_month', $selectedMonth)
                ->count();
            $checkAbsences = DB::table('staffattandances')
                ->where('staffattandances.staff_id', $staff->stid)
                ->where('att_id', 2)
                ->where('att_month', $selectedMonth)
                ->count();

            // Store the presence and absence counts in the attendanceData array
            $attendanceData[$staff->stid]['presences'] = $checkPresences;
            $attendanceData[$staff->stid]['absences'] = $checkAbsences;
        }

        // dd($attendanceData);
        return view('staff.stafftotalATT', compact('positions', 'fiscalYear', 'attendanceData', 'staffName'));
    }

    public function getstaffbyposition(Request $request)
    {

        $month = date('M Y');

        // Get staff with no salary data for the current month
        $data['staff'] = DB::table('staff')
            ->select('staff.id', 'staff.sf_name')
            ->where("sf_position", $request->sf_position)
            ->whereNotIn('staff.id', function ($query) use ($month) {
                $query->select('staff.id')
                    ->from('staff')
                    ->join('salaryexpenses', 'salaryexpenses.staff_id', '=', 'staff.id')
                    ->where('month', $month);
            })
            ->get();

        // Get salary data for staff for the current month
        $salarys = DB::table('salaryexpenses')
            ->join('staff', 'salaryexpenses.staff_id', '=', 'staff.id')
            ->select('salaryexpenses.*', 'staff.sf_name as staffname', 'staff.id as staffid')
            ->where('month', $month)
            ->get();

        return response()->json($data);
    }
    
        public function getSalaryDetails($staffId)
    {
        try {
            $staffSalaries = Salary::where('staff_id', $staffId)->get();

            return response()->json(['success' => true, 'data' => $staffSalaries]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error fetching salary details']);
        }
    }
}
