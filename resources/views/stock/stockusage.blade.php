@extends('layouts.default')
@section('title', 'Stock Usage')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="card p-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Stock Usage</h6>
            <small class="text-muted float-end"><a href="{{ url('/accountsadd') }}" class="btn btn-info btn-sm"
                    data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="@mdo">Stock out</a></small>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table  table-striped table-hover border-dark" id="example">
                <thead class="table-dark">
                    <tr>
                        <th>Sl.No</th>
                        <th>Stock NAME</th>
                        <th>category</th>
                        <th>company </th>
                        <th>out qty</th>
                        <th>purpose</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>1</td>
                        <td>chair</td>
                        <td>furniture</td>
                        <td>plywood</td>
                        <td>50</td>
                        <td>class chair</td>
                        <td><span class="badge bg-label-success me-1">active</span></td>
                        <td>
                            <div class="dropdown">
                                <button class=" dropdown-toggle drop" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-sharp fa-solid fa-bars"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    {{-- <li><a class="dropdown-item" href="{{ url('administrative_view') }}"><i
                                                class="fa-solid fa-eye"></i> View
                                            Profile</a></li> --}}
                                    <li><a class="dropdown-item" href=""><i class="fa-solid fa-pen"></i> Edit</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-trash "></i>
                                            Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>chair</td>
                        <td>furniture</td>
                        <td>plywood</td>
                        <td>50</td>
                        <td>class chair</td>
                        <td><span class="badge bg-label-success me-1">active</span></td>
                        <td>
                            <div class="dropdown">
                                <button class=" dropdown-toggle drop" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-sharp fa-solid fa-bars"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    {{-- <li><a class="dropdown-item" href="{{ url('administrative_view') }}"><i
                                                class="fa-solid fa-eye"></i> View
                                            Profile</a></li> --}}
                                    <li><a class="dropdown-item" href=""><i class="fa-solid fa-pen"></i> Edit</a>
                                    </li>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="" class="form-label">stock name</label>
                            <select class="form-control">
                                <option></option>
                                <option></option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">category</label>
                            <select class="form-control">
                                <option></option>
                                <option></option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">company</label>
                            <select class="form-control">
                                <option></option>
                                <option></option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Quantity</label>
                            <input type="text" class="form-control" name="time" id="" placeholder="quantity"
                                autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">purpose</label>
                            <input type="text" class="form-control" name="image" id="" placeholder="purpose"
                                autocomplete="off" required>
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
@endsection
