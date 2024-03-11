@extends('layouts.default')
@section('title', 'Student Attendance View')
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

                <form action="{{ route('classteacher.studentclassfilter') }}" method="GET">
                    {{-- @csrf --}}
                    <div class="form-group row mb-1">
                        <label for="input" class="col-sm-2 col-form-label">Select Class</label>
                        <div class="col-md-4">
                            <select class="form-control form-control-sm" name="classid">
                                <option value="" selected disabled hidden>select Class</option>
                                @foreach ($class as $section)
                                    <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control form-control-sm" name="date">
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
        <div class="card  p-2">
            <h5 class="card-header">student Attendance
                <small class="text-muted float-end"> <a href="{{ url('classteacher/studenttakeattendance') }}"
                        class="btn btn-info btn-sm">Take
                        Attendance</a> <a href="{{ url('classteacher/studentfilterattendance') }}"
                        class="btn btn-info btn-sm">Filter
                        Attendance</a></small>
            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table  table-striped table-hover border-dark" id="example">
                    <thead class="table-dark">
                        <tr>
                            <th>Sl.No</th>
                            <th>NAME</th>
                            <th>class/section</th>
                            <th>DATE</th>
                            <th>Attendance</th>
                        </tr>
                    </thead>
                    @for ($i = 0; $i < 1; $i++)
                    @endfor
                    <tbody class="table-border-bottom-0">
                        @foreach ($studentatt as $studentatts)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $studentatts->s_name }}</td>
                                <td>{{ $studentatts->c_class }}</td>
                                <td>{{ $studentatts->stud_date }}</td>
                                <td>{{ $studentatts->tt_name }}</td>
                                {{-- <td>
                                <div class="dropdown">
                                    <button class=" dropdown-toggle drop " id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-sharp fa-solid fa-bars"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item"
                                                href="{{ url('classteacher/studentattendanceedit') }}"><i
                                                    class="fa-solid fa-pen"></i> Edit</a></li>

                                    </ul>
                                </div>
                            </td> --}}
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
