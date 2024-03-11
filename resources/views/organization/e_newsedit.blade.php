@extends('layouts.default')
@section('title', 'E-News Edit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">E-News Edit</h5>
                    <small class="text-muted float-end">E-News Details</small>
                </div>
                <div class="card-body">
                    <form class="row g-3 p-5">
                        <div class="col-md-12">
                            <label for="" class="form-label">E-News Title</label>
                            <input type="text" class="form-control" name="title" id="" placeholder="Title"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-12">
                            <label for="" class="form-label">E-News Content</label>
                            <input type="text" class="form-control" name="content" id="" placeholder="Content"
                                autocomplete="off" required>
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">E-News Date</label>
                            <input type="date" class="form-control" id="" name="date" placeholder="Date"
                                autocomplete="off" required>
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">E-News Time</label>
                            <input type="time" class="form-control" id="" name="time" placeholder="time"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-12">
                            <label for="" class="form-label">E-News Image</label>
                            <input type="file" class="form-control" name="image" id="" placeholder="image"
                                autocomplete="off" required>
                        </div>


                        <div class="col-12">

                            <button type="submit" class="btn btn-primary">Submit Form</button>
                            <a href="{{ url('schoole_news') }}" class="btn btn-dark">Back</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection
