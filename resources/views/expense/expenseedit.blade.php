@extends('layouts.default')
@section('title', 'Expense Edit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{-- <h5 class="mb-0">
                        <a href="{{ url('dailyexpense') }}" class="btn info btn-sm">Daily Expense</a>
                        <a href="{{ url('monthlyexpense') }}" class="btn info btn-sm">Monthly Expense</a>
                        <a href="{{ url('yearlyexpense') }}" class="btn info btn-sm">Yearly Expense</a>
                    </h5> --}}

                </div>
                <div class="card-body">
                    @if (auth()->user()->type == 'admin')
                    <form class="row g-3" action="{{ route('expense.update') }}" method="POST" enctype="multipart/form-data">
                    @elseif (auth()->user()->type == 'accountant')
                    <form class="row g-3" action="{{ route('accountant.update') }}" method="POST" enctype="multipart/form-data">
                        @else
                            return redirect()->route('home');
                @endif

                        @csrf

                        <div class="mb-3 row">
                            <label for="input" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" name="date" id="" placeholder="" value="{{$expense->date}}"
                                    autocomplete="off" readonly>
                                    <input type="hidden" class="form-control" name="id" id="" placeholder="" value="{{$expense->id}}"
                                    >
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="input" class="col-sm-2 col-form-label">Account Type</label>
                            <div class="col-sm-6">
                                <select id="" name="account_type" class="form-select" autocomplete="off" required>
                                    <option class="text-center">select Account</option>

                                    <option value="Cash" {{ $expense->account_type === 'Cash' ? 'Selected' : '' }}>Cash</option>
                                    <option value="Savings" {{ $expense->account_type === 'Savings' ? 'Selected' : '' }}>Savings</option>
                                    <option value="Check book" {{ $expense->account_type === 'Check book' ? 'Selected' : '' }}>Check book</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="input" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="" name="name" placeholder="Name" value="{{$expense->name}}"
                                    autocomplete="off" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="input" class="col-sm-2 col-form-label">Reason</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="" name="reason"  value="{{$expense->reason}}"
                                    placeholder="Reason" autocomplete="off" required>
                            </div>
                        </div>
                  
                        <div class="mb-3 row">
                            <label for="input" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="amount" id="" value="{{$expense->amount}}"
                                    placeholder="Amount" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="input" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary">Submit Form</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
