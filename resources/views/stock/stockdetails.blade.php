@extends('layouts.default')
@section('title', 'Stock Details')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="card p-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">School_Appointment</h6>
            <small class="text-muted float-end"> <a href="{{ url('/stockdetails') }}" class="btn btn-info btn-sm">Purchase
                    Details</a>
                <a href="{{ url('/returndetails') }}" class="btn btn-outline-info btn-sm">Return Details</a></small>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table  table-striped table-hover  border-dark" id="example">
                <thead class="table-dark">
                    <tr>
                        <th>Sl.No</th>
                        <th>Stock NAME</th>
                        <th>category</th>
                        <th>company </th>
                        <th>total qty</th>
                        <th>New qty</th>
                        <th>out qty</th>
                        <th>description</th>
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
                        <td>25</td>
                        <td>15</td>
                        <td>class chair</td>
                        <td><span class="badge bg-label-danger me-1">Deactive</span></td>
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

@endsection
