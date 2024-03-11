@extends('layouts.default')
@section('title', 'Student Attendance Edit')
@section('sidebar')
    @include('include.classteachersidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Student Attendance Edit</h5>
                    <small class="text-muted float-end"></small>
                </div>
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-7">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="" placeholder="Name"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-7">
                            <label for="" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id="" placeholder="Date"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-7">
                            <label for="" class="form-label">Attendance</label>
                            <input type="text" class="form-control" name="attendance" id=""
                                placeholder="Attendance" autocomplete="off" required>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Update Form</button>
                            <a href="{{ url('classteacher/studentattendance') }}" class="btn btn-dark">Back</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
