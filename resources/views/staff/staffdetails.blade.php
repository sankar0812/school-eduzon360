@extends('layouts.default')
@section('title', 'Manage Staff Details')
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
                <form class="">
                    <div class="form-group row mb-1">
                        <label for="inputPassword" class="col-sm-2 col-form-label">staff Postion</label>
                        <div class="col-md-5">
                            <select id="" name="staffpostion" class="form-control form-control-sm" autocomplete="off" required>
                                <option>select postion</option>
                                <option value="teachingstaff">Teaching Staff</option>
                                <option value="non-teachingstaff">NON-Teaching staff</option>
                                <option value="cleaning">Cleaning</option>
                                <option value="driver">Driver</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary mb-4 btn-sm">Confirm <i
                                    class="fa-solid fa-location-arrow"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row py-2">
        <div class="card p-2">
            <h6 class="card-header">teaching staff
                {{-- <a href="{{ url('/addstaff') }}" class="btn btn-outline-primary btn-sm"><i
                    class="fa-solid fa-file-circle-plus fa-xl"></i></a> --}}
            </h6>
            <div class="table-responsive text-nowrap ">
                <table class="table  table-striped table-hover  border-dark" id="example">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Staff Id</th>
                            <th>NAME</th>
                            <th>IMAGE</th>
                            <th>STAFF POSITION</th>
                            <th>Subject Taught</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>Sam</td>


                            <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-xs pull-up" title="ideaux">
                                        <img src="assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                                    </li>

                                </ul>
                            </td>
                            <td>teaching staff</td>
                            <td>English</td>
                            <td><span class="badge bg-label-primary me-1">Working</span></td>
                            <td>
                                <div class="dropdown">
                                    <button class=" dropdown-toggle drop" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa-sharp fa-solid fa-bars"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="{{ url('staffview') }}"><i
                                                    class="fa-solid fa-eye"></i> View
                                                Profile</a></li>
                                        <li><a class="dropdown-item" href="{{ url('staffedit') }}"><i
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
    </div>

 @endsection
