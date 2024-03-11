@extends('layouts.default')
@section('title', 'Vechicle Expense Edit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Vechicle Expense Edit</h5>
                    <small class="text-muted float-end"></small>
                </div>
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="" class="form-label">Van No</label>
                            <input type="text" class="form-control" name="vanno" id="" placeholder="Van No"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Vehicle No</label>
                            <input type="text" class="form-control" name="vehicleno" id=""
                                placeholder="Vehicle NO" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">purpose</label>
                            <input type="text" class="form-control" name="purpose" id="" placeholder="purpose"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Quantity</label>
                            <input type="text" class="form-control" name="quantity" id="" placeholder="Quantity"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Amount</label>
                            <input type="text" class="form-control" name="amount" id="" placeholder="Amount"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Upload Bill</label>
                            <input type="file" class="form-control" name="bill" id="" placeholder="Bill"
                            accept=".pdf"   autocomplete="off" required>
                        </div>

                        <div class="col-12">

                            <button type="submit" class="btn btn-primary">update Form</button>
                            <a href="{{ url('vechicleexpense') }}" class="btn btn-dark">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection
