<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Hashpass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SchoolstaffloginController extends Controller
{
    public function stafflogindetails()
    {

        $userstaff = User::where(['type' => 2, 'delete' => 1])->get();
        $staff = Staff::where(['sf_position' => 1])
            ->where('login_id', null)
            ->select('sf_email', 'sf_name')
            ->get();

        return view('schoollogins.stafflogin', compact('staff', 'userstaff'));
    }

    public function staffregister(Request $request)
    {
        try {
            // dd($request);
            $request->validate([
                'type' => ['required', 'integer'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // Check if email is unique in the users table
                'password' => ['required', 'string', 'min:8'],
            ]);

            $type = $request->input('type');
            $name = $request->input('name');
            $email = $request->input('email');
            $password = Hash::make($request->input('password'));
            $nohash = $request->input('password');

            // Insert the user record
            $userid = User::insertGetId([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'type' => $type
            ]);

            $hash = Hashpass::insert([
                'loginid' => $userid,
                'ha_name' => $nohash,
            ]);

            // Update the login_id in the Staff table
            Staff::where([
                'sf_name' => $name,
                'sf_email' => $email
            ])->update(['login_id' => $userid]);

            return redirect()->back()->with('success', 'Save successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'failed');
        }
    }
    public function loginstauts($id)
    {
        try {

            $loginstatus = User::where(array('id' => $id))->select('status')->first();

            switch ($loginstatus->status) {
                case 1:
                    $status = 0;
                    break;
                case 0:
                    $status = 1;
                    break;
                default:

                    break;
            }
            User::where(array('id' => $id))->update(['status' => $status]);
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'not change');
        }
    }



    public function staffloginedit($id)
    {

        $staffdetails = Staff::select('sf_name', 'sf_email')->get();
        $loginedit = DB::table('users')
            ->join('hashpasses', 'hashpasses.loginid', '=', 'users.id')
            ->where('users.id', $id)
            ->select('users.id as userid','users.name','users.email','hashpasses.ha_name','users.type')
            ->first();

        // dd($loginedit);
        return view('schoollogins.staffloginedit', compact('loginedit', 'staffdetails'));
    }

    public function staffloginupdate(Request $request, $id)
    {
        // dd($request);
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $nohash = $request->input('password');

        $userdelete = User::where('id', $id)->update(['name' => $name, 'email' => $email, 'password' => $password]);

        $hash = Hashpass::where('loginid', $id)->update([
            'ha_name' => $nohash,
        ]);

        if ($userdelete) {
            return redirect()->back()->with('success', 'update successfully');
        } else {
            return redirect()->back()->with('failed', 'update failed');
        }

        return view('schoollogins.staffloginedit');
    }


    public function stafflogindelete($id)
    {
        $userdelete = User::where('id', $id)->update(['status' => 0, 'delete' => 0]);
        if ($userdelete) {
            return redirect()->back()->with('success', 'delete successfully');
        } else {
            return redirect()->back()->with('failed', 'delete failed');
        }
    }

    public function studentlogindetails()
    {
        return view('schoollogins.studentloginlist');
    }

    public function studentloginfilter(Request $request)
    {
        $classid = $request->input('classfilter');
        $classfilter = DB::table('students')
            ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
            ->where('s_classid', $classid)
            ->select('class_sections.c_class', 'students.id', 'students.s_name', 'students.s_classid', 'students.s_loginstatus', 'students.s_dob')
            ->get();

        return view('schoollogins.studentloginlist', compact('classfilter'));
    }

    public function studentloginstatus($id)
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
}
