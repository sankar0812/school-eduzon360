@extends('layouts.default')
@section('title', 'Admin list')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Admin login List</h5>
    <div class="row">
        <div class="col-xl-12 p-2">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true"
                            style="font-weight:bold;">
                            LOGIN DETAILS
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false"
                            style="font-weight:bold;">
                            LOGIN ADD
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table" id="example">
                                    <thead class="">
                                        <tr>
                                            <th>#</th>
                                            <th>name</th>
                                            <th>Email</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    @for ($i = 0; $i < 1; $i++)
                                    @endfor
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($userstaff as $userstaffs)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $userstaffs->name }}</td>
                                                <td>{{ $userstaffs->email }}</td>
                                                <td>
                                                    @if ($userstaffs->status == 1)
                                                        <a href="{{ route('login.status', $userstaffs->id) }}"><span
                                                                class="badge bg-label-success me-1">active</span></a>
                                                    @else
                                                        <a href="{{ route('login.status', $userstaffs->id) }}"><span
                                                                class="badge bg-label-danger me-1">Deactive</span></a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ url('admin/adminloginedit', $userstaffs->id) }}"><i
                                                                        class="fa-solid fa-pen"></i> Edit</a></li>
                                                            <!-- <li><a class="dropdown-item"
                                                                    href="{{ route('admin.stafflogindelete', $userstaffs->id) }}"><i
                                                                        class="fa-solid fa-trash "></i>
                                                                    Delete</a></li> -->
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                        <div class="card-body row g-3">
                            <form action="{{ route('admin.register') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">staff Role</label>
                                    <div class="col-md-5">
                                        @php
                                            $role = DB::table('roles')
                                                ->where('id', '!=', 2)
                                                ->select('id', 'r_name')
                                                ->get();
                                        @endphp
                                        <select id="" name="type" class="form-control " autocomplete="off"
                                            required>
                                            <option value="" selected disabled hidden>select role</option>
                                            @foreach ($role as $roles)
                                                <option value="{{ $roles->id }}">{{ $roles->r_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="input" class="col-sm-2 col-form-label">staff Name</label>
                                    <div class="col-md-5">
                                        <input type="text" name="name" id="" class="form-control"
                                            placeholder="Name" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="input" class="col-sm-2 col-form-label">staff Email</label>
                                    <div class="col-md-5">
                                        <input type="text" name="email" id="" class="form-control"
                                            placeholder="Email" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="input" class="col-sm-2 col-form-label">staff Password</label>
                                    <div class="col-md-5">
                                        <input type="password" name="password" id="" class="form-control"
                                            placeholder="passward" autocomplete="off">
                                        <span class="text-danger">minimum 8 characters Password</span>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-primary mb-4 ">submit form <i
                                                class="fa-solid fa-location-arrow"></i></button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
