{{-- @extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    You are a Manager User.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.default')
@section('title', 'ClassTeacher Dashboard')
@section('sidebar')
    @include('include.classteachersidebar')
@endsection
@section('contentdashboard')
    <div class="col-md-12">
        {{-- <h6 class="text-muted">Full Details</h6> --}}
        <div class="nav-align-top mb-4">
            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home"
                        aria-selected="true">
                        <i class="tf-icons bx bx-photo-album"></i> Profile
                        {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">3</span> --}}
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile"
                        aria-selected="false">
                        <i class="tf-icons bx bx-user"></i> Personal Details
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages"
                        aria-selected="false">
                        <i class="tf-icons bx bx-message-square"></i> Notification
                        <span
                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ $enewcount + $enoticescount }}</span>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                    <div class="mb-3" style="">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset($staff->sf_image_path) }}" class="img-fluid rounded-start"
                                    alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-2 ">NAME</label>
                                        <div class="col-sm-10">
                                            <h6 class="" id="staticEmail">
                                                @if ($staff)
                                                    {{ $staff->sf_name }}
                                                @else
                                                    Staff not found
                                                @endif
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-2 ">SUBJECT</label>
                                        <div class="col-sm-10">
                                            <h6 class="" id="staticEmail">{{ $staff->sf_subject_taken }}</h6>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-2 ">QUALIFICATION</label>
                                        <div class="col-sm-10">
                                            <h6 class="" id="staticEmail">{{ $staff->sf_qualification }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 ">DATE OF BIRTH</label>
                        <div class="col-sm-10">
                            <h6 class="" id="staticEmail">{{ $staff->sf_dob }}</h6>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 ">GENDER</label>
                        <div class="col-sm-10">
                            <h6 class="" id="staticEmail">{{ $staff->sf_gender }}</h6>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 ">BLOOD GROUP</label>
                        <div class="col-sm-10">
                            <h6 class="" id="staticEmail">{{ $staff->sf_bloodgroup }}</h6>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 ">FATHER / SPOUSE NAME</label>
                        <div class="col-sm-10">
                            <h6 class="" id="staticEmail">{{ $staff->sf_fathername }}</h6>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 ">EMAIL</label>
                        <div class="col-sm-10">
                            <h6 class="" id="staticEmail">{{ $staff->sf_email }}</h6>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 ">QUALIFICATION</label>
                        <div class="col-sm-10">
                            <h6 class="" id="staticEmail">{{ $staff->sf_qualification }}</h6>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 ">EXPERIENCE</label>
                        <div class="col-sm-10">
                            <h6 class="" id="staticEmail">{{ $staff->sf_experience }}</h6>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 ">SUBJECT TAUGHT</label>
                        <div class="col-sm-10">
                            <h6 class="" id="staticEmail">{{ $staff->sf_subject_taken }}</h6>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 ">JOIN DATE</label>
                        <div class="col-sm-10">
                            <h6 class="" id="staticEmail">{{ $staff->sf_joindate }}</h6>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                    <div class="col-md-6 ui-bg-overlay-container p-4">
                        <div class="ui-bg-overlay  opacity-75 rounded-end-bottom"></div>
                        {{-- <div class="text-white small fw-semibold mb-3">Translucent</div> --}}

                        <div class="toast-container">
                            @foreach ($enewview as $enewviews)
                                <div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive"
                                    aria-atomic="true">
                                    <div class="toast-header">
                                        <i class="bx bx-bell me-2"></i>
                                        <div class="me-auto fw-semibold">E-NEWS</div>
                                        <small>{{ $enewviews->date }} - {{ $enewviews->time }}</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        <span class="text-dark fw-bold">{{ $enewviews->title }}</span><br>

                                        {{ $enewviews->content }}
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($enoticesview as $enoticesviews)
                                <div class="bs-toast toast fade show bg-info" role="alert" aria-live="assertive"
                                    aria-atomic="true">
                                    <div class="toast-header">
                                        <i class="bx bx-bell me-2"></i>
                                        <div class="me-auto fw-semibold">NOTICES</div>
                                        <small>{{ $enoticesviews->date }} - {{ $enoticesviews->time }}</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        <span class="text-dark fw-bold">{{ $enoticesviews->title }}</span><br>
                                        {{ $enoticesviews->content }}
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($yesenewview as $enewviews)
                                <div class="bs-toast toast fade show bg-danger" role="alert" aria-live="assertive"
                                    aria-atomic="true">
                                    <div class="toast-header">
                                        <i class="bx bx-bell me-2"></i>
                                        <div class="me-auto fw-semibold">E-NEWS</div>
                                        <small>{{ $enewviews->date }} - {{ $enewviews->time }}</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        <span class="text-dark fw-bold">{{ $enewviews->title }}</span><br>

                                        {{ $enewviews->content }}
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($yesenoticesview as $enoticesviews)
                                <div class="bs-toast toast fade show bg-danger" role="alert" aria-live="assertive"
                                    aria-atomic="true">
                                    <div class="toast-header">
                                        <i class="bx bx-bell me-2"></i>
                                        <div class="me-auto fw-semibold">NOTICES</div>
                                        <small>{{ $enoticesviews->date }} - {{ $enoticesviews->time }}</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        <span class="text-dark fw-bold">{{ $enoticesviews->title }}</span><br>
                                        {{ $enoticesviews->content }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
