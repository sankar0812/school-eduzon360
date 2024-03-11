@extends('layouts.default')
@section('sidebar')
    @include('include.usersidebar')
@endsection
@section('contentdashboard')

@if ($schoolinfo == '')
@else
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Welcome - {{ $schoolinfo->name }} | super admin
    </h4>
@endif
{{--   
<div class="col-lg-12 mb-4 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
                <div class="card-body">
                    @if ($schoolinfo == '')
                    @else
                        <h5 class="card-title text-primary">{{ $schoolinfo->name }}</h5>
                        <p class="mb-4">
                            {{ strip_tags($schoolinfo->about) }}
                        </p>
                    @endif
                   
                </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                    <img src="../assets/img/illustrations/man.png" height="140" alt="View Badge User"
                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                </div>
            </div>
        </div>
    </div>
</div> --}}


<!--/ Total Revenue -->
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card">
            <a href="" class="d-block">
                <div class="card-body">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>Today Payment receive</h5>
                                <p class="mb-0">Total</p>
                            </div>
                            <h5 class="gradient-color2">
                                {{ $todaypayment }}
                            </h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card">
            <a href="" class="d-block">
                <div class="card-body">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>Monthly Expence</h5>
                                <p class="mb-0">Total</p>
                            </div>
                            <h5 class="gradient-color2">
                                {{ $monthlyexpencecount }}
                            </h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
   
   
</div>

<hr class="my-3" />


  
@endsection
