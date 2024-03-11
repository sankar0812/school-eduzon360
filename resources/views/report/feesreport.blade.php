@extends('layouts.default')
@section('title', ' Fees Report')
@section('sidebar')
@include('include.sidebar')
@endsection
@section('contentdashboard')

​
@php
$position = DB::table('class_sections')
->select('id', 'c_class')
->get();
@endphp
​

<div class="card p-2">
    <div class="card-body">
        @if (auth()->user()->type == 'admin')
        <form class="" action="{{ route('admin.getfeesReport') }}" method="GET">
            @elseif (auth()->user()->type == 'clerk')
            <form class="" action="{{ route('clerkadmin.getfeesReport') }}" method="GET">
                @else
                return redirect()->route('home');
                @endif


                <div class="form-group row mb-1">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Select Class</label>
                    <div class="col-md-5">
                        <select id="" name="class" class="form-control" autocomplete="off" required>
                            <option value="" selected disabled hidden>Select Class</option>
                            @foreach ($position as $positiondata)
                            <option value="{{ $positiondata->id }}">{{ $positiondata->c_class }}</option>
                            @endforeach
                        </select>
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

​
​
<hr class="my-3" />
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Fees Report</h5>

<div class="col-xl ">
    <div class="card ">
        <div class="card-header d-flex justify-content-between align-items-center">

        </div>
        <div class="card-body">

            <div class="table-responsive text-nowrap ">
                @if ($feesReportByClass->isEmpty())
                <p>No fees records found for the selected criteria.</p>
                @else
                <table class="table" id="example8">

                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Class Grade</th>
                            <th>Total Fees</th>
                            <th>Total Fees Paid</th>
                            <th>Total Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feesReportByClass as $report)
                        <tr>
                            <td>{{ $report->student_id }}</td>
                            <td>{{ $report->student_name }}</td>
                            <td>{{ $report->class_grade }}</td>
                            <td>{{ $report->total_fees }}</td>
                            <td>{{ $report->total_fees_paid }}</td>
                            <td>{{ $report->total_balance }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

            </div>
        </div>
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