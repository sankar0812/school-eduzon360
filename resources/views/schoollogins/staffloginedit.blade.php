@extends('layouts.default')
@section('title', 'Admin & staff LoginEdit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Edit Staff login</h5>
    
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
                    Logins</a></small> --}}
            </div>
            <div class="card-body">
                @if (auth()->user()->type == 'admin')
                    <form action="{{ route('admin.staffloginupdate', $loginedit->userid) }}" method="POST"
                        enctype="multipart/form-data">
                    @elseif (auth()->user()->type == 'clerk')
                        <form action="{{ route('clerkadmin.staffloginupdate', $loginedit->userid) }}" method="POST"
                            enctype="multipart/form-data">
                        @else
                            return redirect()->route('home');
                @endif

                @csrf
                <div class="form-group row mb-3">
                    <!--<label for="inputPassword" class="col-sm-2 col-form-label">staff Role</label>-->
                    <div class="col-md-5">
                        <input type="hidden" class="form-control" name="type" value="{{ $loginedit->type }}" readonly>
                    </div>
                </div>


                <div class="form-group row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">staff Name</label>
                    <div class="col-md-5">
                        <select id="" name="name" class="form-control " autocomplete="off" required>

                            <option value="" selected disabled hidden>Select Name</option>
                            @foreach ($staffdetails as $staffs)
                                <option value="{{ $staffs->sf_name }}"
                                    {{ $staffs->sf_name == $loginedit->name ? 'Selected' : '' }}>{{ $staffs->sf_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="inputd" class="col-sm-2 col-form-label">staff Email</label>
                    <div class="col-md-5">
                        <select id="" name="email" class="form-control " autocomplete="off" required>
                            <option value="" selected disabled hidden>Select Email</option>

                            @foreach ($staffdetails as $staffs)
                                <option value="{{ $staffs->sf_email }}"
                                    {{ $staffs->sf_email == $loginedit->email ? 'Selected' : '' }}>{{ $staffs->sf_email }}
                                    ({{ $staffs->sf_name }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">staff Password</label>
                    <div class="col-md-5">

                        <input type="text" name="password" id="" class="form-control" placeholder="passward"
                            value="{{ $loginedit->ha_name }}" autocomplete="off" required>


                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary mb-4 ">Update form <i
                                class="fa-solid fa-location-arrow"></i></button>

                        @if (auth()->user()->type == 'admin')
                            <a href="{{ url('admin/staffloginlist') }}" class="btn btn-dark mb-4">Back</a>
                        @elseif (auth()->user()->type == 'clerk')
                            <a href="{{ url('clerk/staffloginlist') }}" class="btn btn-dark mb-4">Back</a>
                        @else
                            return redirect()->route('home');
                        @endif

                    </div>
                </div>
                </form>
            </div>
        </div>
    

@endsection
