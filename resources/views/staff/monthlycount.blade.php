@extends('layouts.default')
@section('title', 'Total Monthly')
@section('sidebar')
    @include('include.sidebar')
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
                    <form class="" action="{{ route('admin.monthlyfilter') }}" method="GET">
                    @elseif (auth()->user()->type == 'clerk')
                        <form class="" action="{{ route('clerk.monthlyfilter') }}" method="GET">
                        @else
                            return redirect()->route('home');
                @endif
                <div class="form-group row mb-1">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Select</label>
                    <div class="col-md-3">
                        <select id="" name="staffpostion" class="form-control form-control-sm" autocomplete="off"
                            required>
                            <option value="" selected disabled hidden>Select Position</option>
                            @foreach ($position as $positiondata)
                                <option value="{{ $positiondata->sp_id }}">{{ $positiondata->sp_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="month" class="form-control form-control-sm" name="month">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary  btn-sm"> <i class="bx bx-search fs-5 lh-0"></i> Search</button>
                    </div>
                </div>
                </form>
            </div>
        </div>


    
    <hr class="my-3" />
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Attendance List</h5>


        <div class="card  p-2">
            <h5 class="card-header">PR (Present) - AB (Absent)
                <small class="text-danger float-end">{{ $fyear }}</small>
            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table" id="">
                    <thead class="">
                        <tr>
                            <th>Sl.No</th>
                            <th>NAME</th>
                            <th>staff position</th>
                            <th>month</th>
                            <th>Pr</th>
                            <th>Ab</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    @for ($i = 0; $i < 1; $i++)
                    @endfor
                    <tbody class="table-border-bottom-0">
                        @foreach ($attendanceRecords as $attendanceRecord)
                            <tr>

                                <td>{{ $attendanceRecord->staff_id }}</td>
                                <td>{{ $presentCount }}</td>
                                <td>{{ $absentCount }}</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
  
@endsection
