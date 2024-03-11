@extends('layouts.default')
@section('title', 'Attendance View')
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
                <form action="{{ route('classteacher.myattendancemonth') }}" method="GET">
                    {{-- @csrf --}}
                    <div class="form-group row mb-1">
                        <label for="input" class="col-sm-2 col-form-label">Select month</label>
                        <div class="col-md-4">
                            <select class="form-control form-control-sm" name="monthid" required>
                                <option value="" selected disabled hidden >select month</option>
                                @foreach ($monthview as $monthviews)
                                    <option value="{{ $monthviews->att_month }}">{{ $monthviews->att_month }}</option>
                                @endforeach
                            </select>

                            {{-- <input type="month" name="monthid"> --}}
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
            <h5 class="card-header">Attendance

            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table  table-striped table-hover border-dark">
                    <thead class="table-dark">
                        <tr>
                            <th>Sl.No</th>
                            <th>date</th>
                            <th>month</th>
                            <th>year</th>
                            <th>Attendance</th>
                        </tr>
                    </thead>
                    @for ($i = 0; $i < 1; $i++)
                    @endfor
                    <tbody class="table-border-bottom-0">
                        @foreach ($attendanceRecords as $attendanceviews)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $attendanceviews->att_date }}</td>
                                <td>{{ $attendanceviews->att_month }}</td>
                                <td>{{ $attendanceviews->att_year }}</td>
                                <td>
                                    @if ($attendanceviews->att_id == 1)
                                        <h6 class="text-success">Present</h6>
                                    @else
                                        <h6 class="text-danger">Absent</h6>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-success">Total Present : {{ $pr }}</td>
                            <td class="text-danger">Total Absent : {{ $Ab }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
