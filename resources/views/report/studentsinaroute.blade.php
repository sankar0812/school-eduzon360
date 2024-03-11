@extends('layouts.default')
@section('title', ' Student Count')
@section('sidebar')
@include('include.sidebar')
@endsection
@section('contentdashboard')


<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <!-- <h6 class="mb-0">Attendance Report</h6> -->
        {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
        Logins</a></small> --}}
    </div>



    <div class="card-body">
        @if (auth()->user()->type == 'admin')
        <form action="{{ route('admin.studentinaroute') }}" method="GET">
            @elseif (auth()->user()->type == 'clerk')
            <form action="{{ route('clerkstudent.studentinaroute') }}" method="GET">
                @else
                return redirect()->route('home');
                @endif

                {{-- @csrf --}}

                <div class="form-group row mb-1">
                    <label for="" class="col-sm-2 col-form-label">Route</label>
                    <div class="col-md-8">

                        <select class="form-control" aria-label="Default select example" name="route_id" required>
                            <option value="" selected disabled hidden>Select Route</option>
                            @foreach ($routes as $positiondata)
                            <option value="{{ $positiondata->id }}">{{ $positiondata->routetitle }}
                            </option>
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

<hr class="my-3" />
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Student In This Route</h5>


<div class="card p-2">

    <div class="table-responsive text-nowrap ">
        @if($studentRouteReport == NULL)
<h5 style="text-align: center;padding:15px;">Search Route for details...</h>
        @else
        <table class="table  " id="example8">
            <thead>
                <tr>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Route</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentRouteReport as $student)
                <tr>
                    <td>{{ $student->roll_no }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->route_name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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