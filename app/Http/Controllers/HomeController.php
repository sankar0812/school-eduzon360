<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Enews;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Enotices;
use App\Models\expenses;
use App\Models\Schoolinfo;
use App\Models\newadmission;
use Illuminate\Http\Request;
use App\Models\Staffposition;
use App\Models\Staffattandance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        // $month= date('M Y');

        $schoolinfo = Schoolinfo::first();
        $students = DB::table('students')
            ->where('s_delete', 1)
            ->count();
        $staffcount = DB::table('staff')
            ->where(['sf_delete' => 1, 'sf_position' => 1])
            ->count();
        $monthlyexpencecount = DB::table('expenses')
            ->select(DB::raw("SUM(amount) as total"), 'date')
            ->where(['date' => $todayDate])
            ->groupby('date')
            ->first();
        if ($monthlyexpencecount == null) {
            $monthlyexpencecount = 0;
        } else {
            $monthlyexpencecount =  $monthlyexpencecount->total;
        }
        // return response($month);
        //  dd($monthlyexpencecount);
        
            
         $todaypayment = DB::table('fees_collections')
            ->select(DB::raw("SUM(amount) as totalfeespaid"), 'paid_date')
            ->where(['paid_date' => $todayDate])
            ->groupby('paid_date')
            ->first();
        // dd($todaypayment);
        if ($todaypayment == null) {
            $todaypayment = 0;
        } else {
            $todaypayment =  $todaypayment->totalfeespaid;
        }
        // return response($todaypayment);
        $studentCountsByClass = newadmission::select('academic_year', DB::raw('count(*) as count'))
            ->groupBy('academic_year')
            ->get();

        $studentCountsByClassboysandgirls = Student::selectRaw('class_sections.id AS section_id,
            class_sections.c_class,
            SUM(CASE WHEN students.s_gender = "Male" THEN 1 ELSE 0 END) AS boys_count,
            SUM(CASE WHEN students.s_gender = "Female" THEN 1 ELSE 0 END) AS girls_count')
            ->join('class_sections', 'students.s_classid', '=', 'class_sections.id')
            ->groupBy('class_sections.id', 'class_sections.c_class')
            ->orderBy('class_sections.id', 'ASC')
            ->get();

        // dd( $studentCountsByClass,$studentCountsByClassboysandgirls);

        $staffPositions = Staffposition::all();

        // Initialize an empty array to store data
        $data = [];

        // Loop through each staff position
        foreach ($staffPositions as $position) {
            // Fetch absent list for the current staff position
            $absentList = Staffattandance::where('position_id', $position->id)
                ->where('att_id', '2')
                ->where('att_date', $todayDate)
                ->get(['att_date', 'att_status']);

            // Get the count of absences for the current staff position
            $absenceCount = $absentList->count();

            // Structure the data for the bubble chart
            $data[] = [
                'name' => $position->sp_name,
                'absenceCount' => $absenceCount,
                'days' => $absentList->map(function ($absent) {
                    return [
                        'date' => $absent->att_date,
                        'absences' => 1, // You may adjust this based on your business logic
                    ];
                }),
            ];
            // dd($absent_count);

        }






        // $months = DB::table('paidfees')->select('paid_month')->groupby('paid_month')->get();

        // Fetch income data from the database
        $incomeData = DB::table('fees_collections')
            ->join('expenses', 'expenses.date', '=', 'fees_collections.paid_date')
            ->select(DB::raw("SUM(fees_collections.amount) as totalincome"), DB::raw("SUM(expenses.amount) as totalexpense"), 'fees_collections.paid_date')
            ->groupby('fees_collections.paid_date')
            ->get();

        // Fetch expense data from the database
        // $expenseData = DB::table('expenses')->select(DB::raw("SUM(amount) as totalexpense"))->groupby('month')->get();

        // return view('income-expense-chart', compact('months', 'incomeData', 'expenseData'));

        // dd($incomeData);

        // return response($studentCountsByClass);

        return view('adminHome', compact('schoolinfo', 'students', 'staffcount', 'monthlyexpencecount', 'todaypayment', 'studentCountsByClass', 'studentCountsByClassboysandgirls', 'incomeData', 'data'));
    }

    // public function studentChart()
    // {


    //     return view('student-chart', compact('studentCountsByClass'));
    // }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function classteacherHome()
    {
        $id = Auth::user()->id;
        $staff = Staff::where('login_id', $id)->first();
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

        return view('classteacherHome', compact('staff', 'enewview', 'enoticesview', 'yesenewview', 'yesenoticesview', 'enewcount', 'enoticescount'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clerkHome()
    {
        $schoolinfo = Schoolinfo::first();

        $students = DB::table('students')
            ->where('s_delete', 1)
            ->count();
        $staffcount1 = DB::table('staff')
            ->where(['sf_delete' => 1, 'sf_position' => 1])
            ->count();

        $staffcount2 = DB::table('staff')
            ->where(['sf_delete' => 1, 'sf_position' => 2])
            ->count();
        $staffcount3 = DB::table('staff')
            ->where(['sf_delete' => 1, 'sf_position' => 3])
            ->count();
        $staffcount4 = DB::table('staff')
            ->where(['sf_delete' => 1, 'sf_position' => 4])
            ->count();
// <<<<<<< bala
//         return view('clerkHome', compact('students', 'staffcount1', 'staffcount2', 'staffcount3', 'staffcount4', 'schoolinfo'));
// =======
$studentCountsByClass = newadmission::select('academic_year', DB::raw('count(*) as count'))
->groupBy('academic_year')
->get();

            $studentCountsByClassboysandgirls = Student::selectRaw('class_sections.c_class,class_sections.id,
            SUM(CASE WHEN students.s_gender = "Male" THEN 1 ELSE 0 END) AS boys_count, 
            SUM(CASE WHEN students.s_gender = "Female" THEN 1 ELSE 0 END) AS girls_count')
            ->join('class_sections', 'students.s_classid', '=', 'class_sections.id')
            ->groupBy('class_sections.c_class','class_sections.id')
            ->orderBy('class_sections.id','ASC')
            ->get();


        return view('clerkHome', compact('studentCountsByClass','studentCountsByClassboysandgirls','students', 'staffcount1', 'staffcount2', 'staffcount3', 'staffcount4','schoolinfo'));

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function frontofficeHome()
    {
        $schoolinfo = Schoolinfo::first();

        $todayDate = Carbon::now()->format('Y-m-d');
        $totalvisitor = DB::table('visitors')->count();
        $todayvisitor = DB::table('visitors')->where('date', $todayDate)->count();

        return view('frontofficeHome', compact('totalvisitor', 'todayvisitor', 'schoolinfo'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function accountanthome()
    {
        $schoolinfo = Schoolinfo::first();

        $todayDate = Carbon::now()->format('Y-m-d');
        $monthlyexpencecount = DB::table('expenses')

            ->select(DB::raw("SUM(amount) as total"), 'month')
            ->where(['date' => $todayDate])
            ->groupby('month')
            ->first();

     
        if ($monthlyexpencecount == null) {
            $monthlyexpencecount = 0;
        } else {
            $monthlyexpencecount =  $monthlyexpencecount->total;
        }
        // return response($month);
        //  dd($monthlyexpencecount);
        $todaypayment = DB::table('paidfees')

            ->select(DB::raw("SUM(totalpaidfees) as totalfeespaid"), 'paid_date')
            ->where(['paid_date' => $todayDate])
            ->groupby('paid_date')
            ->first();
        // dd($todaypayment);
        if ($todaypayment == null) {
            $todaypayment = 0;
        } else {
            $todaypayment =  $todaypayment->totalfeespaid;
        }
        return view('accountantHome', compact('monthlyexpencecount', 'todaypayment', 'schoolinfo'));
    }
}
