@extends('layouts.default')
@section('title', 'Fees Details')
@section('sidebar')
@include('include.sidebar')
@endsection

@section('contentdashboard')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0"></h6>
        </div>
        <div class="card-body">
            @if (auth()->user()->type == 'admin')
            <form method="post" action="{{ route('adminfees.studentfilter') }}">

                @elseif (auth()->user()->type == 'accountant')
                <form method="post" action="{{ route('accountantfees.studentfilter') }}">
                    @else
                    return redirect()->route('home');
                    @endif
                    @csrf
                    <div class="form-group row mb-1">
                        <label for="input" class="col-sm-2 col-form-label">Select Class</label>
                        <div class="col-md-5">
                            <select class="form-control" name="class" required>
                                <option value="" selected disabled hidden>Select Class</option>
                                @foreach ($class as $section)
                                <option value="{{ $section->id }}">{{ $section->c_class }}</option>
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

    <hr class="my-5" />
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Student Fees List</h5>
    <div class="card p-2">
        <div class="table-responsive text-nowrap py-2">
            <div class="table-responsive text-nowrap ">
                <table class="table" id="example3">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Name</th>
                            <th>Total Fees</th>
                            <th>Academic Year</th>
                            <th>Balance</th>
                            <th class="exclude-export">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feesRecords as $feesRecord)
                        <tr>
                            <td>{{ $feesRecord->c_class }}</td>
                            <td>{{ $feesRecord->s_name }}</td>
                            <td>{{ $feesRecord->total_fees }}</td>
                            <td>{{ $feesRecord->academic_year }}</td>
                            <td>{{ $feesRecord->balance }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#previousYearModal{{ $feesRecord->s_id }}">
                                    Previous Year Records
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@foreach($feesRecords as $feesRecord)
<!-- Modal for previous year records -->
<div class="modal fade" id="previousYearModal{{ $feesRecord->s_id }}" tabindex="-1" aria-labelledby="previousYearModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previousYearModalLabel">Previous Year Records</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table" id="example7">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Total Fees</th>
                            <th>Academic Year</th>
                            <th>Balance</th>
                            <th>Total Fees Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($previousYearRecords as $studentId => $records)
                        @if($feesRecord->s_id == $studentId)
                        @foreach ($records as $record)
                        <tr>
                            <td>{{ $record->s_name }}</td>
                            <td>{{ $record->c_class }}</td>
                            <td>{{ $record->total_fees }}</td>
                            <td>{{ $record->academic_year }}</td>
                            <td>{{ $record->balance }}</td>
                            <td>{{ $record->total_fees_paid }}</td>
                        </tr>
                        @endforeach
                        @elseif($studentId == '')
                        <tr>
                            <td colspan="6">There are No Previous Records.</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection