// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Route;
use App\Models\Vehicle;

class StudentController extends Controller
{
    public function create()
    {
        $routes = Route::pluck('name', 'id');
        $availableVehicles = $this->getAvailableVehicles();
        
        return view('students.create', compact('routes', 'availableVehicles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'route_id' => 'required|exists:routes,id',
        ]);

        $vehicleId = $this->assignVehicleAutomatically($request->route_id);

        $student = Student::create([
            'name' => $request->name,
            'route_id' => $request->route_id,
            'vehicle_id' => $vehicleId,
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    // Other methods remain similar...

    private function getAvailableVehicles()
    {
        // Retrieve vehicles that are not fully occupied
        return Vehicle::whereDoesntHave('students', function ($query) {
            $query->where('status', 'active');
        })->get();
    }

    private function assignVehicleAutomatically($routeId)
    {
        // Find the least occupied vehicle for the specified route
        $leastOccupiedVehicle = Vehicle::whereDoesntHave('students', function ($query) use ($routeId) {
            $query->where('route_id', $routeId);
        })->withCount('students')->orderBy('students_count')->first();

        if ($leastOccupiedVehicle) {
            return $leastOccupiedVehicle->id;
        }

        // If no available vehicle is found, you may want to handle this case based on your requirements
        // For example, you could throw an exception or return a default vehicle ID

        // In this example, return the first vehicle (assuming all vehicles are occupied)
        return Vehicle::first()->id;
    }
}
