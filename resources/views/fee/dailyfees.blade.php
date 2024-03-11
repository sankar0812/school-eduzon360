<!-- @extends('layouts.default')
@section('title', 'Daily Fees')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
            Logins</a></small> --}}
            </div>
            <div class="card-body">
                @if (auth()->user()->type == 'admin')
                    <form class="row g-3" action="{{ route('fees.previousday') }}" method="POST" enctype="multipart/form-data">
                    @elseif (auth()->user()->type == 'accountant')
                        <form class="row g-3" action="{{ route('accountant.previousday') }}" method="POST"
                            enctype="multipart/form-data">
                        @else
                            return redirect()->route('home');
                @endif

                @csrf

                <div class="form-group row mb-1">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Select Date</label>
                    <div class="col-md-5">
                        <input type="date" required class="form-control form-control-sm" name="date" placeholder="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary mb-4 btn-sm">Apply Filter <i
                                class="fa-solid fa-location-arrow"></i></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row py-2">
        <div class="card p-2">
            <h5 class="card-header">
                Date : {{ date('m-d-Y', strtotime($todayDate)) }}
                <small class="text-muted float-end">
                    @if (auth()->user()->type == 'admin')
                        <a href="{{ url('admin/dailyfees') }}" class="btn btn-info btn-sm">Daily
                            Fees</a>
                        <a href="{{ url('admin/monthlyfees') }}" class="btn btn-outline-info btn-sm">Monthly Fees</a>
                        <a href="{{ url('admin/yearlyfees') }}" class="btn btn-outline-info btn-sm">yearly
                            Fees</a>
                    @elseif (auth()->user()->type == 'accountant')
                        <a href="{{ url('accountant/dailyfees') }}" class="btn btn-info btn-sm">Daily
                            Fees</a>
                        <a href="{{ url('accountant/monthlyfees') }}" class="btn btn-outline-info btn-sm">Monthly Fees</a>
                        <a href="{{ url('accountant/yearlyfees') }}" class="btn btn-outline-info btn-sm">yearly
                            Fees</a>
                    @else
                        return redirect()->route('home');
                    @endif
                </small>
            </h5>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>r.no</th>
                            <th>class</th>
                            <th>name</th>
                            <th>Admission Fee</th>
                            <th>Term1 Fee</th>
                            <th>Term2 Fee</th>
                            <th>Term3 Fee</th>
                            <th>Book Fee</th>
                            <th>Uniform Fee</th>
                            <th>Fine</th>
                            <th>Other Fee</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($feespaid as $fee)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $fee->class }}</td>
                                <td>{{ $fee->studentname }}</td>
                                <td>{{ $fee->admission }}</td>
                                <td>{{ $fee->term1 }}</td>
                                <td>{{ $fee->term2 }}</td>
                                <td>{{ $fee->term3 }}</td>
                                <td>{{ $fee->books }}</td>
                                <td>{{ $fee->uniform }}</td>
                                <td>{{ $fee->fine }}</td>
                                <td>{{ $fee->extra }}</td>
                                <td>{{ $fee->totalpaidfees }}</td>
                                {{-- <th>{{500000}}</th> --}}
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td style="font-weight:bolder;">Total</td>
                            <td></td>
                            <td>{{ $totalfeespaid->admissiontotal }}</td>
                            <td>{{ $totalfeespaid->term1total }}</td>
                            <td>{{ $totalfeespaid->term2total }}</td>
                            <td>{{ $totalfeespaid->term3total }}</td>
                            <td>{{ $totalfeespaid->booktotal }}</td>
                            <td>{{ $totalfeespaid->uniformtotal }}</td>
                            <td>{{ $totalfeespaid->finetotal }}</td>
                            <td>{{ $totalfeespaid->extratotal }}</td>
                            <td style="font-weight:bolder;">{{ $totalfeespaid->totalpaidtoday }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection -->
@extends('layouts.default')
@section('title', 'Student Details')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')

    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
            Logins</a></small> --}}
            </div>
            <div class="card-body">
                @php
                    $class = DB::table('class_sections')
                        ->where(['c_status' => 1, 'c_delete' => 1])
                        ->get();
                @endphp

                @if (auth()->user()->type == 'admin')
                    <form action="{{ route('admin.studentclassfilter') }}" method="GET">
                    @elseif (auth()->user()->type == 'accountant')
                        <form action="{{ route('accountantstudent.studentclassfilter') }}" method="GET">
                        @else
                            return redirect()->route('home');
                @endif


                {{-- @csrf --}}
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
                        <button type="submit" class="btn btn-primary btn-sm">Apply Filter <i
                                class="fa-solid fa-location-arrow"></i></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row py-2">
        <div class="card p-2">
            <div class="table-responsive text-nowrap py-2">
                <div class="table-responsive text-nowrap ">
                    <table class="table  table-striped table-hover  border-dark" id="example3">
                        <thead class="table-dark">
                            <tr>
                                <th>Sl.No</th>
                                <th>NAME</th>
                                <th>CLASS</th>
                                <th>ADMISSION DATE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                         
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

