@extends('layouts.default')
@section('title', 'Exam Timetable Details')
@section('sidebar')
@include('include.sidebar')
@endsection
@section('contentdashboard')
@php

$year = DB::table('examtimetables')
->select('year')
->distinct()
->get();

@endphp



<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0"></h6>
        <small class="text-muted float-end"></small>
    </div>
    <div class="card-body">
        @if (auth()->user()->type == 'admin')
        <form class="" action="{{ route('exam.timetablefilter') }}" method="GET">
            @elseif (auth()->user()->type == 'clerk')
            <form class="" action="{{ route('clerkexam.timetablefilter') }}" method="GET">
                @else
                return redirect()->route('home');
                @endif


                <div class="form-group row mb-1">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Select </label>
                    <div class="col-md-3">
                        <select class="form-select " name="fyear" aria-label=".form-select-sm example">
                            <option value="" selected disabled hidden>Select Year</option>
                            @foreach ($year as $years)
                            <option value="{{ $years->year }}">{{ $years->year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select " name="examtypeid" aria-label=".form-select-sm example">
                            <option value="" selected disabled hidden>Select Exam Type</option>
                            @foreach ($exam as $exams)
                            <option value="{{ $exams->id }}">{{ $exams->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="month" name="months" id="" class="form-control">
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
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Exam Timetable</h5>

<div class="card p-2">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0"></h6>
        <small class="text-muted float-end">
            @if (auth()->user()->type == 'admin')
            <a href="{{ url('offlineexam') }}" class="btn btn-primary btn-sm">TimeTable <i class="fa-regular fa-calendar-plus"></i></a>
            @elseif (auth()->user()->type == 'clerk')
            <a href="{{ url('clerk/offlineexam') }}" class="btn btn-primary btn-sm">TimeTable <i class="fa-regular fa-calendar-plus"></i></a>
            @else
            return redirect()->route('home');
            @endif

        </small>
    </div>
    <div class="col-xl">
        <div class="table-responsive text-nowrap">
            <table class="table" id="example">
                <thead class="">
                    <tr>
                        <th>table</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($examview as $examviews)
                    <tr>
                        <td>
                            <h5>Class : {{ $examviews->c_class }} || Exam Type: {{ $examviews->name }} || Exam
                                Month: {{ $examviews->months_id }} || Exam Year: {{ $examviews->year }}</h5>
                            <table class="table table-bordered">
                                <thead class="">

                                    <tr class="text-info">
                                        <th>Date</th>
                                        <th>Day</th>
                                        <th>Time</th>
                                        <th>Subject Code</th>
                                        <th>Subject</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($examviews->tableview as $view)
                                    <tr>
                                        <td>{{ $view->ett_date }}</td>
                                        <td>{{ $view->ett_day }}</td>
                                        <td>{{ $view->ett_time }}</td>
                                        <td>{{ $view->ett_code }}</td>
                                        <td>{{ $view->ett_subject }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        @if (auth()->user()->type == 'admin')
                                        <a class="dropdown-item" href="{{ url('offlineexamedit', $examviews->timetable_id) }}"><i class="fa-solid fa-pen"></i> Edit</a>
                                        @elseif (auth()->user()->type == 'clerk')
                                        <a class="dropdown-item" href="{{ url('clerk/offlineexamedit', $examviews->timetable_id) }}"><i class="fa-solid fa-pen"></i> Edit</a>
                                        @else
                                        return redirect()->route('home');
                                        @endif


                                    </li>
                                    {{-- <li><a class="dropdown-item" href="#"><i class="fa-solid fa-trash "></i>
                                                    Delete</a></li> --}}
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection