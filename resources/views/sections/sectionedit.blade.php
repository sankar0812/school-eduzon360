@extends('layouts.default')
@section('title', 'Class_section Edit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <h4 class="fw-bold py-3 mb-1"><span class="text-muted fw-light"></span>Class_section Edit</h4>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0"></h6>
            <!-- {{ $classdata->id }} -->
            {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
                Logins</a></small> --}}
        </div>
        <div class="card-body">
            @if (auth()->user()->type == 'admin')
                <form action="{{ route('admin.classupdate', $classdata->id) }}" method="POST" enctype="multipart/form-data">
                @elseif (auth()->user()->type == 'clerk')
                    <form action="{{ route('clerkadmin.classupdate', $classdata->id) }}" method="POST"
                        enctype="multipart/form-data">
                    @else
                        return redirect()->route('home');
            @endif


            @csrf
            <div class="form-group row mb-3">
                <label for="" class="col-sm-2 col-form-label">Class/Section</label>
                <div class="col-md-5">
                    <input type="hidden" name="class_id" value="{{ $classdata->id }}">
                    <input type="text" name="class" id="" class="form-control" placeholder="Class & Section"
                        value="{{ $classdata->c_class }}" autocomplete="off" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary mb-4 ">update Form <i
                            class="fa-solid fa-location-arrow"></i></button>

                    @if (auth()->user()->type == 'admin')
                        <a href="{{ url('admin/sections') }}" class="btn btn-dark mb-4">Back</a>
                    @elseif (auth()->user()->type == 'clerk')
                        <a href="{{ url('clerk/sections') }}" class="btn btn-dark mb-4">Back</a>
                    @else
                        return redirect()->route('home');
                    @endif

                </div>
            </div>
            </form>
        </div>
    </div>

@endsection
