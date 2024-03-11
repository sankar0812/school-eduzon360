<!-- resources/views/students/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Student</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('students.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Student Name:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="route_id">Select Route:</label>
                                <select name="route_id" id="route_id" class="form-control" required>
                                    @foreach($routes as $routeId => $routeName)
                                        <option value="{{ $routeId }}">{{ $routeName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="vehicle_id">Assigned Vehicle:</label>
                                <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                                    @foreach($availableVehicles as $vehicleId => $vehicleName)
                                        <option value="{{ $vehicleId }}">{{ $vehicleName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
