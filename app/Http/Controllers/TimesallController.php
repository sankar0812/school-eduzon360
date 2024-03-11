<?php

namespace App\Http\Controllers;

use App\Models\Dailyclasstime;
use App\Models\Examtime;
use Illuminate\Http\Request;

class TimesallController extends Controller
{
    public function timeview()
    {
        $examtime = Examtime::all();
        $classtime = Dailyclasstime::all();

        $classlasttime = Dailyclasstime::orderBy('id', 'desc')->first();

        return view('time.time', compact('classtime', 'examtime',));
    }


    public function classtimeadd(Request $request)
    {
        $classsection = $request->input('classsection');
        $classname = $request->input('classname');
        Dailyclasstime::insert(['classsection' => $classsection, 'classname' => $classname]);
        return redirect()->back();
    }

    public function classtimeedit($id)
    {
        $classtimeedit = Dailyclasstime::where('id', $id)->first();
        return view('time.classtimeedit', compact('classtimeedit'));
    }

    public function classtimeupdate(Request $request, $id)
    {
        $classsection = $request->input('classsection');
        $classname = $request->input('classname');

        Dailyclasstime::where('id', $id)->update(['classsection' => $classsection, 'classname' => $classname]);
        return redirect()->back();
    }


    public function examtimeedit($id)
    {
        $examtimeedit = Examtime::where('id', $id)->first();
        return view('time.examtimeedit', compact('examtimeedit'));
    }


    public function examtimeupdate(Request $request, $id)
    {
        $section = $request->input('section');
        $time = $request->input('time');

        Examtime::where('id', $id)->update(['et_name' => $section, 'time' => $time]);
        return redirect()->back();
    }
}
