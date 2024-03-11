@extends('layouts.default')
@section('title', 'Stock Purchase')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Stock Purchase</h5>
                    <small class="text-muted float-end"><a href="{{ url('stockpurchase') }}" class="btn btn-info btn-sm">Purchase</a> <a href="{{ url('stockreturn') }}" class="btn btn-outline-info btn-sm">Return</a></small>
                </div>
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="" class="form-label">Stock Name</label>
                            <input type="text" class="form-control" name="stockname" id="" placeholder="Stock Name"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Category</label>
                               <select class="form-control" name="category" >
                                <option>book</option>
                                <option>pen</option>
                                <option>paper</option>
                               </select>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="" name="" placeholder="Company Name"
                                autocomplete="off" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Description</label>
                            <input type="text" class="form-control" id="" name="description"
                                placeholder="Description" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="phone" id="" placeholder="Quantity"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Total Amount</label>
                            <input type="number" class="form-control" name="amount" id="" placeholder="Total Amount"
                                autocomplete="off" required>
                        </div>


                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection
