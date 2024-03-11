@extends('layouts.default')
@section('title', 'Visitor_Edit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Visitor_Edit</h6>
                    <small class="text-muted float-end"></small>
                </div>
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="" class="form-label">Visitor Name</label>
                            <input type="text" class="form-control" name="visitorname" id=""
                                placeholder="Visitor Name" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id="" placeholder="Date"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Intime</label>
                            <input type="time" class="form-control" name="intime" id="" placeholder="Intime"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">OutTime</label>
                            <input type="time" class="form-control" name="outtime" id="" placeholder="OutTime"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Phone</label>
                            <input type="number" class="form-control" name="phone" id="" placeholder="Phone"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Whom Meet</label>
                            <input type="text" class="form-control" name="" id="" placeholder="Whom Meet"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Subject/Clsss</label>
                            <input type="number" class="form-control" name="phone" id=""
                                placeholder="Subject/Clsss" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Purpose</label>
                            <input type="text" class="form-control" name="purpose" id="" placeholder="Purpose"
                                autocomplete="off" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary ">Update Form <i
                                    class="fa-solid fa-location-arrow"></i></button>
                                    
                            <a href="{{ url('visitor') }}" class="btn btn-dark">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection
