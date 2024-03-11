@extends('layouts.default')
@section('title', 'Staff Attendance Edit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Edit Staff Attendance</h5>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"></h5>
                    <small class="text-muted float-end"></small>
                </div>
                <div class="card-body">

                    @if (auth()->user()->type == 'admin')
                        <form class="row g-3" action="{{ route('admin.attendaneupdate', $staffedit->staffattid) }}"
                            method="post" enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'clerk')
                            <form class="row g-3" action="{{ route('clerkadmin.attendaneupdate', $staffedit->staffattid) }}"
                                method="post" enctype="multipart/form-data">
                            @else
                                return redirect()->route('home');
                    @endif

                    @csrf
                    <div class="col-md-7">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" id="" placeholder="Name" autocomplete="off"
                            required value="{{ $staffedit->sf_name }}" readonly>
                    </div>
                    <div class="col-md-7">
                        <label for="" class="form-label">Date</label>
                        <input type="date" class="form-control" value="{{ $staffedit->att_date }}" id=""
                            placeholder="Date" autocomplete="off" required readonly>
                    </div>
                    <div class="col-md-7">
                        <label for="" class="form-label">Attendance</label>
                        <select class="form-control" name="attendance">

                            @foreach ($att as $atts)
                                <option value="{{ $atts->tt_id }}"
                                    {{ $atts->tt_id == $staffedit->tt_id ? 'Selected' : '' }}>{{ $atts->tt_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-7">
                        <label for="" class="form-label">Permission</label>
                        <input type="text" class="form-control" name="permission" id="" placeholder="Permission"
                            autocomplete="off" value="{{ $staffedit->permission }}">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary ">Update</button>

                        @if (auth()->user()->type == 'admin')
                            <a href="{{ url('admin/staffattendance') }}" class="btn btn-dark">Back</a>
                        @elseif (auth()->user()->type == 'clerk')
                            <a href="{{ url('clerk/staffattendance') }}" class="btn btn-dark">Back</a>
                        @else
                            return redirect()->route('home');
                        @endif

                    </div>

                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection
