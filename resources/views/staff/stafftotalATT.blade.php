@extends('layouts.default')
@section('title', 'Staff Attendance_View')
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
                    <form action="{{ route('admin.monthlycountfilter') }}" method="GET">
                    @elseif (auth()->user()->type == 'clerk')
                        <form action="{{ route('clerk.monthlycountfilter') }}" method="GET">
                        @else
                            return redirect()->route('home');
                @endif

                {{-- @csrf --}}
                <div class="form-group row mb-1">
                    <label for="input" class="col-sm-2 col-form-label">Select Class</label>
                    <div class="col-md-4">
                        <select id="" name="staffpostion" class="form-control " autocomplete="off"
                            required>
                            <option value="" selected disabled hidden>Select Position</option>
                            @foreach ($positions as $positiondata)
                                <option value="{{ $positiondata->sp_id }}">{{ $positiondata->sp_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="Month" class="form-control " name="monthid" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-3 py-2">
                        <button type="submit" class="btn btn-primary  btn-sm"> <i class="bx bx-search fs-5 lh-0"></i> Search</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
 
        <hr class="my-3" />
        <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Attendance Month List</h5>
    
    
   
        <div class="card  p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                <small class="text-danger float-end">{{ $fiscalYear }}</small>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table  " id="example">
                    <thead class="">
                        <tr>
                            <th>Sl.No</th>
                            <th>NAME</th>
                            <th>Position</th>
                            <th>Present</th>
                            <th>Absent</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    @for ($i = 0; $i < 0; $i++)
                    @endfor
                    <tbody class="table-border-bottom-0">
                        @foreach ($attendanceData as $staffData)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $staffData['name'] }}</td>
                                <td>{{ $staffName}}</td>
                                <td>{{ $staffData['presences'] }}</td>
                                <td>{{ $staffData['absences'] }}</td>
                                <td>{{ $staffData['presences'] + $staffData['absences'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

                @if (auth()->user()->type == 'admin')
                    <a href="{{ url('admin/staffattendance') }}" class="btn btn-dark ">Back</a>
                @elseif (auth()->user()->type == 'clerk')
                    <a href="{{ url('clerk/staffattendance') }}" class="btn btn-dark ">Back</a>
                @else
                    return redirect()->route('home');
                @endif

            </div>
        </div>
  
@endsection
