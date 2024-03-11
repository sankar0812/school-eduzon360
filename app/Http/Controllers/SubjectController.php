<?php

namespace App\Http\Controllers;

use App\Models\subjects;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = subjects::get();

        return view('subjects.index', compact('subjects'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('subjects.create');
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
            'name',
        ]);

        subjects::create($request->all());

        return redirect()->back()
            ->with('success', 'subjects created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function show(subjects $subjects)
    {
        return view('subjects.show', compact('subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function edit($subjects)
    {


        $subjectsview = subjects::get();

        $subjectsedit = subjects::where('id', $subjects)->first();

        return view('subjects.edit', compact('subjectsview', 'subjectsedit'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $subjects)
    {
        $request->validate([
            'name',

        ]);

        subjects::where('id', $subjects)->update(['name' => $request->name]);
        
           $subjects = subjects::get();
 return view('subjects.index',compact('subjects'))
            ->with('success', 'subjects updated successfully');
        // return redirect()->back()
        //     ->with('success', 'subjects updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\subjects  $subjects
     * @return \Illuminate\Http\Response
     */
    public function destroy(subjects $subjects)
    {
        $subjects->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'subjects deleted successfully');
    }
}
