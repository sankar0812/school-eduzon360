@extends('layouts.default')
@section('title', 'Take Staff Attendance')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    @php
        $position = DB::table('staffpositions')
            ->select('sp_id', 'sp_name')
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
                <form class="" action="{{ route('admin.takefilter') }}" method="GET">
                @elseif (auth()->user()->type == 'clerk')
                    <form class="" action="{{ route('clerkadmin.takefilter') }}" method="GET">
                    @else
                        return redirect()->route('home');
            @endif



            <div class="form-group row mb-1">
                <label for="inputPassword" class="col-sm-2 col-form-label">staff Postion</label>
                <div class="col-md-5">
                    <select id="" name="staffpostion" class="form-control" autocomplete="off" required>
                        <option value="" selected disabled hidden>Select Position</option>
                        @foreach ($position as $positiondata)
                            <option value="{{ $positiondata->sp_id }}">{{ $positiondata->sp_name }}</option>
                        @endforeach
                    </select>
                    <span>
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

    @if (auth()->user()->type == 'admin')
        <form action="{{ route('admin.attendanceinsert') }}" method="post" enctype="multipart/form-data">
        @elseif (auth()->user()->type == 'clerk')
            <form action="{{ route('clerkadmin.attendanceinsert') }}" method="post" enctype="multipart/form-data">
            @else
                return redirect()->route('home');
    @endif
    @csrf

    <div class="card p-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0"> <input type="date" name="att_date" id="" class="form-control" required>
            </h6>
            <small class=" float-end text-danger">{{ $fyear }}</small>
        </div>
        <div class="table-responsive text-nowrap ">
            <table class="table ">
                <thead class="">
                    <tr>
                        <th>Sl.No</th>
                        <th>NAME</th>
                        <th>staff position</th>
                        <th>Attendance</th>
                        <th>permission</th>
                    </tr>
                </thead>
                @for ($i = 0; $i < 1; $i++)
                @endfor
                <tbody class="table-border-bottom-0">
                    @foreach ($staffs as $staff)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                <input type="hidden" value="{{ $staff->id }}" class="form-control form-control-sm"
                                    name="staffname[]">
                                <input type="text" value="{{ $staff->sf_name }}" class="form-control form-control-sm"
                                    readonly>
                            </td>
                            <td>
                                <input type="hidden" value="{{ $staff->sp_id }}" class="form-control form-control-sm"
                                    name="staffposition[]">
                                <input type="text" value="{{ $staff->sp_name }}" class="form-control form-control-sm"
                                    readonly>
                            </td>
                            <td><select class="form-control form-control-sm" required name="attendance[]">
                                    @foreach ($att as $atts)
                                        <option value="{{ $atts->tt_id }}" class="btn">
                                            {{ $atts->tt_name }}</option>
                                    @endforeach

                                </select>
                            </td>

                            <td><input type="type" name="permission[]" class="form-control form-control-sm"></td>
                        </tr>
                    @endforeach
            </table>
        </div>
        <div class="col-12 p-2">
            <button type="submit" class="btn btn-primary ">Submit</button>
            @if (auth()->user()->type == 'admin')
                <a href="{{ url('admin/staffattendance') }}" class="btn btn-dark ">Back</a>
            @elseif (auth()->user()->type == 'clerk')
                <a href="{{ url('clerk/staffattendance') }}" class="btn btn-dark ">Back</a>
            @else
                return redirect()->route('home');
            @endif

        </div>
    </div>
    </form>

@endsection
