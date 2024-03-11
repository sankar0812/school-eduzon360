@extends('layouts.default')
@section('title', 'Exam Timetable')
@section('sidebar')
@include('include.sidebar')
@endsection
@section('contentdashboard')
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Add Exam</h5>
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <small class="text-danger float-end"> {{ $fyear }}</small>
                @if (auth()->user()->type == 'admin')
                <form class="row g-3" action="{{ route('admin.examadd') }}" method="POST" enctype="multipart/form-data">
                    @elseif (auth()->user()->type == 'clerk')
                    <form class="row g-3" action="{{ route('clerk.examadd') }}" method="POST" enctype="multipart/form-data">
                        @else
                        return redirect()->route('home');
                        @endif

                        @csrf
                        <div class="col-md-4">
                            <label for="" class="form-label">Class & Section</label>
                            <select id="" name="classes" class="form-select" autocomplete="off" required>
                                <option value="" selected disabled hidden>Select Class & section</option>
                                @foreach ($class as $classes)
                                <option value="{{ $classes->id }}">{{ $classes->c_class }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Exam Type</label>
                            <select id="" name="examtype" class="form-select" autocomplete="off" required>
                                <option value="" selected disabled hidden>Select Exam Type</option>
                                @foreach ($examtype as $examtypes)
                                <option value="{{ $examtypes->id }}">{{ $examtypes->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Exam Month</label>
                            <input type="month" name="months" id="" class="form-control" required>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-success table-striped table-hover table-bordered border-dark" id="employee-table" width="350px" border="1">
                                <thead class="table-dark">
                                    <tr class="text-info">
                                        <th>Date</th>
                                        <th>Day</th>
                                        <th>Time</th>
                                        <th>Code</th>
                                        <th>Subject</th>
                                        {{-- <th>Question upload</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <tr>
                                        <td id="col0"><input type="date" class="form-control" placeholder="Date" name="dates[]" required></td>
                                        <td id="col1">
                                            <select id="" name="day[]" class="form-select" autocomplete="off" required>
                                                <option value="" selected disabled hidden>Select Exam Type</option>
                                                @foreach ($day as $days)
                                                <option value="{{ $days->day_name }}">{{ $days->day_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td id="col2"> <select id="" name="time[]" class="form-select" autocomplete="off" required>
                                                <option value="" selected disabled hidden>Select Exam Type</option>
                                                @foreach ($examtime as $examtimes)
                                                <option value="{{ $examtimes->et_name }}">{{ $examtimes->et_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td id="col3"><input type="text" class="form-control" name="code[]" placeholder="code">
                                        </td>
                                        <td id="col4">
                                            <select id="" name="subject[]" class="form-select" autocomplete="off" required>
                                                <option value="" selected disabled hidden>Select Exam Type</option>
                                                @foreach ($subject as $subjectss)
                                                <option value="{{ $subjectss->name }}">{{ $subjectss->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        {{-- <td id="col5"><input type="file" class="form-control" name="question[]"
                                                placeholder="file">
                                        </td> --}}
                                        <td id="col5"><input type="button" class="btn btn-danger" value="delete" onclick="deleteRow(this)" /></td>
                                        {{-- <td  id="col6"><input type="button" name="button1" value="Delete"
                                                onclick="deleteRows()"></td> --}}
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <table>
                            <tr>
                                <td><input type="button" class="btn btn-success" value="Add Row" onclick="addNewRow()" />
                                </td>
                                <td><input type="submit" class="btn btn-primary" value="Submit" />
                                    @if (auth()->user()->type == 'admin')
                                    <a href="{{ url('offlinetimetable') }}" class="btn btn-dark">Back</a>
                                    @elseif (auth()->user()->type == 'clerk')
                                    <a href="{{ url('clerk/offlinetimetable') }}" class="btn btn-dark">Back</a>
                                    @else
                                    return redirect()->route('home');
                                    @endif

                                </td>
                            </tr>
                        </table>

                    </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('other-scripts')
<script type="text/javascript">
    /* This method will add a new row */
    function addNewRow() {
        var table = document.getElementById("employee-table");
        var rowCount = table.rows.length;
        var cellCount = table.rows[0].cells.length;
        var row = table.insertRow(rowCount);
        for (var i = 0; i <= cellCount; i++) {
            var cell = 'cell' + i;
            cell = row.insertCell(i);
            var copycel = document.getElementById('col' + i).innerHTML;
            cell.innerHTML = copycel;
            if (i == 5) {
                // var radioinput = document.getElementById('col3').getElementsByTagName('input');
                for (var j = 0; j <= radioinput.length; j++) {
                    // if(radioinput[j].type == 'radio') {
                    // var rownum = rowCount;
                    // radioinput[j].name = 'gender['+rownum+']';
                    // }
                }
            }
        }
    }
    /* This method will delete a row */
    function deleteRow(ele) {
        var table = document.getElementById('employee-table');
        var rowCount = table.rows.length;
        // alert(rowCount);
        if (rowCount == 2) {
            alert("There is no row available to delete!");
            return;
        }
        if (ele) {
            //delete specific row
            ele.parentNode.parentNode.remove();
        } else {
            //delete last row
            table.deleteRow(rowCount - 1);
        }
    }
</script>
@endpush