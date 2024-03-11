@extends('layouts.default')
@section('title', 'Staff filter Attendance')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    @php
        $position = DB::table('staffpositions')
            ->select('sp_id', 'sp_name')
            ->get();

        $month = DB::table('staffattandances')
            ->select('att_month')
            ->distinct()
            ->get();
    @endphp
  
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
            Logins</a></small> --}}
            </div>
            <div class="card-body">

                @if (auth()->user()->type == 'admin')
                    <form action="{{ route('filterAttendance') }}" method="GET">
                    @elseif (auth()->user()->type == 'clerk')
                        <form action="{{ route('clerkfilterAttendance') }}" method="GET">
                        @else
                            return redirect()->route('home');
                @endif

                {{-- @csrf --}}
                <div class="form-group row mb-1">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Select</label>
                    <div class="col-md-5">
                        <select id="" name="staffpostion" class="form-control " autocomplete="off" required>
                            <option value="" selected disabled hidden>Select Position</option>
                            @foreach ($position as $positiondata)
                                <option value="{{ $positiondata->sp_id }}">{{ $positiondata->sp_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        {{-- <select id="" name="month" class="form-control form-control-sm" autocomplete="off">
                                <option value="" selected disabled hidden>Select month</option>
                                @foreach ($month as $monthdata)
                                    <option value="{{ $monthdata->att_month }}">{{ $monthdata->att_month }}</option>
                                @endforeach
                            </select> --}}
                    </div>

                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-3  py-2">
                        <button type="submit" class="btn btn-primary  btn-sm"> <i class="bx bx-search fs-5 lh-0"></i> Search</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
   

        <hr class="my-3" />
        <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Attendance List</h5>

   
        <div class="card p-2">
            <h6 class="card-header">
            </h6>
            <div class="table-responsive text-nowrap ">
                <table class="table" id="example">
                    <thead class="">
                        <tr>
                            <th>Name</th>
                            <th>p</th>
                            <th>Ab</th>
                            @foreach ($dateses as $date)
                                <th>{{ $date }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendanceData as $staffId => $staff)
                            @php
                                $check_pres = DB::table('staffattandances')
                                    ->join('staff', 'staff.id', '=', 'staffattandances.staff_id')
                                    ->where('staffattandances.staff_id', $staff['sid'])
                                    ->where('att_id', '1')
                                    ->where('att_month', now()->format('Y-m'))
                                    ->count();
                                $check_abs = DB::table('staffattandances')
                                    ->join('staff', 'staff.id', '=', 'staffattandances.staff_id')
                                    ->where('staffattandances.staff_id', $staff['sid'])
                                    ->where('att_id', '2')
                                    ->where('att_month', now()->format('Y-m'))
                                    ->count();
                            @endphp
                            <tr class="student">
                                <td class="text-dark">{{ $staff['name'] }}</td>
                                <td>{{ $check_pres }}</td>
                                <td>{{ $check_abs }}</td>
                                @foreach ($dates as $date)
                                    <td class="attend-col">
                                        <div class="form-check form-check-inline">
                                            @php
                                                $attendance = $staff['attendance'][$date];

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
            <div class="py-2">
                @if (auth()->user()->type == 'admin')
                    <a href="{{ url('admin/staffattendance') }}" class="btn btn-dark  mb-4">Back</a>
                @elseif (auth()->user()->type == 'clerk')
                    <a href="{{ url('clerk/staffattendance') }}" class="btn btn-dark  mb-4">Back</a>
                @else
                    <?php
                    return redirect()->route('home');
                    ?>
                @endif

            </div>
        </div>
   
@endsection
