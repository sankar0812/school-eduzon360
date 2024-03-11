@extends('layouts.default')
@section('title', ' Student Count')
@section('sidebar')
@include('include.sidebar')
@endsection
@section('contentdashboard')


<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Attendance Report</h6>
        {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
        Logins</a></small> --}}
    </div>

    @php
    $position = DB::table('staffpositions')
    ->select('sp_id', 'sp_name')
    ->get();
    @endphp

    <div class="card-body">
        @if (auth()->user()->type == 'admin')
        <form action="{{ route('admin.getStaffreport') }}" method="GET">
            @elseif (auth()->user()->type == 'clerk')
            <form action="{{ route('clerkadmin.getStaffreport') }}" method="GET">
                @else
                return redirect()->route('home');
                @endif

                {{-- @csrf --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-1">
                            <label for="start_date" class="col-sm-4 col-form-label">Date</label>
                            <div class="col-sm-8">
                                <input type="month" class="form-control" name="month" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-1">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Staff Position</label>
                            <div class="col-sm-8">
                                <select id="" name="staffposition" class="form-control" autocomplete="off" required>
                                    <option value="" selected disabled hidden>Select Position</option>
                                    @foreach ($position as $positiondata)
                                    <option value="{{ $positiondata->sp_id }}">{{ $positiondata->sp_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row text-center">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary "><i class="bx bx-search fs-5 lh-0"></i> Search</button>
                    </div>
                </div>

            </form>
    </div>
</div>

<hr class="my-3" />
<!-- <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Student Attendance</h5> -->

<h5 class="fw-bold mb-3">
    Staff Attendance for {{ $currentMonth }}
</h5>
<div class="card p-2">

    <div class="table-responsive text-nowrap ">


        @if(count($staffs) > 0)
        <table class="table" id="example8">
            <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Present Days</th>
                    <th>Absent Days</th>
                    <th>Attendance Percentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staffs as $staff)
                <tr>
                    <td>{{ $staff->id }}</td>
                    <td>{{ $staff->sf_name }}</td>
                    <td>{{ $staff->sp_name }}</td>
                    <td>{{ $staff->present_days }}</td>
                    <td>{{ $staff->absent_days }}</td>
                    <td>{{ $staff->attendance_percentage }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No attendance records found for the current month and position.</p>
        @endif
    </div>

</div>
@endsection
@push('other-scripts')
{{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script> --}}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js">
</script>
@endpush