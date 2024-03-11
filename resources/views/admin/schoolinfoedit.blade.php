@extends('layouts.default')
@section('title', 'School Info')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Edit School info</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('admin.schollinfoupdate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">


                        <div class="mb-3">
                            <label for="" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="" value="{{ $schoolinfoedit->name }}"
                                name="name" autocomplete="off">
                            <input type="hidden" class="form-control" id="" value="{{ $schoolinfoedit->id }}"
                                name="id" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label">Address:</label>
                            <input type="text" class="form-control" id="" name="address"
                                value="{{ $schoolinfoedit->address }}" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label">Reg.No:</label>
                            <input type="text" class="form-control" id="" value="{{ $schoolinfoedit->regno }}"
                                name="regno" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label">About:</label>
                            {{-- <input type="text" class="form-control" id="" name="designation"
                autocomplete="off"> --}}
                            <textarea name="about" class="form-control" id="editor" placeholder="Describe yourself here...">    {{ strip_tags($schoolinfoedit->about) }}</textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Profile Image</label>
                            <input type="hidden" name="logoold" value="{{ $schoolinfoedit->logo }}">
                            <input type="hidden" name="logo_pathold" value="{{ $schoolinfoedit->logo_path }}">
                            <input type="file" name="logo" accept="image/png, image/jpeg ,image/jpg" value=""
                                class="form-control" id="" autocomplete="off">
                            <img src="{{ asset($schoolinfoedit->logo_path) }}" width="150px" height="100px" class="square">
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">save</button>
                        <a href="{{ url('admin/administrativedetails') }}" class="btn btn-dark">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
