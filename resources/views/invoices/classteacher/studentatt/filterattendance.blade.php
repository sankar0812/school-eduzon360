@extends('layouts.default')
@section('title', 'Attendance Filter')
@section('sidebar')
    @include('include.classteachersidebar')
@endsection
@section('contentdashboard')
    @php

        $month = DB::table('studentattendances')
            ->select('stud_month')
            ->distinct()
            ->get();
    @endphp
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
    Logins</a></small> --}}
            </div>
            <div class="card-body">
                <form action="{{ route('classteacher.monthattendancefilter') }}" method="GET">
                    {{-- @csrf --}}
                    <div class="form-group row mb-1">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Select</label>
                        <div class="col-md-3">
                            <select class="form-control form-control-sm" name="classid">
                                <option value="" selected disabled hidden>select class</option>
                                @foreach ($class as $section)
                                    <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-md-3">
                            <select id="" name="month" class="form-control form-control-sm" autocomplete="off">
                                <option value="" selected disabled hidden>Select month</option>
                                @foreach ($month as $monthdata)
                                    <option value="{{ $monthdata->stud_month }}">{{ $monthdata->stud_month }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary mb-4 btn-sm">Apply Filter <i
                                    class="fa-solid fa-location-arrow"></i></button>
                            <a href="{{ url('classteacher/studentattendance') }}" class="btn btn-dark btn-sm mb-4">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row py-2">
        <div class="card p-2">
            <h6 class="card-header">
            </h6>
            <div class="table-responsive text-nowrap ">

                <table class="table  table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>p</th>
                            <th>Ab</th>
                            @foreach ($dates as $date)
                                <th>{{ $date }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendanceData as $studentId => $student)
                            @php
                                $check_pres = DB::table('studentattendances')
                                    ->join('students', 'students.id', '=', 'studentattendances.stud_id')
                                    ->where('studentattendances.stud_id', $student['sid'])
                                    ->where('stud_attid', '1')
                                    ->where('stud_month', now()->format('m-Y'))
                                    ->count();
                                 $check_abs = DB::table('studentattendances')
                                    ->join('students', 'students.id', '=', 'studentattendances.stud_id')
                                    ->where('studentattendances.stud_id', $student['sid'])
                                    ->where('stud_attid', '2')
                                    ->where('stud_month', now()->format('m-Y'))
                                    ->count();
                            @endphp
                            <tr class="student">
                                <td class="text-dark">{{ $student['name'] }}</td>
                                <td>{{ $check_pres }}</td>
                                <td>{{ $check_abs }}</td>
                                @foreach ($dates as $date)
                                    <td class="attend-col">
                                        <div class="form-check form-check-inline">
                                            @php
                                                $attendance = $student['attendance'][$date];

                                                if ($attendance == 1) {
                                                    echo '<b class="text-success">p</b>';
                                                } elseif ($attendance == 2) {
                                                    echo '<b class="text-danger">Ab</b>';
                                                } else {
                                                    echo '-';
                                                }
                                            @endphp
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
