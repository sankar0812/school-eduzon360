<?php

namespace App\Http\Controllers\Api;

use App\Models\Enews;
use App\Models\Student;
use App\Models\Enotices;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentloginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|max:10',
            'dob' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()]);
        }
        $name = $request->input('name');
        $phone = $request->input('phone');
        $dob = $request->input('dob');

        // $name = 'franklin mesak';
        // $phone = '9876543210';
        // $dob = '2019-02-05';


        $student = Student::where(['s_name' => $name, 's_phone' => $phone, 's_dob' => $dob])->first();

        if ($student) {
            // Student details match, set session values
            // $request->session()->put('studentid', $student->id);
            // $request->session()->put('studentname', $student->s_name);

            // $todayDate = Carbon::now()->format('Y-m-d');
            // $currentDate = Carbon::now();
            // $yesterdayDate = $currentDate->subDay();
            // $yesterdayDateFormatted = $yesterdayDate->format('Y-m-d');

            // $enewview = Enews::where(['date' => $todayDate, 'status' => 1])->get();
            // $enoticesview = Enotices::where(['date' => $todayDate, 'status' => 1])->get();

            // $yesenewview = Enews::where(['date' => $yesterdayDateFormatted, 'status' => 1])->get();
            // $yesenoticesview = Enotices::where(['date' => $yesterdayDateFormatted, 'status' => 1])->get();

            // $enewcount = Enews::where(['date' => $todayDate, 'status' => 1])->count();
            // $enoticescount = Enotices::where(['date' => $todayDate, 'status' => 1])->count();

            $studentdetails = DB::table('students')
                // ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
                ->select('students.s_admissionno', 'students.s_name')
                ->where(['students.id' => $student->id, 'students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->first();

            return response()->json(
                $studentdetails
            );
        } else {
            // Details don't match, return an error response
            return response()->json([
                'success' => false,
                'message' => 'Details do not match',
            ], 401); // You can choose an appropriate HTTP status code
        }
    }

    public function logins(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required|max:10',
            ]);
            if ($validator->fails()) {
                return response(['errors' => $validator->errors()->all()]);
            }
            $phone = $request->input('phone');
            $student = Student::where(['s_phone' => $phone,])->select('s_phone')->distinct()->first();

            if ($student) {
                $studentdetails = DB::table('students')
                    ->select('students.s_admissionno', 'students.s_name')
                    ->where(['students.s_phone' => $student->s_phone, 'students.s_loginstatus' => 1, 's_status' => 1, 's_delete' => 1])->get();
             
            }
            return response()->json(
                ['Studentdetails' => $studentdetails]
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Details do not match',
            ], 401);
        }
    }


    public function loginotpsent(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required|max:10',
            ]);
            if ($validator->fails()) {
                return response(['errors' => $validator->errors()->all()]);
            }
            $phone = $request->input('phone');
            // $phoneno = '9487935654';
            $student = Student::where(['s_phone' => $phone,])->select('s_phone')->distinct()->first();





            if ($student) {
                // Generate a random 6-digit OTP
                $otp = rand(100000, 999999);
                $student = Student::where(['s_phone' => $phone,])->update(['s_otpvalue' => $otp]);
        

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'http://instantalerts.in/api/smsapi');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
                'key' => '77ac8ccf4f533a00577134b37a4de32b',
                'route' => '2',
                'sender' => 'INSTNA',
                'number' => $phone ,
                'templateid' => '1307165916460516347',
                'sms' => 'Your OTP for ideaux is '.$otp.'. Please do not share this OTP. INSTNA'
            )));
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $response = curl_exec($ch);
            
            if (curl_errno($ch)) {
                echo 'Error: ' . curl_error($ch);
            }
            
            curl_close($ch);
            
            
          
            
        }
            return response()->json(
                [
                    'phone' => $phone,
                    'otpvalue' => $otp,
                    'response' => $response,
                     'success' => true,
                    'message' => 'sent otp Success',
                ]
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Details do not match',
            ], 401);
        }
    }

    public function checkotplogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone' => 'required|max:10',
                'checkotp' => 'required',
            ]);
        
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()], 400);
            }
        
            $phone = $request->input('phone');
            $otpvalue = $request->input('checkotp');
        
            $students = Student::where(['s_phone' => $phone, 's_otpvalue' => $otpvalue])->select('s_admissionno', 's_name')->get();
        
            if ($students->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Details do not match',
                ], 401);
            }
        
            return response()->json([
                'students' => $students,
                'success' => true,
            ]);
        
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred',
            ], 500);
        }
        
    }
}
