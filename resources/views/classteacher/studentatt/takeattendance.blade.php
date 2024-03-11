@extends('layouts.default')
@section('title', 'Take Attendance')
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
            @if (auth()->user()->type == 'admin')
                <form action="{{ route('admin.attendancetakefilter') }}" method="GET">
                @elseif (auth()->user()->type == 'staff')
                    <form action="{{ route('classteacher.attendancetakefilter') }}" method="GET">
                    @else
                        return redirect()->route('home');
            @endif


            {{-- @csrf --}}
            <div class="form-group row mb-1">
                <label for="input" class="col-sm-2 col-form-label">Select Class</label>
                <div class="col-md-5">
                    <select class="form-control " name="classid">
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
                    <button type="submit" class="btn btn-primary mt-2 btn-sm"><i class="bx bx-search fs-5 lh-0 "></i>
                        Search</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <hr class="my-3" />
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Take Attendance </h5>

    @if (auth()->user()->type == 'admin')
        <form action="{{ route('admin.attendancetakeinsert') }}" method="post">
        @elseif (auth()->user()->type == 'staff')
            <form action="{{ route('classteacher.attendancetakeinsert') }}" method="post">
            @else
                return redirect()->route('home');
    @endif

    @csrf

    <div class="card p-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0"> <input type="date" name="att_date" id="" class="form-control " required>
            </h6>
            <small class=" float-end text-danger">{{ $fyear }}</small>
        </div>
        <div class="table-responsive text-nowrap ">
            <table class="table">
                <thead class="">
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
                                <input type="hidden" value="{{ $studentsview->stid }}" class="form-control form-control-sm"
                                    name="studentname[]">
                                <input type="text" value="{{ $studentsview->stname }}"
                                    class="form-control form-control-sm" readonly>
                            </td>
                            <td>
                                <input type="hidden" value="{{ $studentsview->cid }}" class="form-control form-control-sm"
                                    name="studentclass[]">
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
            <button type="submit" class="btn btn-primary ">Submit</button>
            @if (auth()->user()->type == 'admin')
                <a href="{{ url('admin/studentattendance') }}" class="btn btn-dark">Back</a>
            @elseif (auth()->user()->type == 'staff')
                <a href="{{ url('classteacher/studentattendance') }}" class="btn btn-dark">Back</a>
            @else
                return redirect()->route('home');
            @endif

        </div>


    </div>



    </form>
@endsection
