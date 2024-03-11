@extends('layouts.default')
@section('title', 'Monthly Fees')
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
                    <form class="row g-3" action="{{ route('fees.previousmonthfees') }}" method="POST"
                        enctype="multipart/form-data">
                    @elseif (auth()->user()->type == 'accountant')
                        <form class="row g-3" action="{{ route('accountant.previousmonthfees') }}" method="POST"
                            enctype="multipart/form-data">
                        @else
                            return redirect()->route('home');
                @endif

                @csrf

                <div class="form-group row mb-1">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Select Month</label>
                    <div class="col-md-5">
                        <select id="" name="date" required class="form-control form-control-sm" autocomplete="off"
                            required>
                            <option value="" selected disabled hidden>Select Month</option>
                            @foreach ($months as $month)
                                <option>{{ $month->paid_month }}</option>
                            @endforeach
                        </select>
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

                <small class="text-muted float-end">
                    @if (auth()->user()->type == 'admin')
                        <a href="{{ url('admin/dailyfees') }}" class="btn btn-outline-info btn-sm">Daily
                            Fees</a>
                        <a href="{{ url('admin/monthlyfees') }}" class="btn btn-info btn-sm">Monthly Fees</a>
                        <a href="{{ url('admin/yearlyfees') }}" class="btn btn-outline-info btn-sm">yearly
                            Fess</a>
                    @elseif (auth()->user()->type == 'accountant')
                        <a href="{{ url('accountant/dailyfees') }}" class="btn btn-outline-info btn-sm">Daily
                            Fees</a>
                        <a href="{{ url('accountant/monthlyfees') }}" class="btn btn-info btn-sm">Monthly Fees</a>
                        <a href="{{ url('accountant/yearlyfees') }}" class="btn btn-outline-info btn-sm">yearly
                            Fess</a>
                    @else
                        return redirect()->route('home');
                    @endif
                </small>
            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Total (RS)</th>
                            </tr>
                        </thead>
                    <tbody class="">
                        @foreach ($fees as $fee)
                            <tr>

                                <td>{{ ++$i }}</td>
                                <td>{{ $fee->paid_date }}</td>
                                <td>{{ $fee->total }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td> </td>
                            <td style="font-weight: bolder"> Total Amount </td>
                            <td>{{ $feestotal->total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
