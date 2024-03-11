@extends('layouts.default')
@section('title', 'Take Attendance')
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
                
                <form action="{{ route('classteacher.attendancetakefilter') }}" method="GET">
                    {{-- @csrf --}}
                    <div class="form-group row mb-1">
                        <label for="input" class="col-sm-2 col-form-label">Select Class</label>
                        <div class="col-md-5">
                            <select class="form-control form-control-sm" name="classid">
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
    <form action="{{ route('classteacher.attendancetakeinsert') }}" method="post">
        @csrf
        <div class="row py-2">
            <div class="card p-2">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"> <input type="date" name="att_date" id="" class="form-control" required>
                    </h6>
                    <small class=" float-end text-danger">{{ $fyear }}</small>
                </div>
                <div class="table-responsive text-nowrap ">
                    <table class="table  table-striped table-hover  border-dark">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>class/section</th>
                                <th>Attendance</th>
                            </tr>
                        </thead>
                        @for ($i = 0; $i < 1; $i++)
                        @endfor
                        <tbody class="table-border-bottom-0">
                            @foreach ($students as $studentsview)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <input type="hidden" value="{{ $studentsview->stid }}"
                                            class="form-control form-control-sm" name="studentname[]">
                                        <input type="text" value="{{ $studentsview->stname }}"
                                            class="form-control form-control-sm" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" value="{{ $studentsview->cid }}"
                                            class="form-control form-control-sm" name="studentclass[]">
                                        <input type="text" value="{{ $studentsview->cname }}"
                                            class="form-control form-control-sm" readonly>
                                    </td>
                                    <td><select class="form-control " required name="attendance[]">
                                            @foreach ($att as $atts)
                                                <option value="{{ $atts->tt_id }}" class="btn">
                                                    {{ $atts->tt_name }}</option>
                                            @endforeach

                                        </select>
                                    </td>
                                </tr>
                            @endforeach

                    </table>
                </div>
                <div class="col-12 p-2">
                    <button type="submit" class="btn btn-primary btn-sm">Submit form</button>
                    <a href="{{ url('classteacher/studentattendance') }}" class="btn btn-dark btn-sm">Back</a>
                </div>
            </div>
        </div>


    </form>
@endsection
