<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use App\Models\Profile;
use App\Models\Hashpass;
use App\Models\Schoolinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function school_info()
    {
        $profilelist = Profile::get();
        $schoolinfo = Schoolinfo::first();
        return view('admin.schooldetails', compact('profilelist', 'schoolinfo'));
    }

    public function administrativeview()
    {
        $profilelist = Profile::get();
        $schoolinfo = Schoolinfo::first();
        return view('admin.administrativedetails', compact('profilelist', 'schoolinfo'));
    }

    public function administrativeedit($id)
    {
        $profileedit = Profile::where('id', $id)->first();
        $schoolinfoedit = Schoolinfo::where('id', $id)->first();
        return view('admin.administrativeedit', compact('profileedit','schoolinfoedit'));
    }
    public function schoolinfoedit($id)
    {
        // $profileedit = Profile::where('id', $id)->first();
        $schoolinfoedit = Schoolinfo::where('id', $id)->first();
        return view('admin.schoolinfoedit', compact('schoolinfoedit'));
    }

    public function adminitrativeadd(Request $request)
    {

        // dd($request);
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $image = $request->file('image');
            $name = $request->input('name');
            $designation = $request->input('designation');

            if (!empty($image)) {
                $extension = $image->getClientOriginalExtension(); // Get the file extension
                $filename = uniqid() . '.' . $extension; // Generate a unique filename
                $image->move('myimage/administrative', $filename); // Move the uploaded file to a destination folder
            } else {
                $filename = null; // If no image is uploaded, set filename to null
            }

            Profile::insert([
                'Pr_image' => $filename, // Use the generated filename
                'Pr_name' => $name,
                'Pr_designation' => $designation
            ]);

            return redirect()->back()->with('success', 'Process successful');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Process failed');
        }
    }

    public function adminitrativeedit(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $image = $request->file('image');
            $oldimage = $request->oldimage;
            $name = $request->input('name');
            $designation = $request->input('designation');

            if (!empty($image)) {
                $extension = $image->getClientOriginalExtension(); // Get the file extension
                $filename = uniqid() . '.' . $extension; // Generate a unique filename
                $image->move('myimage/administrative', $filename); // Move the uploaded file to a destination folder
            } else {
                // $oldextension = $oldimage->getClientOriginalExtension(); // Get the file extension
                $filename = $oldimage; // Generate a unique filename
                // $oldimage->move('myimage/administrative', $filename); // Move the uploaded file to a destination folder
            }

            Profile::where('id', $id)->update([
                'Pr_image' => $filename, // Use the generated filename
                'Pr_name' => $name,
                'Pr_designation' => $designation
            ]);

            return redirect()->back()->with('success', 'Process successful');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Process failed');
        }
    }




    public function schoolinfoadd(Request $request)
    {

        // dd($request);
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $image = $request->file('logo');
            $name = $request->input('name');
            $address = $request->input('address');
            $regno = $request->input('regno');
            $designation = $request->input('about');

            if (!empty($image)) {
                $logo = time() . '.' . $image->getClientOriginalName();
                $logostore = uniqid() . '.' . $logo; // Generate a unique filename
                $logo_path =$image->move('School/logo', $logostore);




                // $logo = $image->getClientOriginalExtension(); // Get the file extension
                // // $filename = uniqid() . '.' . $extension; // Generate a unique filename
                // // $image->move('myimage/administrative', $filename); // Move the uploaded file to a destination folder
                // $logostore = $request->file('logo')->storeAs('logo', $logo, 'public');
                // $logo_path = '/storage/' . $logostore;
            } else {
                $filename = null; // If no image is uploaded, set filename to null
            }

            Schoolinfo::insert([
                'logo' => $logo, // Use the generated filename
                'logo_path' => $logo_path,
                'name' => $name,
                'address' => $address,
                'regno' => $regno,
                'about' => $designation
            ]);

            return redirect()->back()->with('success', 'School Information Added successful');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Process failed');
        }
    }

    public function schoolinfoupdate(Request $request)
    {

        // dd($request);


        $id = $request->input('id');

        $image_old = $request->logoold;
        $image_path = $request->logo_pathold;
        $image = $request->logo;

            // $name = $request->input('name');
            // $address = $request->input('address');
            // $regno = $request->input('regno');
            // $designation = $request->input('about');

            if ($image == '') {
                # code...
                $logo = $image_old;
                $logo_path = $image_path;
                //  response($profile_old);
                // return response($logo);
                //  return response($profile);

            } else {
                # code...
                $logo = time() . '.' . $image->getClientOriginalName();
                $logostore = uniqid() . '.' . $logo; // Generate a unique filename
                $logo_path =$image->move('School/logo', $logostore);
            }

// return response($logo);

            $schoolinfo = Schoolinfo::where('id', $id)->first();
            // return response($fee);
            $schoolinfo->logo = $logo;
            $schoolinfo->logo_path = $logo_path;
            $schoolinfo->name = $request->name;
            $schoolinfo->address = $request->address;
            $schoolinfo->regno = $request->regno;
            $schoolinfo->about = $request->about;


            $schoolinfo->save();



            return redirect()->back()->with('success', 'School Information Updated successful');



    }

    public function adminlogin()
    {
         $userstaff = User::where('type', '!=', 2)->where(['delete' => 1,'superadmin'=>0])->get();
        return view('admin.adminlogin', compact('userstaff'));
    }

    public function adminloginedit($id)
    {

        $staffdetails = Staff::select('sf_name', 'sf_email')->get();
        $loginedit =  DB::table('users')
            ->join('hashpasses', 'hashpasses.loginid', '=', 'users.id')
            ->where('users.id', $id)
            ->select('users.id as userid', 'users.name', 'users.email', 'hashpasses.ha_name', 'users.type')
            ->first();
        return view('admin.adminloginedit', compact('loginedit', 'staffdetails'));
    }

    public function adminregister(Request $request)
    {
        try {
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


            return redirect()->back()->with('success', 'Save successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'failed');
        }
    }
}
