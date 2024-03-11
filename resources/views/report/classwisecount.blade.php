@extends('layouts.default')
@section('title', ' Student Attendance')
@section('sidebar')
@include('include.sidebar')
@endsection
@section('contentdashboard')

<div class="card">
    <div class="card-header d-flex  align-items-left">
     
        <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Classwise Student Count</h5>
        
    </div>
    <div class="card-body">

        <div class="table-responsive text-nowrap ">
            <table class="table" id="example8">
                <thead>
                    <tr>
                        <th>Class ID</th>
                        <th>Total Students</th>
                        <th>Male Students</th>
                        <th>Female Students</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classwiseCounts as $classwiseCount)
                    <tr>
                        <td>{{ $classwiseCount->c_class }}</td>
                        <td>{{ $classwiseCount->total_students }}</td>
                        <td>{{ $classwiseCount->male_count }}</td>
                        <td>{{ $classwiseCount->female_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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