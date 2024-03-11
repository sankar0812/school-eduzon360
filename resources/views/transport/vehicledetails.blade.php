@extends('layouts.default')
@section('title', 'Vehicle_Details')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="card p-2">
        {{-- <h5 class="card-header">
            <a href="{{ url('/accountsadd') }}" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                data-bs-target="#exampleModal1" data-bs-whatever="@mdo"><i class="fa-solid fa-file-circle-plus fa-xl"></i></a>
        </h5> --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Vehicle_Details</h6>
            <small class="text-muted float-end"> <a href="{{ url('/accountsadd') }}" class="btn btn-info btn-sm"
                    data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="@mdo">Vehicle <i
                        class="fa-solid fa-file-circle-plus"></i>
                </a></small>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped table-hover " id="example">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Van id</th>
                        <th>vehicle Name</th>
                        <th>vehicle No</th>
                        <th>Insurance upto</th>
                        <th>FC upto</th>
                        <th>Rc STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>1</td>
                        <td>02</td>
                        <td>mahindra</td>
                        <td>TN 75 AB 7869
                        </td>
                        <td>12/5/2024</td>
                        <td>11/02/2031</td>

                        <td><span class="badge bg-label-danger me-1">Deactive</span></td>
                        <td>
                            <div class="dropdown">
                                <button class=" dropdown-toggle drop" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-sharp fa-solid fa-bars"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="{{ url('administrative_view') }}"
                                            data-bs-toggle="modal" data-bs-target="#exampleModalview"
                                            data-bs-whatever="@mdo"><i class="fa-solid fa-eye"></i> View
                                            Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ url('vehicledetailsedit') }}"><i
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

    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="" class="form-label">Registration No</label>
                            <input type="text" class="form-control" name="Regno" id=""
                                placeholder="Registration No" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Registration Date</label>
                            <input type="text" class="form-control" name="regdate" id=""
                                placeholder="Registration Date" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">chassis No</label>
                            <input type="text" class="form-control" name="chassisno" id=""
                                placeholder="chassis No" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Engine No</label>
                            <input type="text" class="form-control" name="engineno" id=""
                                placeholder="Engine No" autocomplete="off" required>
                        </div>
                        <div class="col-md-12">
                            <label for="" class="form-label">Owner Name</label>
                            <input type="text" class="form-control" name="ownername" id=""
                                placeholder="Owner Name" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">vechicle Class</label>
                            <input type="text" class="form-control" name="vechicleclass" id=""
                                placeholder="vechicle Class" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">chassis No</label>
                            <input type="text" class="form-control" name="chassisno" id=""
                                placeholder="chassis No" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Engine No</label>
                            <input type="text" class="form-control" name="engineno" id=""
                                placeholder="Engine No" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Fuel</label>
                            <input type="text" class="form-control" name="fuel" id="" placeholder="Fuel"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-12">
                            <label for="" class="form-label">Maker/Model</label>
                            <input type="text" class="form-control" name="maker_model" id=""
                                placeholder="Maker/Model" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Fitness/REGN upto</label>
                            <input type="text" class="form-control" name="fitness" id=""
                                placeholder="Fitness/REGN upto" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">FC upto</label>
                            <input type="text" class="form-control" name="fc" id=""
                                placeholder="FC upto" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Mv TaX upto</label>
                            <input type="text" class="form-control" name="mvtax" id=""
                                placeholder="Mv TaX upto" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Insurance Upto</label>
                            <input type="text" class="form-control" name="insurance" id=""
                                placeholder="Insurance Upto" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">PUCC upto</label>
                            <input type="text" class="form-control" name="pucc" id=""
                                placeholder="PUCC upto" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Emission Norms</label>
                            <input type="text" class="form-control" name="insurance" id=""
                                placeholder="Insurance Upto" autocomplete="off" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    {{-- model view --}}

    <div class="modal fade" id="exampleModalview" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                            {{-- <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Close</button> --}}
                            {{-- <button type="submit" class="btn btn-outline-primary">save</button> --}}
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
