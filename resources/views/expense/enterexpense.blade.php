@extends('layouts.default')
@section('title', 'Enter Expense')
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
                        <form class="row g-3" action="{{ route('expense.add') }}" method="POST" enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'accountant')
                            <form class="row g-3" action="{{ route('accountant.add') }}" method="POST"
                                enctype="multipart/form-data">
                            @else
                                return redirect()->route('home');
                    @endif

                    @csrf

                    <div class="mb-3 row">
                        <label for="input" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" name="date" id="" placeholder=""
                                autocomplete="off" required>
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="input" class="col-sm-2 col-form-label">Account Type</label>
                        <div class="col-sm-6">
                            <select id="" name="account_type" class="form-select" autocomplete="off" required>
                                <option value="" selected disabled hidden>select Account</option>
                                <option class="" value="Cash">cash</option>
                                <option class="" value="Savings">savings</option>
                                <option class="" value="Check book">check book</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="input" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="" name="name" placeholder="Name"
                                autocomplete="off" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="input" class="col-sm-2 col-form-label">Reason</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="" name="reason" placeholder="Reason"
                                autocomplete="off" required>
                        </div>
                    </div>
                    {{-- <div class="mb-3 row">
                            <label for="input" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-6">
                                <select id="" name="category" class="form-select" autocomplete="off" required>
                                    <option class="">select Account</option>
                                    <option class="" value="EMI">emi</option>

                                </select>
                            </div>
                        </div> --}}
                    <div class="mb-3 row">
                        <label for="input" class="col-sm-2 col-form-label">Amount</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="amount" id="" placeholder="Amount"
                                autocomplete="off" required>
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

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Category Add</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/add" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label"></label>
                            <input type="text" class="form-control" id="" placeholder="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
