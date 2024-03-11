@extends('layouts.default')
@section('title', 'Admin & staff LoginEdit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.adminitrativeedit', $profileedit->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="input" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-md-5">
                            <input type="hidden" value="{{ $profileedit->Pr_image }}" name="oldimage" id=""
                            class="form-control" placeholder="" autocomplete="off">
                            <input type="file" value="{{ $profileedit->Pr_image }}" name="image" id=""
                                class="form-control" placeholder="" autocomplete="off">
                            <img src="{{ asset('myimage/administrative/' . $profileedit->Pr_image) }}" class=""
                                alt="" width="50px" height="50px">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="input" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-md-5">
                            <input type="text" value="{{ $profileedit->Pr_name }}" name="name" id=""
                                class="form-control" placeholder="Name" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="input" class="col-sm-2 col-form-label">Designation</label>
                        <div class="col-md-5">
                            <input type="text" value="{{ $profileedit->Pr_designation }}" name="designation"
                                id="" class="form-control" placeholder="Designation" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary mb-4 ">Update form <i
                                    class="fa-solid fa-location-arrow"></i></button>
                            <a href="{{ url('admin/administrativedetails') }}" class="btn btn-dark mb-4">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
