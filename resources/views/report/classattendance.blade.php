@extends('layouts.default')
@section('title', ' Student Attendance')
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



    <div class="card-body">
        @if (auth()->user()->type == 'admin')
        <form action="{{ route('admin.classattendance') }}" method="GET">
            @elseif (auth()->user()->type == 'clerk')
            <form action="{{ route('clerkstudent.classattendance') }}" method="GET">
                @else
                return redirect()->route('home');
                @endif

                {{-- @csrf --}}

                <div class="form-group row mb-1">
                    <label for="start_date" class="col-sm-2 col-form-label"> Date</label>
                    <div class="col-md-5">
                        <input type="date" class="form-control" name="search_date" required>
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
<!-- <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Student Attendance</h5> -->

<h5 class="fw-bold mb-3">
                @if ($currentDate == today())
                    Attendance Report for Today
                @else
                    Attendance Report for {{ \Carbon\Carbon::parse($currentDate)->format('F j, Y') }}
                @endif
            </h5>
<div class="card p-2">

    <div class="table-responsive text-nowrap ">
        <table class="table  " id="example">
            <thead>
                <tr>
                    <th>Class ID</th>
                    <th>Total Attendance</th>
                    <th>Present Count</th>
                    <th>Absent Count</th>
                    <th>Present Percentage</th>
                    <th>Absent Percentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendanceReport as $report)
                <tr>
                    <td>{{ $report->stud_classid }}</td>
                    <td>{{ $report->total_attendance }}</td>
                    <td>{{ $report->present_count }}</td>
                    <td>{{ $report->absent_count }}</td>
                    <td style="color: green;">{{ number_format($report->present_percentage, 2) }}%</td>
                    <td style="color: red;">{{ number_format($report->absent_percentage, 2) }}%</td>

                </tr>
                @endforeach
            </tbody>
        </table>
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