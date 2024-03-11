@extends('layouts.default')
@section('title', 'Admin LoginEdit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Edit Admin login</h5>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
                    Logins</a></small> --}}
            </div>
            <div class="card-body">
                <form action="{{ route('admin.staffloginupdate', $loginedit->userid) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">staff Role</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="type" value="{{ $loginedit->type }}"
                                readonly>
                        </div>
                    </div>


                    <div class="form-group row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">staff Name</label>
                        <div class="col-md-5">
                            <input type="text" name="name" id="" autocomplete="off"
                                value="{{ $loginedit->name }}" class="form-control ">
                            {{-- <select id="" name="name" class="form-control " autocomplete="off" required>
                                <option value="{{ $loginedit->name }}">{{ $loginedit->name }}</option>
                                <option></option>
                                @foreach ($staffdetails as $staffs)
                                    <option value="{{ $staffs->sf_name }}">{{ $staffs->sf_name }}</option>
                                @endforeach
                            </select> --}}
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="inputd" class="col-sm-2 col-form-label">staff Email</label>
                        <div class="col-md-5">
                            <input type="email" name="email" id="" autocomplete="off"
                                value="{{ $loginedit->email }}" class="form-control ">
                            {{-- <select id="" name="email" class="form-control" autocomplete="off" required>
                                <option value="{{ $loginedit->email }}">{{ $loginedit->email }}</option>
                                <option></option>
                                @foreach ($staffdetails as $staffs)
                                    <option value="{{ $staffs->sf_email }}">{{ $staffs->sf_email }} --
                                        {{ $staffs->sf_name }}
                                    </option>
                                @endforeach
                            </select> --}}
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">staff Password</label>
                        <div class="col-md-5">
                            <input type="text" name="password" id="" class="form-control" placeholder="passward"
                                value="{{ $loginedit->ha_name }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary mb-4 ">Update form <i
                                    class="fa-solid fa-location-arrow"></i></button>
                            <a href="{{ url('admin/adminloginlist') }}" class="btn btn-dark mb-4">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    

@endsection
