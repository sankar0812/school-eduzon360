@extends('layouts.default')
@section('title', 'StudentClass Timetable')
@section('sidebar')
    @include('include.classteachersidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
        Logins</a></small> --}}
            </div>
            <div class="card-body">
                @php
                    $class = DB::table('class_sections')
                        ->where(['c_status' => 1, 'c_delete' => 1])
                        ->get();

                    $classtime = DB::table('dailyclasstimes')
                        ->select('classname')
                        ->get();
                @endphp
                <form action="{{ route('staff.timetablefilter') }}" method="GET">
                    {{-- @csrf --}}
                    <div class="form-group row mb-1">
                        <label for="input" class="col-sm-2 col-form-label">Select Class</label>
                        <div class="col-md-5">
                            <select class="form-control form-control-sm" name="class" required>
                                <option value="" selected disabled hidden>select class</option>
                                @foreach ($class as $section)
                                    <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary mb-4 btn-sm">Apply Filter <i
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
                <h6 class="mb-0"></h6>
                <small class="text-muted float-end">
                    {{ $fyear }}
                </small>
            </div>
            <table class="table table-primary table-bordered table-striped ">
                <thead class="table-dark">
                    @foreach ($timetableView as $requested)
                        <tr>
                            <th colspan="9">
                                <form>
                                    <div class="row">
                                        <div class="col-6 py-2">
                                            <label>Class & section : {{ $requested->c_class }}</label>
                                        </div>

                                    </div>
                                </form>
                            </th>

                        </tr>
                        <tr>
                            <th>Date</th>
                            @foreach ($classtime as $classtimes)
                                <th>{{ $classtimes->classname }}</th>
                            @endforeach
                        </tr>
                </thead>

                <tbody>
                    @foreach ($requested->tableview as $subTimetable)
                        <tr>
                            <td>{{ $subTimetable->day_name }}</td>
                            <td>{{ $subTimetable->pre1 }}</td>
                            <td>{{ $subTimetable->pre2 }}</td>
                            <td>{{ $subTimetable->pre3 }}</td>
                            <td>{{ $subTimetable->pre4 }}</td>
                            <td>{{ $subTimetable->pre5 }}</td>
                            <td>{{ $subTimetable->pre6 }}</td>
                            <td>{{ $subTimetable->pre7 }}</td>
                            <td>{{ $subTimetable->pre8 }}</td>
                        </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
