<?php

namespace App\Http\Controllers;

use App\Models\Visitors;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function visitor()
    {
        // return view('visitor.visitor');
        $visitors = Visitors::orderBy('id', 'Desc')->get();
        if ($visitors->isEmpty()) {
            $visitors = [];
            $visit = 0;
        } else {
            $visitors =  $visitors;
            $visit = 1;
        }
        // return response($visitors);
        return view('visitor.visitor', compact('visitors', 'visit'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function visitoradd(Request $request)
    {
        $post = new Visitors;

        $post->visitor_name = $request->visitorname;
        $post->date = $request->date;
        $post->intime = $request->intime;
        $post->outtime = $request->outtime;
        $post->phone = $request->phone;
        $post->staff_to_meet = $request->staff_to_meet;
        $post->visitor_type = $request->visitor_type;
        $post->purpose = $request->purpose;

        $post->save();


return redirect()->back()
        // return redirect()->route('visitor.index')

            ->with('success', 'Visitor added successfully.');
    }
    public function visitoredit()
    {
        return view('visitor.visitoredit');
    }
    public function visitorupdate(Request $request)
    {
        // $post = new Visitors;
        $id = $request->id;
        $post = Visitors::find($id);

        $post->outtime = $request->outtime;
        $post->save();


        return redirect()->back()
        // return redirect()->route('visitor.index')
            ->with('success', 'Visitor Out Time Updated successfully.');
    }
}
