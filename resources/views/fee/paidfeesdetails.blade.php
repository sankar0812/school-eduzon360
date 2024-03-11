@extends('layouts.default')
@section('title', 'Student Details')
@section('sidebar')
@include('include.sidebar')
@endsection
@section('contentdashboard')


    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0"></h6>
            {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show Logins</a></small> --}}
        </div>
        <div class="card-body">
            @if (auth()->user()->type == 'admin')
            <form method="post" action="{{ route('adminfees.studentfilter') }}">

                @elseif (auth()->user()->type == 'accountant')
                <form method="post" action="{{ route('accountantfees.studentfilter') }}">
                    @else
                    return redirect()->route('home');
                    @endif

                    @csrf
                    <div class="form-group row mb-1">
                        <label for="input" class="col-sm-2 col-form-label">Select Class</label>
                        <div class="col-md-5">
                            <select class="form-control" name="class" required>
                                <option value="" selected disabled hidden>Select Class</option>
                                @foreach ($class as $section)
                                <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3 py-2">
                            <button type="submit" class="btn btn-primary  btn-sm"> <i class="bx bx-search fs-5 lh-0"></i> Search</button>
                        </div>
                    </div>
                </form>
          
        </div>
    </div>



@endsection