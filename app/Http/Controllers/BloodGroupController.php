<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentController;
use App\Models\BloodGroup;
use Illuminate\Http\Request;


class BloodGroupController extends Controller
{


    public function add(Request $request)
    {
        //
        $post = new BloodGroup;
        $post->name = $request->input('name');
        $post->save();

        // return redirect('staffs/create');
        return redirect()->back();
    }
}
