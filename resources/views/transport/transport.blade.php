@extends('layouts.default')
@section('title', 'Transport')
@section('sidebar')
@include('include.sidebar')
@endsection
@section('contentdashboard')
<div class="col-xl-12 ">
    <!-- @php
    $activeTab = session('active_tab', 'default_tab'); 
@endphp -->
    <div class="nav-align-top mb-4">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                @if('route' == $activeTab )
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-route" aria-controls="navs-top-route" aria-selected="true" style="font-weight:bold;">
                    Routes
                </button>
                @else
                <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-route" aria-controls="navs-top-route" aria-selected="true" style="font-weight:bold;">
                    Routes
                </button>
                @endif
            </li>
            @if('vehicle' == $activeTab )
            <li class="nav-item">

                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-vehicle" aria-controls="navs-top-vehicle" aria-selected="false" style="font-weight:bold;">
                    Vehicles
                </button>
            </li>
            @else
            <li class="nav-item">
                <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-vehicle" aria-controls="navs-top-vehicle" aria-selected="false" style="font-weight:bold;">
                    Vehicles
                </button>
            </li>
            @endif

            <li class="nav-item">
                @if('assign' == $activeTab )
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-class-assign" aria-controls="navs-top-class-assign" aria-selected="false" style="font-weight:bold;">
                    Assign Vehicle
                </button>
                @else
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-class-assign" aria-controls="navs-top-class-assign" aria-selected="false" style="font-weight:bold;">
                    Assign Vehicle
                </button>
                @endif
            </li>
        </ul>

        <div class="tab-content">

            <div class="tab-pane fade show active" id="navs-top-route" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        @if (auth()->user()->type == 'admin')
                        <form action="{{ route('route.add') }}" method="post" enctype="multipart/form-data">
                            @elseif (auth()->user()->type == 'clerk')
                            <form action="{{ route('clerk.route.add') }}" method="post" enctype="multipart/form-data">
                                @else
                                return redirect()->route('home');
                                @endif


                                <div class="modal-body ">

                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Route Name:</label>
                                        <input type="text" name="routetitle" id="name" class="form-control" value="{{ old('name') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="starting_point">Starting Point:</label>
                                        <input type="text" name="starting_point" id="starting_point" class="form-control" value="{{ old('starting_point') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="ending_point">Ending Point:</label>
                                        <input type="text" name="ending_point" id="ending_point" class="form-control" value="{{ old('ending_point') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="sub_main_locations">Sub Main Locations:</label>
                                        <div id="sub-main-locations-container">
                                            <!-- Sub Main Locations will be added dynamically here -->
                                        </div>
                                        <button type="button" class="btn btn-success" id="add-sub-main-location">Add Sub Main Location</button>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Students For This Route </label>
                                    <div class="col-md-8">
                                        <div id="students-container">
                                            <!-- Rows will be added here -->
                                        </div>
                                        <button id="addRowsBtn" type="button" class="btn btn-primary">Add 50 Rows</button>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary mb-2 ">Submit Form <i class="fa-solid fa-location-arrow"></i></button>
                                    </div>
                                </div>
                            </form>
                    </div>
                    <div class="col-md-6">


                        <div class="table-responsive text-nowrap">
                            <table class="table " id="example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Route Title</th>
                                        <th>Starting Point</th>
                                        <th>Ending Point</th>
                                        <th>Sub Main Locations</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($routes as $route)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $route->routetitle }}</td>
                                        <td>{{ $route->starting_point }}</td>
                                        <td>{{ $route->ending_point }}</td>
                                        <td>
                                            @foreach($route->subRouteLocations as $subMainLocation)
                                            {{ $subMainLocation->name }}<br>
                                            @endforeach
                                        </td>
                                        <td>

                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">

                                                    <li>

                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal13{{ $route->id }}"><i class="fa-solid fa-pen"></i> Edit</a>


                                                    </li>
                                                </ul>
                                            </div>




                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="navs-top-vehicle" role="tabpanel">

                <div class="row">
                    <div class="col-md-6">

                        <!-- @if (auth()->user()->type == 'admin')
                        <form action="{{ route('vehicle.add') }}" class="" method="post" enctype="multipart/form-data">
                            @elseif (auth()->user()->type == 'clerk')
                            <form action="{{ route('clerk.vehicle.add') }}" class="" method="post" enctype="multipart/form-data">
                                @else
                                return redirect()->route('home');
                                @endif

                                @csrf
                                <div class="form-group row mb-3">
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Registration No</label>
                                        <input type="text" class="form-control" name="Regno" id="" placeholder="Registration No" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Registration Date</label>
                                        <input type="text" class="form-control" name="regdate" id="" placeholder="Registration Date" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">chassis No</label>
                                        <input type="text" class="form-control" name="chassisno" id="" placeholder="chassis No" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Engine No</label>
                                        <input type="text" class="form-control" name="engineno" id="" placeholder="Engine No" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="" class="form-label">Owner Name</label>
                                        <input type="text" class="form-control" name="ownername" id="" placeholder="Owner Name" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">vechicle Class</label>
                                        <input type="text" class="form-control" name="vechicleclass" id="" placeholder="vechicle Class" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">chassis No</label>
                                        <input type="text" class="form-control" name="chassisno" id="" placeholder="chassis No" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Engine No</label>
                                        <input type="text" class="form-control" name="engineno" id="" placeholder="Engine No" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Fuel</label>
                                        <input type="text" class="form-control" name="fuel" id="" placeholder="Fuel" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="" class="form-label">Maker/Model</label>
                                        <input type="text" class="form-control" name="maker_model" id="" placeholder="Maker/Model" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Fitness/REGN upto</label>
                                        <input type="text" class="form-control" name="fitness" id="" placeholder="Fitness/REGN upto" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">FC upto</label>
                                        <input type="text" class="form-control" name="fc" id="" placeholder="FC upto" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Mv TaX upto</label>
                                        <input type="text" class="form-control" name="mvtax" id="" placeholder="Mv TaX upto" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Insurance Upto</label>
                                        <input type="text" class="form-control" name="insurance" id="" placeholder="Insurance Upto" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">PUCC upto</label>
                                        <input type="text" class="form-control" name="pucc" id="" placeholder="PUCC upto" autocomplete="off" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Emission Norms</label>
                                        <input type="text" class="form-control" name="insurance" id="" placeholder="Insurance Upto" autocomplete="off" required>
                                    </div>

                                </div>

                                <div class="mb-3 row">
                                    <label for="" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary mb-2 ">Submit Form <i class="fa-solid fa-location-arrow"></i></button>
                                    </div>
                                </div>
                            </form> -->
                        @if (auth()->user()->type == 'admin')
                        <form action="{{ route('vehicle.add') }}" class="" method="post" enctype="multipart/form-data">
                            @elseif (auth()->user()->type == 'clerk')
                            <form action="{{ route('clerk.vehicle.add') }}" class="" method="post" enctype="multipart/form-data">
                                @else
                                return redirect()->route('home');
                                @endif

                                @csrf

                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Bus No</label>
                                    <div class="col-md-9">
                                        <input type="text" name="busno" id="" class="form-control" placeholder="Enter Bus No" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Vehicle Number</label>
                                    <div class="col-md-9">
                                        <input type="text" name="vehiclenumber" id="" class="form-control" placeholder="Enter vehicle Number" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Vehicle Model</label>
                                    <div class="col-md-9">
                                        <input type="text" name="vehiclemodel" id="" class="form-control" placeholder="Enter vehicle Model" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Seat Count</label>
                                    <div class="col-md-9">
                                        <input type="text" name="seatcount" id="" class="form-control" placeholder="Enter Seat Count " autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Year Made</label>
                                    <div class="col-md-9">
                                        <input type="text" name="yearmade" id="" class="form-control" placeholder="Year Made" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Fc Upto</label>
                                    <div class="col-md-9">
                                        <input type="text" name="fc" id="" class="form-control" placeholder="Fc Upto" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Engine No</label>
                                    <div class="col-md-9">
                                        <input type="text" name="engineno" id="" class="form-control" placeholder="Engine No" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-3 col-form-label">Chassis No</label>
                                    <div class="col-md-9">
                                        <input type="text" name="chassisno" id="" class="form-control" placeholder="Chassis No" autocomplete="off" required>
                                    </div>
                                </div>
                                <!-- <div class="form-group row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Driver Name</label>
                                <div class="col-md-9">
                                    <select class="form-control" aria-label="Default select example" name="driver"
                                        required>
                                        <option value="" selected disabled hidden>Select Driver</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->id }}">{{ $staff->sf_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> -->
                                <div class="mb-3 row">
                                    <label for="" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary mb-2 ">Submit Form <i class="fa-solid fa-location-arrow"></i></button>
                                    </div>
                                </div>
                            </form>
                    </div>
                    <div class="col-md-6">
                        <div class="table-responsive text-nowrap">
                            <table class="table" id="example1">
                                <thead class="">
                                    <tr>
                                        <th>#</th>
                                        <th>Vehicle Number</th>
                                        <th>Year</th>

                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vehicles as $vehicle)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $vehicle->vehiclenumber }}</td>
                                        <td>{{ $vehicle->yearmade }}</td>

                                        <td>

                                            @if (auth()->user()->type == 'admin')
                                            @if ($vehicle->status == '1')
                                            <a href="{{ route('vehicle.status', ['id' => $vehicle->id, 'status' => 0]) }}"><span class="badge bg-label-success me-1">Active</span></a>
                                            @else
                                            <a href="{{ route('vehicle.status', ['id' => $vehicle->id, 'status' => 1]) }}">
                                                <span class="badge bg-label-danger me-1">Deactive</span></a>
                                            @endif
                                            @elseif (auth()->user()->type == 'clerk')
                                            @if ($vehicle->status == '1')
                                            <a href="{{ route('clerk.vehicle.status', ['id' => $vehicle->id, 'status' => 0]) }}"><span class="badge bg-label-success me-1">Active</span></a>
                                            @else
                                            <a href="{{ route('clerk.vehicle.status', ['id' => $vehicle->id, 'status' => 1]) }}">
                                                <span class="badge bg-label-danger me-1">Deactive</span></a>
                                            @endif
                                            @else
                                            return redirect()->route('home');
                                            @endif


                                        </td>
                                        <td>

                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">

                                                    <li>

                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal12{{ $vehicle->id }}"><i class="fa-solid fa-pen"></i> Edit</a>


                                                    </li>
                                                </ul>
                                            </div>




                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>




            </div>

            <div class="tab-pane fade" id="navs-top-class-assign" role="tabpanel">
                <div class="card-body row g-3">
                    <div class="col-md-6">

                        @if (auth()->user()->type == 'admin')
                        <form action="{{ route('assignvehicle.add') }}" class="" method="post" enctype="multipart/form-data">
                            @elseif (auth()->user()->type == 'clerk')
                            <form action="{{ route('clerk.assignvehicle.add') }}" class="" method="post" enctype="multipart/form-data">
                                @else
                                return redirect()->route('home');
                                @endif



                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Bus No</label>
                                    <div class="col-md-8">

                                        <select class="form-control" aria-label="Default select example" name="busno" required>
                                            <option value="" selected disabled hidden>Select Bus No</option>
                                            @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->busno }}">{{ $vehicle->busno }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Route</label>
                                    <div class="col-md-8">

                                        <select class="form-control" aria-label="Default select example" name="route_id" required>
                                            <option value="" selected disabled hidden>Select Route</option>
                                            @foreach ($routes as $positiondata)
                                            <option value="{{ $positiondata->id }}">{{ $positiondata->routetitle }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Driver</label>
                                    <div class="col-md-8">

                                        <select class="form-control" aria-label="Default select example" name="staff_id" required>
                                            <option value="" selected disabled hidden>Select Driver</option>
                                            @foreach ($staffs as $staff)
                                            <option value="{{ $staff->staff_id }}">{{ $staff->sf_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="form-group row mb-3">
                                    <label for="" class="col-sm-2 col-form-label">Students For This Route </label>
                                    <div class="col-md-8">
                                        <div id="students-container">
                                           
                                        </div>
                                        <button id="addRowsBtn" type="button" class="btn btn-primary">Add 50 Rows</button>
                                    </div>
                                </div> -->
                                <div class="mb-3 row">
                                    <label for="" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary mb-4 ">Submit Form <i class="fa-solid fa-location-arrow"></i></button>
                                    </div>
                                </div>
                            </form>
                    </div>

                    <div class="col-md-6">


                        <div class="table-responsive text-nowrap">
                            <table class="table" id="example2">
                                <thead>
                                    <tr>
                                        <th>Bus No</th>
                                        <th>Route</th>
                                        <th>Driver</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assignvehicles as $assignment)
                                    <tr>
                                        <td>{{ $assignment->busno }}</td>
                                        <td>{{ $assignment->routetitle }}</td>
                                        <td>{{ $assignment->sf_name }}</td>
                                        <td> @if (auth()->user()->type == 'admin')
                                            @if ($assignment->status == '1')
                                            <a href="{{ route('assignvehicle.status', ['id' => $assignment->id, 'status' => 0]) }}"><span class="badge bg-label-success me-1">Active</span></a>
                                            @else
                                            <a href="{{ route('assignvehicle.status', ['id' => $assignment->id, 'status' => 1]) }}">
                                                <span class="badge bg-label-danger me-1">Deactive</span></a>
                                            @endif
                                            @elseif (auth()->user()->type == 'clerk')
                                            @if ($assignment->status == '1')
                                            <a href="{{ route('clerk.assignvehicle.status', ['id' => $assignment->id, 'status' => 0]) }}"><span class="badge bg-label-success me-1">Active</span></a>
                                            @else
                                            <a href="{{ route('clerk.assignvehicle.status', ['id' => $assignment->id, 'status' => 1]) }}">
                                                <span class="badge bg-label-danger me-1">Deactive</span></a>
                                            @endif
                                            @else
                                            return redirect()->route('home');
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal14{{ $assignment->id }}"><i class="fa-solid fa-pen"></i> Edit</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @foreach ($vehicles as $vehicle)
    <div class="modal fade" id="exampleModal12{{ $vehicle->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit OutTime</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (auth()->user()->type == 'admin')
                    <form action="{{ route('vehicle.update') }}" class="" method="post" enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'clerk')
                        <form action="{{ route('clerk.vehicle.update') }}" class="" method="post" enctype="multipart/form-data">
                            @else
                            return redirect()->route('home');
                            @endif

                            @csrf
                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Bus No</label>
                                <div class="col-md-9">
                                    <input type="text" name="busno" id="" class="form-control" placeholder="Enter Bus No" value="{{ $vehicle->busno }}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Vehicle Number</label>
                                <div class="col-md-9">
                                    <input type="hidden" name="id" value="{{ $vehicle->id }}">
                                    <input type="text" name="vehiclenumber" value="{{ $vehicle->vehiclenumber }}" id="" class="form-control" placeholder="Enter vehicle Number" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Vehicle Model</label>
                                <div class="col-md-9">
                                    <input type="text" name="vehiclemodel" value="{{ $vehicle->vehiclemodel }}" id="" class="form-control" placeholder="Enter vehicle Model" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Seat Count</label>
                                <div class="col-md-9">
                                    <input type="text" name="seatcount" value="{{ $vehicle->seatcount }}" id="" class="form-control" placeholder="Enter Seat Count " autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Year
                                    Made</label>
                                <div class="col-md-9">
                                    <input type="text" name="yearmade" id="" value="{{ $vehicle->yearmade }}" class="form-control" placeholder="Year Made" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Fc Upto</label>
                                <div class="col-md-9">
                                    <input type="text" name="fc" id="" class="form-control" placeholder="Fc Upto" value="{{ $vehicle->fc }}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Engine No</label>
                                <div class="col-md-9">
                                    <input type="text" name="engineno" id="" class="form-control" placeholder="Engine No" value="{{ $vehicle->engineno }}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Chassis No</label>
                                <div class="col-md-9">
                                    <input type="text" name="chassisno" id="" class="form-control" placeholder="Chassis No" value="{{ $vehicle->chassisno }}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close
                                </button> --}}
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach ($routes as $route)
    <div class="modal fade" id="exampleModal13{{ $route->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $route->id }}" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel{{ $route->id }}">Edit OutTime</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (auth()->user()->type == 'admin' || auth()->user()->type == 'clerk')
                    <form action="{{ route('route.update', $route->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Route Name:</label>
                            <input type="hidden" name="id" value="{{ $route->id }}">
                            <input type="text" name="routetitle" id="name" class="form-control" value="{{ $route->routetitle }}" required>
                        </div>

                        <div class="form-group">
                            <label for="starting_point">Starting Point:</label>
                            <input type="text" name="starting_point" id="starting_point" class="form-control" value="{{ $route->starting_point }}" required>
                        </div>

                        <div class="form-group">
                            <label for="ending_point">Ending Point:</label>
                            <input type="text" name="ending_point" id="ending_point" class="form-control" value="{{ $route->ending_point }}" required>
                        </div>

                        <!-- <div class="form-group">
                            <label for="sub_main_locations{{ $route->id }}">Sub Main Locations:</label>
                            <div id="sub-main-locations-container{{ $route->id }}">
                            
                                @foreach($route->subRouteLocations as $subMainLocation)
                                    <div class="sub-main-location-row row mb-2">
                                        <div class="col-6">
                                            <input type="hidden" name="sub_main_locations_edit[{{ $subMainLocation->id }}][id]" class="form-control" value="{{ $subMainLocation->id }}" readonly>
                                            <input type="text" name="sub_main_locations_edit[{{ $subMainLocation->id }}][name]" class="form-control" value="{{ $subMainLocation->name }}">
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-danger remove-sub-main-location">Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success" id="add-sub-main-location">Add Sub Main Location</button>
                        </div> -->
                        <div class="form-group">
                            <label for="sub_main_locations_edit{{ $route->id }}">Sub Main Locations:</label>
                            <div id="sub-main-locations-container-edit{{ $route->id }} sub-main-locations-container-edit">
                                <!-- ... sub-main locations ... -->
                                @foreach($route->subRouteLocations as $subMainLocation)
                                    <div class="sub-main-location-row row mb-2">
                                        <div class="col-6">
                                            <input type="hidden" name="sub_main_locations_edit[{{ $subMainLocation->id }}][id]" class="form-control" value="{{ $subMainLocation->id }}" readonly>
                                            <input type="text" name="sub_main_locations_edit[{{ $subMainLocation->id }}][name]" class="form-control" value="{{ $subMainLocation->name }}">
                                        </div>
                                        <div class="col-4">
                                            <!-- <button type="button" class="btn btn-danger remove-sub-main-location-edit">Remove</button> -->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- <button type="button" class="btn btn-success" id="add-sub-main-location-edit">Add Sub Main Location</button> -->
                        </div>
                        <div class="form-group">
                            <label for="students_for_route_edit{{ $route->id }}">Students For this Route:</label>
                            <div id="students-container-edit{{ $route->id }}">
                            <div class="student-row-edit row mb-2">
                                        <div class="col-6">
                                        <label for="roll_no">Roll No:</label>
                                          </div>
                                        <div class="col-4">
                                        <label for="name">Student Name:</label>                                        </div>
                                        <div class="col-2">
                                            <!-- <button type="button" class="btn btn-danger remove-student-edit">Remove</button> -->
                                        </div>
                                    </div>
                                <!-- ... students ... -->
                                @foreach($route->students as $student)
                                    <div class="student-row-edit row mb-2">
                                        <div class="col-6">
                                            <input type="hidden" name="students_for_route_edit[{{ $student->id }}][id]" class="form-control" value="{{ $student->id }}" readonly>
                                            <input type="text" name="students_for_route_edit[{{ $student->id }}][roll_no]" class="form-control" value="{{ $student->roll_no }}" placeholder="Roll No">
                                        </div>
                                        <div class="col-4">
                                            <input type="text" name="students_for_route_edit[{{ $student->id }}][name]" class="form-control" value="{{ $student->name }}" placeholder="Name">
                                        </div>
                                        <div class="col-2">
                                            <!-- <button type="button" class="btn btn-danger remove-student-edit">Remove</button> -->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- <button type="button" class="btn btn-success" id="add-student-edit{{ $route->id }}">Add Student</button> -->

                        </div>

                        <!-- Modal footer outside of the form -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                    @else
                    <p>Unauthorized access. Redirecting...</p>
                    return redirect()->route('home');
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach



    @foreach($assignvehicles as $assign)
    <div class="modal fade" id="exampleModal14{{ $assign->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit OutTime</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @if (auth()->user()->type == 'admin')
                    <form action="{{ route('assignvehicle.update') }}" class="" method="post" enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'clerk')
                        <form action="{{ route('clerk.assignvehicle.update') }}" class="" method="post" enctype="multipart/form-data">
                            @else
                            return redirect()->route('home');
                            @endif



                            @csrf
                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Bus No</label>

                                <input type="hidden" name="id" value="{{ $assign->id }}">

                                <div class="col-md-8">
                                    <select class="form-control" aria-label="Default select example" name="busno" required>
                                        <option value="" selected disabled hidden>Select Vehicle</option>
                                        @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->busno }}" {{ $vehicle->busno == $assign->busno ? 'selected' : '' }}>
                                            {{ $vehicle->busno }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Route</label>
                                <div class="col-md-8">
                                    <select class="form-control" aria-label="Default select example" name="route_id" required>
                                        <option value="" selected disabled hidden>Select Route</option>
                                        @foreach ($routes as $positiondata)
                                        <option value="{{ $positiondata->id }}" {{ $positiondata->id == $assign->route_id ? 'selected' : '' }}>
                                            {{ $positiondata->routetitle }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Driver</label>
                                <div class="col-md-8">
                                    <select class="form-control" aria-label="Default select example" name="staff_id" required>
                                        <option value="" selected disabled hidden>Select Driver</option>
                                        @foreach ($staffs as $staff)
                                        <option value="{{ $staff->staff_id }}" {{ $staff->staff_id == $assign->staff_id ? 'selected' : '' }}>
                                            {{ $staff->sf_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>




                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close
                                </button> --}}
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    @endsection
    @push('other-scripts')
    <script>
        // JavaScript for dynamic addition and deletion of sub-main locations
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('sub-main-locations-container');
            const addButton = document.getElementById('add-sub-main-location');

            addButton.addEventListener('click', function() {
                const row = document.createElement('div');
                row.classList.add('sub-main-location-row', 'row', 'mb-2');

                const inputColumn = document.createElement('div');
                inputColumn.classList.add('col-8');

                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'sub_main_locations[]';
                input.classList.add('form-control');

                inputColumn.appendChild(input);

                const deleteButtonColumn = document.createElement('div');
                deleteButtonColumn.classList.add('col-4');

                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.classList.add('btn', 'btn-danger', 'w-100');
                deleteButton.textContent = 'Remove';
                deleteButton.addEventListener('click', function() {
                    container.removeChild(row);
                });

                deleteButtonColumn.appendChild(deleteButton);

                row.appendChild(inputColumn);
                row.appendChild(deleteButtonColumn);

                container.appendChild(row);
            });
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('sub-main-locations-container-edit{{ $route->id }}');
        const addButton = document.getElementById('add-sub-main-location-edit');

        addButton.addEventListener('click', function () {
            const row = document.createElement('div');
            row.classList.add('sub-main-location-row', 'row', 'mb-2');

            const inputColumn = document.createElement('div');
            inputColumn.classList.add('col-6');

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'new_sub_main_locations[][name]';
            input.classList.add('form-control');

            inputColumn.appendChild(input);

            const deleteButtonColumn = document.createElement('div');
            deleteButtonColumn.classList.add('col-4');

            const deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.classList.add('btn', 'btn-danger', 'remove-sub-main-location-edit');
            deleteButton.textContent = 'Remove';
            deleteButton.addEventListener('click', function () {
                container.removeChild(row);
            });

            deleteButtonColumn.appendChild(deleteButton);

            row.appendChild(inputColumn);
            row.appendChild(deleteButtonColumn);

            container.appendChild(row);
        });

        // Event delegation for dynamically added remove buttons
        container.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-sub-main-location-edit')) {
                const row = event.target.closest('.sub-main-location-row');
                container.removeChild(row);
            }
        });
    });
</script>





    <script>
        $(document).ready(function() {
            // Function to add rows
            function addRows() {
                for (var i = 0; i < 50; i++) {
                    var newRow = '<div class="form-group row mb-3">' +
                        '<label for="" class="col-sm-2 col-form-label"> Stud' + (i + 1) + '</label>' +
                        '<div class="col-md-5">' +
                        '<input type="text" class="form-control" name="rollno[]" placeholder="Roll No">' +
                        '</div>' +
                        '<div class="col-md-4">' +
                        '<input type="text" class="form-control" name="student[]" placeholder="Name">' +
                        '</div>' +
                        '</div>';
                    $('#students-container').append(newRow);
                }

                // Disable the button after adding 50 rows
                $('#addRowsBtn').prop('disabled', true);
            }

            // Event listener for the Add 50 Rows button
            $('#addRowsBtn').click(function() {
                addRows();
            });
        });
    </script>

    @endpush