@extends('layouts.default')
@section('title', 'Yearly Expense')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
 
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
        Logins</a></small> --}}
            </div>
            <div class="card-body mt-4">
                @if (auth()->user()->type == 'admin')
                    <form class="row g-3" action="{{ route('expense.previousyear') }}" method="POST"
                        enctype="multipart/form-data">
                    @elseif (auth()->user()->type == 'accountant')
                        <form class="row g-3" action="{{ route('accountant.previousyear') }}" method="POST"
                            enctype="multipart/form-data">
                        @else
                            return redirect()->route('home');
                @endif

                @csrf
                <div class="form-group row mb-1">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Select Year</label>
                    <div class="col-md-5">
                        <select id="" name="date" class="form-control " autocomplete="off" required>
                            <option value="" selected disabled hidden>Select Year</option>
                            @foreach ($years as $year)
                                <option>{{ $year->year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary  btn-sm mt-2"> <i class="bx bx-search fs-5 lh-0"></i>
                            Search</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
  
        <hr class="my-3" />
        <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Yearly List</h5>
 
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                <small class="text-muted float-end">
                    @if (auth()->user()->type == 'admin')
                        <a href="{{ url('admin/dailyexpense') }}" class="btn btn-outline-primary btn-sm">Daily
                            Expense</a>
                        <a href="{{ url('admin/monthlyexpense') }}" class="btn btn-outline-primary btn-sm">Monthly
                            Expense</a>
                        <a href="{{ url('admin/yearlyexpense') }}" class="btn btn-primary btn-sm">yearly
                            Expense</a>
                    @elseif (auth()->user()->type == 'accountant')
                        <a href="{{ url('accountant/dailyexpense') }}" class="btn btn-outline-primary btn-sm">Daily
                            Expense</a>
                        <a href="{{ url('accountant/monthlyexpense') }}" class="btn btn-outline-primary btn-sm">Monthly
                            Expense</a>
                        <a href="{{ url('accountant/yearlyexpense') }}" class="btn btn-primary btn-sm">yearly
                            Expense</a>
                    @else
                        return redirect()->route('home');
                    @endif
                </small>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table " id="staff">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th>Month</th>
                            {{-- <th>year</th> --}}
                            <th>Amount (Rs)</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($expenses as $expense)
                            <tr>

                                <td>{{ ++$i }}</td>
                                <td>{{ $expense->month }}</td>
                                <td>{{ $expense->total }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td> </td>
                            <td style="font-weight: bolder"> Total Amount </td>

                            <td>{{ $totalexpense->total }}</td>



                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
@endsection
