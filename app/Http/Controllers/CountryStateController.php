<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Country,State};

class CountryStateController extends Controller
{
    //
    // public function index()
    // {
    //     $data['countries'] = Country::get(["name","id"]);
    //     return view('students.create',$data);
    // }
    // public function show()
    // {
    //     $data['countries'] = Country::get(["name","id"]);
    //     return view('students.edit',$data);
    // }
    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)
                    ->get(["name","country_id"]);
        return response()->json($data);
    }

}
