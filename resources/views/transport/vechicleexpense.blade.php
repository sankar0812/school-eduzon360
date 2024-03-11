@extends('layouts.default')
@section('title', 'Vechicle Expense')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="card p-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Vechicle Expense</h6>
            <small class="text-muted float-end"> <a href="{{ url('/accountsadd') }}" class="btn btn-info btn-sm"
                    data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="@mdo">Expense <i
                        class="fa-solid fa-file-circle-plus"></i>
                </a></small>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped table-hover border-dark" id="staff">
                <thead class="table-dark">
                    <tr>
                        <th>Sl.No</th>
                        <th>Van No</th>
                        <th>vehicle No</th>
                        <th>purpose</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>bill</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>1</td>
                        <td>01</td>
                        <td>TN75A5678</td>
                        <td>fuel</td>
                        <th>12/2/2023</th>
                        <td>5liter</td>
                        <td>1000</td>
                        <td><img src="demo.webp" width="200px"></td>
                        <td>
                            <div class="dropdown">
                                <button class=" dropdown-toggle drop" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-sharp fa-solid fa-bars"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    {{-- <a href="{{ url('/accountsadd') }}" class="btn btn-outline-primary btn-sm"
                                data-bs-toggle="modal" data-bs-target="#exampleModalview" data-bs-whatever="@mdo"><i
                                    class="fa-solid fa-eye fa-lg"></i></a> --}}
                                    <li><a class="dropdown-item" href="{{ url('vehicleexpenseedit') }}"><i
                                                class="fa-solid fa-pen"></i> Edit</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-trash "></i>
                                            Delete</a></li>
                                </ul>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- model --}}

    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                            accept=".pdf"    autocomplete="off" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    {{-- model view --}}

    {{-- <div class="modal fade" id="exampleModalview" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true"  data-bs-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="col-md-3">
                            <label for="" class="form-label">Registration No</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Registration Date</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">chassis No</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Engine No</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Owner Name</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">vechicle Class</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">chassis No</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Engine No</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Fuel</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Maker/Model</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Fitness/REGN upto</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">FC upto</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Mv TaX upto</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Insurance Upto</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">PUCC upto</label>
                            <h5>vechicle</h5>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Emission Norms</label>
                            <h5>vechicle</h5>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Close</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div> --}}
@endsection
