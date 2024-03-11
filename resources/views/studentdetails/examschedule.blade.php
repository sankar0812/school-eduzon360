@extends('layouts.studentapp')
@section('title', 'Exam Timetable')
@section('studentdashboard')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
        Logins</a></small> --}}
            </div>
            <div class="card-body">
                <form class="" action="{{ route('student.examtablefilter') }}" method="GET">
                    <div class="form-group row mb-1">
                        <label for="" class="col-sm-2 col-form-label">Select</label>
                        <div class="col-md-5">
                            <select class="form-select " aria-label="Default select example" name="examid">
                                <option value="" selected disabled hidden>Exam Type</option>
                                @foreach ($examtype as $examtypes)
                                    <option value="{{ $examtypes->id }}">{{ $examtypes->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <select class="form-select" aria-label="Default select example" name="academicid">
                                <option value="" selected disabled hidden>Academic year</option>
                                @foreach ($academicyear as $academicYear)
                                    <option value="{{ $academicYear }}">{{ $academicYear }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3 py-2">
                            <button type="submit" class="btn btn-primary mb-4 btn-sm">Confirm <i
                                    class="fa-solid fa-location-arrow"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row py-2">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Exam Schedule</h6>
                <small class="text-danger float-end">
                    {{ $fyear }}
                </small>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-primary table-bordered table-striped ">
                    <thead class="table-dark">
                        @foreach ($examview as $examviews)
                            <tr>
                                <th colspan="5">
                                    <form>
                                        <div class="row">
                                            <div class="col-6 py-2">
                                                <label>Exam type : {{ $examviews->name }}</label>
                                            </div>
                                            <div class="col-6 py-2">
                                                <label>section : Class : {{ $examviews->c_class }}</label>
                                            </div>
                                            <div class="col-6 py-2">
                                                @foreach ($examtime as $examtimes)
                                                    <label>{{ $examtimes->et_name }}( {{ $examtimes->time}} )</label>
                                                @endforeach

                                            </div>
                                            <div class="col-6 py-2">
                                                <label>Exam Month: {{ $examviews->monthName }}</label>
                                            </div>
                                        </div>
                                    </form>
                                </th>

                            </tr>
                            <tr>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Subject Code</th>
                                <th>Subject</th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach ($examviews->tableview as $view)
                            <tr>
                                <td>{{ $view->ett_date }}</td>
                                <td>{{ $view->ett_day }}</td>
                                <td>{{ $view->ett_time }}</td>
                                <td>{{ $view->ett_code }}</td>
                                <td>{{ $view->ett_subject }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
