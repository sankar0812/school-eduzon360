@extends('layouts.default')
@section('title', 'Offline Daily Exam')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{-- <h5 class="mb-0">Bank Details</h5>
                    <small class="text-muted float-end">Edit</small> --}}
                </div>
                <div class="card-body">
                    <a href="{{ url('offlineexam') }}" class="btn btn-outline-primary">Add Exam</a>
                    {{-- <a href="{{ url('offlinedailyexam') }}" class="btn btn-primary">Daily Exam</a> --}}
                    <a href="{{ url('offlinequarterlyexam') }}" class="btn btn-outline-primary">Quarterly Exam</a>
                    <a href="{{ url('offlinehalflyexam') }}" class="btn btn-outline-primary">Halfly Exam</a>
                    <a href="{{ url('offlineannualexam') }}" class="btn btn-outline-primary">Annual Exam</a>
                </div>
            </div>
        </div>

    </div>


@endsection
