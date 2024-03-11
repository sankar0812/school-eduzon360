@extends('layouts.default')
@section('title', 'StudentClass Timetable')
@section('sidebar')
    @include('include.classteachersidebar')
@endsection
@section('contentdashboard')

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
        Logins</a></small> --}}
            </div>
            <div class="card-body">
                @php
                    $classtime = DB::table('dailyclasstimes')
                        ->select('classname')
                        ->get();
                @endphp
                <form action="{{ route('staff.timetablefilter') }}" method="GET">
                    {{-- @csrf --}}
                    <div class="form-group row mb-1">
                        <label for="input" class="col-sm-2 col-form-label">Select Class</label>
                        <div class="col-md-5">
                            <select class="form-control " name="class" required>
                                <option value="" selected disabled hidden>select class</option>
                                @foreach ($class as $section)
                                    <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3 py-2">
                            <button type="submit" class="btn btn-primary mt-2 btn-sm"> <i class="bx bx-search fs-5 lh-0"></i>
                                Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <hr class="my-3" />
        <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Student Class Timetable</h5>


        @if ($timetableView)
             <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                <small class="text-danger float-end">
                    {{ $fyear }}
                </small>
            </div>
            <table class="table table-bordered">
                <thead class="">
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
        @else
            <p style="color:red;">No data found!</p>
        @endif
       

@endsection
