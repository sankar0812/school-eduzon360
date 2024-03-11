@extends('layouts.default')
@section('title', 'School Info')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="col-md-12">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home"
                        aria-selected="true">
                        <i class="tf-icons bx bx-photo-album"></i> School Profile
                        {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">3</span> --}}
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile"
                        aria-selected="false">
                        <i class="tf-icons bx bx-user"></i> Administrative Team
                    </button>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                    <div class="mb-3" style="">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{asset($schoolinfo->logo_path)}}" style="height: 220px;"
                                    class="img-fluid rounded-start"  alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-2 ">SCHOOL NAME</label>
                                        <div class="col-sm-10">
                                            <h6 class="" id="staticEmail">
                                             {{$schoolinfo->name}}
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-2 ">SCHOOL ID</label>
                                        <div class="col-sm-10">
                                            <h6 class="" id="staticEmail">   {{$schoolinfo->regno}}</h6>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-2 ">SCHOOL ADRESS</label>
                                        <div class="col-sm-10">
                                            <h6 class="" id="staticEmail">   {{$schoolinfo->address}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <p>   {{ strip_tags($schoolinfo->about) }}
                        </p>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                    <div class="container">
                        <div class="row">
                            @foreach ($profilelist as $profilelists)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="our-team">
                                        <div class="picture">
                                            <img class="img-fluid"
                                                src="{{ asset('myimage/administrative/' . $profilelists->Pr_image) }}">
                                        </div>
                                        <div class="team-content">
                                            <h3 class="name">{{ $profilelists->Pr_name }}</h3>
                                            <h4 class="title">{{ $profilelists->Pr_designation }}</h4>
                                        </div>
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
