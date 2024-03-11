@extends('layouts.studentapp')
@section('title', 'Staff Details')
@section('studentsidebar')
@include('include.studentsiderbar')
@endsection
@section('studentdashboard')
<div class="row">
@foreach($assignstaff as $staff )
<div class="col-md-4">
<div class="card">
    <div class="card-body">
        <div class="row">
        <div class="col-md-8">
            <h4>Name : {{$staff->sf_name}}</h4>
<h5>Subject : {{$staff->sf_subject_taken}}</h5>
<h6>Phone : {{$staff->sf_phone}}</h6>
</div>

<div class="col-md-4">
   <img src="{{ asset($staff->sf_image_path) }}" alt="profile" height="100px" width="100px">
</div>
</div>
    </div>
</div>
</div>
@endforeach
</div>
@endsection