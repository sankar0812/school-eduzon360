@extends('layouts.default')
@section('title', 'Daily Expense')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-primary btn-sm">Show
        Logins</a></small> --}}
            </div>
            <div class="card-body mt-4">
                @if (auth()->user()->type == 'admin')
                    <form class="row g-3" action="{{ route('expense.previous') }}" method="POST" enctype="multipart/form-data">
                    @elseif (auth()->user()->type == 'accountant')
                        <form class="row g-3" action="{{ route('accountant.previous') }}" method="POST"
                            enctype="multipart/form-data">
                        @else
                            return redirect()->route('home');
                @endif


                @csrf
                <div class="form-group row mb-1">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Select Date</label>
                    <div class="col-md-5">
                        <input type="date" class="form-control " name="date" id=""
                            placeholder="" autocomplete="off" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary  btn-sm mt-2"> <i class="bx bx-search fs-5 lh-0"></i> Search</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
 

    <hr class="my-3" />
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Daily List</h5>
    
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                <small class="text-muted float-end">
                    @if (auth()->user()->type == 'admin')
                        <a href="{{ url('admin/dailyexpense') }}" class="btn btn-primary btn-sm">Daily
                            Expense</a>
                        <a href="{{ url('admin/monthlyexpense') }}" class="btn btn-outline-primary btn-sm">Monthly Expense</a>
                        <a href="{{ url('admin/yearlyexpense') }}" class="btn btn-outline-primary btn-sm">yearly
                            Expense</a>
                    @elseif (auth()->user()->type == 'accountant')
                        <a href="{{ url('accountant/dailyexpense') }}" class="btn btn-primary btn-sm">Daily
                            Expense</a>
                        <a href="{{ url('accountant/monthlyexpense') }}" class="btn btn-outline-primary btn-sm">Monthly
                            Expense</a>
                        <a href="{{ url('accountant/yearlyexpense') }}" class="btn btn-outline-primary btn-sm">yearly
                            Expense</a>
                    @else
                        return redirect()->route('home');
                    @endif
                </small>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table " id="">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            {{-- <th>month</th> --}}
                            <th>user name</th>
                            <th>account</th>
                            <th>reason</th>
                            <th>Amount (Rs)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $expense->date }}</td>
                                {{-- <td>5/2023</td> --}}
                                <td>{{ $expense->name }}</td>
                                <td>{{ $expense->account_type }}</td>
                                <td>{{ $expense->reason }}</td>

                                <td>{{ $expense->amount }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                          <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                @if (auth()->user()->type == 'admin')
                                                    <a class="dropdown-item"
                                                        href="{{ route('expense.edit', $expense->id) }}"><i
                                                            class="fa-solid fa-pen"></i> Edit</a>
                                                @elseif (auth()->user()->type == 'accountant')
                                                    <a class="dropdown-item"
                                                        href="{{ route('accountant.edit', $expense->id) }}"><i
                                                            class="fa-solid fa-pen"></i> Edit</a>
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        
                            <td style="font-weight: bolder">Total Amount</td>
                            <td>{{ $totalexpense->total }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
  
@endsection
