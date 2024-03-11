<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamTypes;

class ExamtypeController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examtypes = ExamTypes::get();

        return view('exams_type.index', compact('examtypes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('exams_type.create');
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

        ExamTypes::create($request->all());

        return redirect()->back()
            ->with('success', 'ExamTypes created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExamTypes  $ExamTypes
     * @return \Illuminate\Http\Response
     */
    public function show(ExamTypes $examtypes)
    {
        return view('exams_type.show', compact('examtypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExamTypes  $ExamTypes
     * @return \Illuminate\Http\Response
     */
    public function edit($examtypes)
    {
        $examtypesview = ExamTypes::get();

        $examtypesedit = ExamTypes::where('id', $examtypes)->first();
        return view('exams_type.edit', compact('examtypesedit', 'examtypesview'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExamTypes  $ExamTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $examtypes)
    {
        $request->validate([
            'name' => 'required', // Add any validation rules you need
        ]);

        ExamTypes::where('id', $examtypes)->update(['name' => $request->name]);

        return redirect()->back()
            ->with('success', 'ExamTypes updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExamTypes  $ExamTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamTypes $examtypes)
    {
        $examtypes->delete();

        return redirect()->route('exams_type.index')
            ->with('success', 'ExamTypes deleted successfully');
    }
}
