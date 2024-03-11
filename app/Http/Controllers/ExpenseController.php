<?php

namespace App\Http\Controllers;

use App\Models\expenses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{


    public function enterexpense()
    {

        return view('expense.enterexpense');

    }


    public function dailyexpense()
    {

        $todayDate = Carbon::now()->format('Y-m-d');
        $expenses = expenses::where('date', $todayDate)->get();
        $totalexpense = DB::table("expenses")
	    ->select(DB::raw("SUM(amount) as total"))
        ->where('date', $todayDate)
        // ->groupby('date')
	    ->first();



        return view('expense.dailyexpense', compact('expenses','totalexpense'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function previousexpense(Request $request)
    {
        $todayDate = $request->date;
        $expenses = expenses::where('date', $todayDate)->get();
        $totalexpense = DB::table("expenses")
	    ->select(DB::raw("SUM(amount) as total"))
        ->where('date', $todayDate)
	    ->first();

        return view('expense.dailyexpense', compact('expenses','totalexpense'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function monthlyexpense()
    {
        $month= date('M Y');
        // $expenses = expenses::select('month','amount')
        // ->where('month', $month)
        // ->sum('amount');

        $expenses = DB::table("expenses")
	    ->select(DB::raw("SUM(amount) as total"),'date')
        // ->select(DB::raw("*"),'year')
        ->where('month', $month)
        ->groupBy('date')
	    ->get();
        $totalexpense = DB::table("expenses")
	    ->select(DB::raw("SUM(amount) as total"))
        // ->select(DB::raw("*"),'month',)
        ->where('month', $month)
        // ->group('month')
	    ->first();
        // dd($totalexpense);

        $months = expenses::select('month')
        ->groupBy('month')
        ->get();

        return view('expense.monthlyexpense', compact('expenses','months','totalexpense'))
        ->with('i', (request()->input('page', 1) - 1) * 5);


    }
    public function previousmonth(Request $request)
    {
        $month= $request->date;
        $expenses = DB::table("expenses")
	    ->select(DB::raw("SUM(amount) as total"),'date')
        ->where('month', $month)
        ->groupBy('date')
	    ->get();


        $totalexpense = DB::table("expenses")
	    ->select(DB::raw("SUM(amount) as total"),'month')
        // ->select(DB::raw("*"),'month',)
        ->where('month', $month)
        ->groupby('month')
	    ->first();




        $months = expenses::select('month')
        ->groupBy('month')
        ->get();

        return view('expense.monthlyexpense', compact('expenses','months','totalexpense'))
        ->with('i', (request()->input('page', 1) - 1) * 5);


    }
    public function yearlyexpense()
    {
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }


        // $todayDate = Carbon::now()->format('Y-m-d');
        $totalexpense = DB::table("expenses")
	    ->select(DB::raw("SUM(amount) as total"))
        ->where('year', $fyear)
        // ->groupBy('year')
	    ->first();

     

        $expenses = DB::table("expenses")
	    ->select(DB::raw("SUM(amount) as total"),'month')
        // ->select(DB::raw("*"),'year')
        ->where('year', $fyear)
        ->groupBy('month')
	    ->get();

    //    dd($totalexpense);

        $years = expenses::select('year')
        ->groupBy('year')
        ->get();

        return view('expense.yearlyexpense', compact('expenses','years','totalexpense'))
        ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    public function previousyear(Request $request)
    {
        $year =$request->date;

        // $todayDate = Carbon::now()->format('Y-m-d');
        $totalexpense = DB::table("expenses")
	    ->select(DB::raw("SUM(amount) as total"),'year')
        ->where('year', $year)
        ->groupBy('year')
	    ->first();



        $expenses = DB::table("expenses")
	    ->select(DB::raw("SUM(amount) as total"),'month')
        // ->select(DB::raw("*"),'year')
        ->where('year', $year)
        ->groupBy('month')
	    ->get();

        $years = expenses::select('year')
        ->groupBy('year')
        ->get();

        return view('expense.yearlyexpense', compact('expenses','years','totalexpense'))
        ->with('i', (request()->input('page', 1) - 1) * 5);

    }
    public function expenseedit(Request $request)
    {
        $id = $request->id;
        $expense = expenses::find($id);
    //     $year =session()->get('fyear');
    //    $value= date('M Y');

// return response($year);

        return view('expense.expenseedit',compact('expense'));
    }


    public function expenseadd(Request $request)
    {

        $value= date('M Y');
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }


        $post = new expenses;
        $post->date = $request->date;
        $post->account_type = $request->account_type;
        $post->name = $request->name;
        $post->reason = $request->reason;
        $post->category = $request->category;
        $post->amount = $request->amount;
        $post->month =  $value;
        $post->year = $fyear;
        $post->save();

        // return response($post);
        // return redirect()->route('enews.index');
        return redirect()->back()->with('success','Save successfully');
    }
    public function expenseupdate(Request $request)
    {

        $id = $request->id;
        $post = expenses::find($id);
        // $post = new expenses;
        //   return response($request);
        $post->date = $request->date;
        $post->account_type = $request->account_type;
        $post->name = $request->name;
        $post->reason = $request->reason;
        $post->category = $request->category;
        $post->amount = $request->amount;
        $post->save();

        // return response($post);
        // return redirect()->route('enews.index');
        return redirect()->back()->with('success','update successfully');
    }


}
