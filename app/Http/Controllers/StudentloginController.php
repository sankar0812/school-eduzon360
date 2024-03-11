<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Enews;
use App\Models\Student;
use App\Models\Enotices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StudentloginController extends Controller
{


    public function student_login()
    {

        return view('studentdetails.login.studentlogin');
    }
    // parent or student
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|max:10',
            'dob' => 'required|date',
        ]);

        // $class = $request->input('class');
        $name = $request->input('name');
        $phone = $request->input('phone');
        $dob = $request->input('dob');

        $student = Student::where(['s_name' => $name, 's_phone' => $phone, 's_dob' => $dob])->first();

        if ($student) {
            // Student details match, set session values
            $request->session()->put('studentid', $student->id);
            $request->session()->put('studentname', $student->s_name);

            $studentdetails = Student::where(['id' => $student->id, 's_loginstatus' => 1])->first(); // Fetch student details using ID

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

            $studentdetails = DB::table('students')
                ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
                ->where(['students.id' => $student->id, 'students.s_loginstatus' => 1])->first();

            return view('studentdetails.studenthome', compact('studentdetails', 'enewview', 'enoticesview', 'yesenewview', 'yesenoticesview', 'enewcount', 'enoticescount'))->with('success', 'Welcome to homepage');
        } else {
            // Details don't match, redirect with error message
            return redirect()->back()->with('failed', 'Details do not match');
        }
    }



    public function logout()
    {
        if (Session::has('studentid')) {
            Session::pull('studentid');
        }
        return view('studentdetails.login.studentlogin');
    }
}
