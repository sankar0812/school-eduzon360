<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Routes;
use App\Models\Vehicles;

use Illuminate\Http\Request;
use App\Models\Assignvehicles;
use Illuminate\Validation\Rule;
use App\Models\StudentsForRoute;
use App\Models\SubRouteLocation;
use Illuminate\Support\Facades\DB;



class VechicleController extends Controller
{
    public function studentlist()
    {
        return view('transport.studentlist');
    }
    public function vehicledetails()
    {
        return view('transport.vehicledetails');
    }
    public function vechicleexpense()
    {
        return view('transport.vechicleexpense');
    }
    public function vehicledetailsedit()
    {
        return view('transport.vehicledetailsedit');
    }
    public function vehicleexpenseedit()
    {
        return view('transport.vehicleexpenseedit');
    }


    public function index()
    {

        $vehicles = Vehicles::get();
        // $routes = Routes::with('subRouteLocations')->get();
        $routes = Routes::with(['subRouteLocations', 'students'])->get();
        $staffs = Staff::where('sf_position', 4)->get();

        $vehicles = DB::table('vehicles')
            // ->join('staff', 'staff.id', '=',  'vehicles.staff_id')
            ->select('vehicles.*')
            // ->where('vehicles.status', 1)
            ->get();

        $assignvehicles = DB::table('assignvehicles')
            ->join('staff', 'staff.id', '=',  'assignvehicles.staff_id')
            ->join('routes', 'routes.id', '=',  'assignvehicles.route_id')
            ->select('assignvehicles.*', 'staff.sf_name', 'routes.routetitle')

            ->get();

        // dd( $assignvehicles);

        return view('transport.transport', compact('vehicles', 'routes', 'assignvehicles',  'staffs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function vehiclesadd(Request $request)
    {
        $request->validate([
            'vehiclenumber' => [
                'required',
                Rule::unique('vehicles', 'vehiclenumber')
                    ->ignore($request->id), // Exclude the current record when updating
            ],

        ], [
            'vehiclenumber.required' => 'The vehicle number is required.',
            'vehiclenumber.unique' => 'The vehicle number has already been taken.',

        ]);

        $post = new Vehicles;

        $post->busno = $request->busno;
        $post->vehiclenumber = $request->vehiclenumber;
        $post->vehiclemodel = $request->vehiclemodel;
        $post->seatcount = $request->seatcount;
        $post->seatoccupied = $request->seatoccupied;
        $post->yearmade = $request->yearmade;
        $post->fc = $request->fc;
        $post->engineno = $request->engineno;
        $post->chassisno = $request->chassisno;

        $post->save();
        $activeTab = 'vehicle';
        return redirect()->back()
            ->with('active_tab', $activeTab)
            ->with('success', 'Vehicle created successfully.');
    }
    public function vehiclestatus(Request $request)
    {
        $id = $request->id;

        $post = Vehicles::find($id);

        $post->status = $request->status;
        $post->save();



        return redirect()->back();
    }

    public function vehicleupdate(Request $request)
    {
        $id = $request->id;
        // dd($id);

        $post = Vehicles::find($id);

        $post->busno = $request->busno;
        $post->vehiclenumber = $request->vehiclenumber;
        $post->vehiclemodel = $request->vehiclemodel;
        $post->seatcount = $request->seatcount;
        $post->seatoccupied = $request->seatoccupied;
        $post->yearmade = $request->yearmade;
        $post->fc = $request->fc;
        $post->engineno = $request->engineno;
        $post->chassisno = $request->chassisno;




        $post->save();



        return redirect()->back()->with('success', 'Vehicle updated successfully.');
    }




    // public function routesadd(Request $request)
    // {


    //     $post = new Routes;

    //     $post->routetitle = $request->routetitle;
    //     $post->destination = $request->destination;
    //     $post->save();

    //     return redirect()->back()
    //                     ->with('success', 'Route created successfully.');
    // }

    // public function routeindex()
    // {

    //     $routes = Routes::with('subRouteLocations')->get();

    //     return view('transport.route.index', compact('routes'))
    //         ->with('i', (request()->input('page', 1) - 1) * 5);
    // }

    public function routesadd(Request $request)
    {
        // Validation logic
        $this->validate($request, [
            'routetitle' => 'required|unique:routes',
            'starting_point' => 'required',
            'ending_point' => 'required',
        ]);

        // Create the route
        $route = Routes::create($request->only(['routetitle', 'starting_point', 'ending_point']));
        $lastInsertedId = $route->id;

        if ($request->has('sub_main_locations')) {
            $subMainLocations = $request->input('sub_main_locations');

            foreach ($subMainLocations as $subMainLocation) {
                SubRouteLocation::create([
                    'route_id' => $lastInsertedId,
                    'name' => $subMainLocation,
                ]);
            }
        }

        // if ($request->has('rollno')) {
        //     $rollnos = $request->input('rollno');
        //     $students = $request->input('student');

        //     foreach ($rollnos as $key => $rollno) {
        //         $studentData = [
        //             'route_id' => $lastInsertedId,
        //             'roll_no' => $rollno,
        //             'name' => $students[$key],
        //             // Add any additional fields as needed
        //         ];

        //         // Use the combination of 'route_id' and 'roll_no' as a unique identifier to check if the student exists
        //         StudentsForRoute::updateOrCreate(
        //             ['route_id' => $studentData['route_id'], 'roll_no' => $studentData['roll_no']],
        //             $studentData
        //         );
        //     }
        // }
          if ($request->has('rollno')) {
            $rollnos = $request->input('rollno');
            $students = $request->input('student');
        
            $key = 0;
            do {
                $rollno = $rollnos[$key];
                $studentData = [
                    'route_id' => $lastInsertedId,
                    'roll_no' => $rollno,
                    'name' => $students[$key],
                    // Add any additional fields as needed
                ];
        
                // Use the combination of 'route_id' and 'roll_no' as a unique identifier to check if the student exists
                StudentsForRoute::updateOrCreate(
                    ['route_id' => $studentData['route_id'], 'roll_no' => $studentData['roll_no']],
                    $studentData
                );
        
                $key++;
            } while (isset($rollnos[$key]));
        }

        // Redirect to the index page with a success message
        $activeTab = 'route';
        return redirect()->back()
            ->with('active_tab', $activeTab)
            ->with('success', 'Route created successfully.');
    }





    public function routestatus(Request $request)
    {
        $id = $request->id;

        $post = Routes::find($id);

        $post->status = $request->status;
        $post->save();



        return redirect()->back();
    }

    // public function routeupdate(Request $request)
    // {
    //     $id = $request->id;
    //     // dd($id);

    //     $post = Routes::find($id);

    //     $post->routetitle = $request->routetitle;
    //     $post->destination = $request->destination;



    //     $post->save();



    //     return redirect()->back();
    // }


    public function routeupdate(Request $request, $id)
    {
        // Validation logic
        $this->validate($request, [
            'routetitle' => 'required|unique:routes,routetitle,' . $id,
            'starting_point' => 'required',
            'ending_point' => 'required',
        ]);

        // Find the route by ID
        $route = Routes::findOrFail($id);

        // Update the route details
        $route->update([
            'routetitle' => $request->input('routetitle'),
            'starting_point' => $request->input('starting_point'),
            'ending_point' => $request->input('ending_point'),
        ]);

        // Handle sub main locations update
        $subMainLocations = $request->input('sub_main_locations_edit', []);

        foreach ($subMainLocations as $subMainLocation) {
            // Assuming each subMainLocation array has an 'id' key
            $id = $subMainLocation['id'];

            // Update sub main locations based on ID
            SubRouteLocation::where('id', $id)
                ->where('route_id', $route->id)
                ->update(['name' => $subMainLocation['name']]);
        }

        // Handle addition of new sub main locations
        $newSubMainLocations = $request->input('new_sub_main_locations', []);

        foreach ($newSubMainLocations as $newSubMainLocation) {
            // Assuming each newSubMainLocation array has a 'name' key
            $newLocation = new SubRouteLocation(['name' => $newSubMainLocation['name']]);
            $route->subRouteLocations()->save($newLocation);
        }


        $studentsForRoute = $request->input('students_for_route_edit', []);

        foreach ($studentsForRoute as $studentData) {
            $studentId = $studentData['id'];

            // Find the student by ID
            $student = StudentsForRoute::find($studentId);

            if ($student) {
                // Update existing student
                $student->update([
                    'roll_no' => $studentData['roll_no'],
                    'name' => $studentData['name'],
                ]);
            } else {
                // If student doesn't exist, create a new one
                $newStudent = new StudentsForRoute([
                    'roll_no' => $studentData['roll_no'],
                    'name' => $studentData['name'],
                ]);
                $route->students()->save($newStudent);
            }
        }

        return redirect()->back()->with('success', 'Route updated successfully.');
    }



    public function assignvehicleadd(Request $request)
    {


        $post = new Assignvehicles;

        $post->busno = $request->busno;
        $post->route_id = $request->route_id;
        $post->staff_id = $request->staff_id;
        $post->save();

        return redirect()->back()
            ->with('success', 'Route created successfully.');
    }

    public function assignvehicleupdate(Request $request)
    {
        $id = $request->id;
        // dd($id);
        // dd($request);
        $post = Assignvehicles::find($id);
        // dd( $post);
        $post->busno = $request->busno;
        $post->route_id = $request->route_id;
        $post->staff_id = $request->staff_id;



        $post->save();



        return redirect()->back();
    }

    public function assignvehiclestatus(Request $request)
    {
        $id = $request->id;

        $post = Assignvehicles::find($id);

        $post->status = $request->status;
        $post->save();



        return redirect()->back();
    }
}
