@extends('layouts.default')
@section('title', 'Staff Attendance_View')
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
            {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-primary btn-sm">Show
                    Logins</a></small> --}}
        </div>
        <div class="card-body">

            @if (auth()->user()->type == 'admin')
                <form class="" action="{{ route('admin.todayfilter') }}" method="GET">
                @elseif (auth()->user()->type == 'clerk')
                    <form class="" action="{{ route('clerkadmin.todayfilter') }}" method="GET">
                    @else
                        return redirect()->route('home');
            @endif
            <div class="form-group row mb-1">
                <label for="inputPassword" class="col-sm-2 col-form-label">Select</label>
                <div class="col-md-3">
                    <select id="" name="staffpostion" class="form-control" autocomplete="off" required>
                        <option value="" selected disabled hidden>Select Position</option>
                        @foreach ($position as $positiondata)
                            <option value="{{ $positiondata->sp_id }}">{{ $positiondata->sp_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control " name="date">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-3  py-2">
                    <button type="submit" class="btn btn-primary  btn-sm"> <i class="bx bx-search fs-5 lh-0"></i>
                        Search</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <hr class="my-3" />
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Attendance List</h5>
    <div class="card  p-2">
        <h5 class="card-header">
            @if (auth()->user()->type == 'admin')
                <small class="text-muted float-end"> <a href="{{ url('admin/takeattendance') }}"
                        class="btn btn-primary btn-sm">Take
                        Attendance</a> <a href="{{ url('admin/showattendance') }}" class="btn btn-primary btn-sm">Filter
                        Attendance</a>
                    <a href="{{ url('admin/staffmonthlycount') }}" class="btn btn-primary btn-sm">Monthly Total</a>
                </small>
            @elseif (auth()->user()->type == 'clerk')
                <small class="text-muted float-end"> <a href="{{ url('clerk/takeattendance') }}"
                        class="btn btn-primary btn-sm">Take
                        Attendance</a> <a href="{{ url('clerk/showattendance') }}" class="btn btn-primary btn-sm">Filter
                        Attendance</a>
                    <a href="{{ url('clerk/staffmonthlycount') }}" class="btn btn-primary btn-sm">Monthly Total</a>
                </small>
            @else
                return redirect()->route('home');
            @endif


        </h5>
        <div class="table-responsive text-nowrap">
            <table class="table " id="example">
                <thead class="">
                    <tr>
                        <th>Sl.No</th>
                        <th>NAME</th>
                        <th>staff position</th>
                        <th>DATE</th>
                        <th>Attendance</th>
                        <th>permission</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                @for ($i = 0; $i < 1; $i++)
                @endfor
                <tbody class="table-border-bottom-0">
                    @foreach ($staffs as $view)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $view->sf_name }}</td>
                            <td>{{ $view->sp_name }}</td>
                            <td>{{ $view->att_date }}</td>
                            <td>{{ $view->tt_name }}</td>
                            <td>{{ $view->permission }}</td>
                            <td>
                                {{-- <a href="{{ url('staffattendanceedit') }}" class="btn btn-outline-warning btn-sm"><i
                                    class="fa-solid fa-file-pen fa-lg"></i></a>
                            <a href="" class="btn btn-outline-danger btn-sm"><i
                                    class="fa-solid fa-trash fa-lg "></i></a> --}}
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                          <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                        <li>
                                            @if (auth()->user()->type == 'admin')
                                                <a class="dropdown-item"
                                                    href="{{ url('admin/staffattendanceedit', $view->staffattid) }}"><i
                                                        class="fa-solid fa-pen"></i> Edit</a>
                                            @elseif (auth()->user()->type == 'clerk')
                                                <a class="dropdown-item"
                                                    href="{{ url('clerk/staffattendanceedit', $view->staffattid) }}"><i
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

@endsection
