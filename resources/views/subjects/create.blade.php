@extends('layouts.default')

@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
<div class="row">
    <div class="card mb-4">

    <div class="card-body">
        <form action="{{ url('/subjects') }}" class="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row mb-1">
                <label for="" class="col-sm-2 col-form-label">Subject</label>
                <div class="col-md-5">
                    {{-- <select class="form-select" id="country-dropdown" name="sf_nationality">
                        <option active>Select Country</option>
                        @foreach ($classdatas as $classdata)
                            <option value="{{ $classdata->c_class}}">
                                {{ $classdata->c_class}}
                            </option>
                        @endforeach
                    </select> --}}
                    <input type="text" class="form-control" name="name" placeholder="Enter Subject Name"
                    autocomplete="off" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary mb-4 btn-sm">Submit Form <i
                            class="fa-solid fa-location-arrow"></i></button>
                </div>
            </div>
        </form>
    </div>

    </div>


</div>
@endsection

