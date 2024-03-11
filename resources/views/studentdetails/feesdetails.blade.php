@extends('layouts.studentapp')
@section('title', 'Fees Details')
@section('studentdashboard')

<div class="row py-2">
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
                <table class="table" id="example3">
                    <!-- Add your table headers here -->
                    <thead>
                        <tr>
                            <!-- <th>Student ID</th> -->
                            <th>Name</th>
                            <th>Total Fees</th>
                            <th>Academic Year</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($previousYearRecords as $studentId => $records)
                        @if($feesRecord->s_id == $studentId)
                        @foreach ($records as $record)
                        <tr>
                            <td>{{ $record->s_name }}</td>
                          
                            <td>{{ $record->total_fees }}</td>
                            <td>{{ $record->academic_year }}</td>
                            <td>{{ $record->balance }}</td>
                            
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