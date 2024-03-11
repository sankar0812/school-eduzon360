@extends('layouts.default')
@section('title', 'Student Attendance View')
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
                <form action="{{ route('admin.monthlycountfilter') }}" method="GET">
                @elseif (auth()->user()->type == 'staff')
                    <form action="{{ route('classteacher.monthlycountfilter') }}" method="GET">
                    @else
                        return redirect()->route('home');
            @endif

            {{-- @csrf --}}
            <div class="form-group row mb-1">
                <label for="input" class="col-sm-2 col-form-label">Select Class</label>
                <div class="col-md-4">
                    <select class="form-control " name="classid">
                        <option value="" selected disabled hidden>select Class</option>
                        @foreach ($class as $section)
                            <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="Month" class="form-control " name="monthid">
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
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Monthly Attendance Filter</h5>

    <div class="card  p-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0"></h6>
            <small class="text-danger float-end">{{ $fyear }}</small>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table" id="example">
                <thead class="">
                    <tr>
                        <th>Sl.No</th>
                        <th>NAME</th>
                        <th>class/section</th>
                        <th>Present</th>
                        <th>Absent</th>
                        <th>Total</th>
                    </tr>
                </thead>
                @for ($i = 0; $i < 0; $i++)
                @endfor
                <tbody class="table-border-bottom-0">
                    @foreach ($attendanceData as $studentId => $studentInfo)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $studentInfo['name'] }}</td>
                            <td>{{ $classname }}</td>
                            <td class="text-success">{{ $studentInfo['presences'] }}</td>
                            <td class="text-danger">{{ $studentInfo['absences'] }}</td>
                            <td>{{ $studentInfo['presences'] + $studentInfo['absences'] }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            @if (auth()->user()->type == 'admin')
                <a href="{{ url('admin/studentattendance') }}" class="btn btn-dark btn-sm">Back</a>
            @elseif (auth()->user()->type == 'staff')
                <a href="{{ url('classteacher/studentattendance') }}" class="btn btn-dark btn-sm">Back</a>
            @else
                return redirect()->route('home');
            @endif

        </div>
    </div>

@endsection
