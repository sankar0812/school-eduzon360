@extends('layouts.default')
@section('title', '')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Edit Daily Time</h5>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daily Time</h5>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
                    Logins</a></small> --}}
            </div>
            <div class="card-body">
                @if (auth()->user()->type == 'admin')
                    <form action="{{ url('admin/classtimeupdate', $classtimeedit->id) }}" method="POST"
                        enctype="multipart/form-data">
                    @elseif (auth()->user()->type == 'clerk')
                        <form action="{{ url('clerk/classtimeupdate', $classtimeedit->id) }}" method="POST"
                            enctype="multipart/form-data">
                        @else
                            return redirect()->route('home');
                @endif

                @csrf

                <div class="form-group row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">section</label>
                    <div class="col-md-5">
                        <select id="" name="classsection" class="form-control " autocomplete="off" required>
                            <option hidden selected>select section</option>
                            <option value="FN" {{ $classtimeedit->classsection === 'FN' ? 'Selected' : '' }}>FN</option>
                            <option value="AN" {{ $classtimeedit->classsection === 'AN' ? 'Selected' : '' }}>AN</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Time</label>
                    <div class="col-md-5">

                        <input type="text" name="classname" id="" class="form-control" placeholder="time"
                            value="{{ $classtimeedit->classname }}" autocomplete="off">


                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary mb-4 ">Update form <i
                                class="fa-solid fa-location-arrow"></i></button>

                        @if (auth()->user()->type == 'admin')
                            <a href="{{ url('admin/time') }}" class="btn btn-dark mb-4">Back</a>
                        @elseif (auth()->user()->type == 'clerk')
                            <a href="{{ url('clerk/time') }}" class="btn btn-dark mb-4">Back</a>
                        @else
                            return redirect()->route('home');
                        @endif

                    </div>
                </div>
                </form>
            </div>
        </div>


@endsection
