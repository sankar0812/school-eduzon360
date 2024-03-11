@extends('layouts.default')
@section('title', 'Staff_Timetable')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <style>
        .tablesize {
            /* background: green; */
            padding: 10px;
            width: 900px;
            overflow: auto;
        }
    </style>

<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Add Staff timetable</h5>
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                <small class="text-muted float-end"> <a href="{{ url('/accountsadd') }}" class="btn btn-primary btn-sm"
                        data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-whatever="@mdo">Add <i
                            class="fa-solid fa-file-circle-plus "></i></a></small>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table  border-dark" id="example">
                    <thead class="">
                        <tr>
                            <th>name</th>
                            <th>Table</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php
                        $classtime = DB::table('dailyclasstimes')
                            ->select('classname')
                            ->get();
                    @endphp
                    <tbody class="table-border-bottom-0">
                        @foreach ($timetableView as $requested)
                            <tr>

                                <td> {{ $requested->sf_name }}</td>
                                <td>
                                    {{-- @if (!empty($requested->tableview)) --}}
                                    <div class="tablesize">
                                        <table class="table  table-bordered ">
                                            <tr class="">
                                                <th>Date</th>
                                                @foreach ($classtime as $classtimes)
                                                    <th>{{ $classtimes->classname }}</th>
                                                @endforeach
                                            </tr>

                                            @foreach ($requested->tableview as $subTimetable)
                                                <tr>
                                                    <td>{{ $subTimetable->day_name }}</td>
                                                    <td>{{ $subTimetable->pre1 }}</td>
                                                    <td>{{ $subTimetable->pre2 }}</td>
                                                    <td>{{ $subTimetable->pre3 }}</td>
                                                    <td>{{ $subTimetable->pre4 }}</td>
                                                    <td>{{ $subTimetable->pre5 }}</td>
                                                    <td>{{ $subTimetable->pre6 }}</td>
                                                    <td>{{ $subTimetable->pre7 }}</td>
                                                    <td>{{ $subTimetable->pre8 }}</td>
                                                </tr>
                                            @endforeach

                                        </table>
                                    </div>
                                    {{-- @else
                                        <p>No sub-timetable data available for this section.</p>
                                    @endif --}}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                          <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                            <li>
                                                @if (auth()->user()->type == 'admin')
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.stafftimetableedit', $requested->timetable_id) }}"><i
                                                            class="fa-solid fa-pen"></i> Edit</a>
                                                @elseif (auth()->user()->type == 'clerk')
                                                    <a class="dropdown-item"
                                                        href="{{ route('clerkadmin.stafftimetableedit', $requested->timetable_id) }}"><i
                                                            class="fa-solid fa-pen"></i> Edit</a>
                                                @else
                                                    return redirect()->route('home');
                                                @endif


                                            </li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">

                    @if (auth()->user()->type == 'admin')
                        <form class="" action="{{ route('admin.stafftimetable') }}" method="POST"
                            enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'clerk')
                            <form class="" action="{{ route('clerkadmin.stafftimetable') }}" method="POST"
                                enctype="multipart/form-data">
                            @else
                                return redirect()->route('home');
                    @endif

                    @csrf
                    <div class="table-responsive text-nowrap">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Select Staff</label>
                            <div class="col-sm-6">
                                <div class="input-group ">
                                    <select class="form-select " aria-label="Default select example"
                                        name="staffid" required>
                                        <option value="" selected disabled hidden>Select staff</option>
                                        @foreach ($staffdetails as $stafflist)
                                            <option value="{{ $stafflist->staff_id }}">{{ $stafflist->sf_name }} ( {{ $stafflist->sf_subject_taken }} )
                                                </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table class="table">
                            <thead class="">
                                <tr>
                                    <th>Date</th>
                                    @foreach ($classtime as $classtimes)
                                    <th>{{ $classtimes->classname }}</th>
                                @endforeach
                                </tr>
                            </thead>
                            @foreach ($days as $day)
                                <tr>

                                    <th class="text-dark">{{ $day->day_name }}</th>
                                    <input type="hidden" name="dayid[]" style="width:80px" value="{{ $day->id }}"
                                        autocomplete="off">

                                    <th><input type="text" name="pre1[]" style="width:80px" autocomplete="off">
                                    </th>
                                    <th><input type="text" name="pre2[]" style="width:80px" autocomplete="off">
                                    </th>
                                    <th><input type="text" name="pre3[]" style="width:80px" autocomplete="off">
                                    </th>
                                    <th><input type="text" name="pre4[]" style="width:80px" autocomplete="off">
                                    </th>
                                    <th><input type="text" name="pre5[]" style="width:80px" autocomplete="off">
                                    </th>
                                    <th><input type="text" name="pre6[]" style="width:80px" autocomplete="off">
                                    </th>
                                    <th><input type="text" name="pre7[]" style="width:80px" autocomplete="off">
                                    </th>
                                    <th><input type="text" name="pre8[]" style="width:80px" autocomplete="off">
                                    </th>
                                </tr>
                            @endforeach

                        </table>
                    </div>

                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">close</button> --}}
                        <button type="submit" class="btn btn-primary">Submit Form <i
                                class="fa-solid fa-location-arrow"></i></button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
