@extends('layouts.default')
@section('title', 'Student profile')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>view Student</h5>
    <div class="row ml-1">
        <div class="col-md-3">
            <div class="row">
                <div class="card">
                    <h6 class="card-header"></h6>
                    <div class="card-body text-center">
                        {{-- <img src="{{ asset('/public/profiles/'.$student->s_profile) }}" width="100px" height="100px" class="rounded-circle"> --}}
                        {{-- {{asset($student->image_path)}} --}}
                        <img src="{{ asset($student->image_path) }}" width="100px" height="100px" class="rounded-circle">
                        <br>
                        <br>
                      <h4> <b> {{$student->s_name}}</b></h4>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-9">
            <div class="card">
                <h6 class="card-header"></h6>
                <div class="card-body">

                    <div class="table-responsive text-nowrap ">
                        <table class="table table-hover table-bordered  border-dark">
                            <tbody>
                                <tr>
                                    <td>ADMISSION NO</td>
                                    <td>{{$student->s_admissionno}}</td>
                                </tr>
                                <tr>
                                    <td>NAME</td>
                                    <td>{{$student->s_name}}</td>
                                </tr>
                                <tr>
                                    <td>EMAIL</td>
                                    <td>{{$student->s_email}}</td>
                                </tr>
                                <tr>
                                    <td>PERMANENT ADDRESS</td>
                                    <td>{{$student->s_permanentaddress}}</td>
                                </tr>
                                <tr>
                                    <td>PRESENT ADDRESS</td>
                                    <td>{{$student->s_presentaddress}}</td>
                                </tr>
                                <tr>
                                    <td>PHONE NO</td>
                                    <td>{{$student->s_phone}}</td>
                                </tr>

                                <tr>
                                    <td>FATHER / GUARDIAN NAME</td>
                                    <td>{{$student->s_fathername}}</td>
                                </tr>
                                <tr>
                                    <td>FATHER OCCUPATION</td>
                                    <td>{{$student->s_fatheroccupation}}</td>
                                </tr>
                                <tr>
                                    <td>MOTHER NAME</td>
                                    <td>{{$student->s_mothername}}</td>
                                </tr>
                                <tr>
                                    <td>MOTHER OCCUPATION</td>
                                    <td>{{$student->s_motheroccupation}}</td>
                                </tr>
                                <tr>
                                    <td>DATE OF BIRTH</td>
                                    <td>{{$student->s_dob}}</td>
                                </tr>
                                <tr>
                                    <td>GENDER</td>
                                    <td>{{$student->s_gender}}</td>
                                </tr>
                                <tr>
                                    <td>BLOOD GROUP</td>
                                    <td>{{$student->s_bloodgroup}}</td>
                                </tr>
                                <tr>
                                    <td>CERTIFICATE</td>
                                    <td>
                                        <a href="{{ asset($student->file_path) }}" download><i class='bx bx-download'></i></a>
                                      <a href="" data-bs-toggle="modal" data-bs-target="#certificate"><i
                                        class="fa-solid fa-eye" style="color:red;"></i></a>
                                        {{-- <ul class="list-styled users-list m-0 avatar-group d-flex align-items-center">
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                class=" pull-up">
                                                {{-- <img src="{{ url('./public/profiles/'.$student->s_profile) }}"
                                                    class="rounded-circle" width="50px" height="50px" /> --}}
                                                    {{-- <iframe src="{{asset($student->file_path)}}" width="100%" height="600"></iframe>
                                                    <br> --}}

                                                    {{-- <iframe srcdoc="https://docs.google.com/presentation/d/viewer?url=.\storage\app\public\certificates\{{$student->s_certificate}}&embedded=true" frameborder="0" style="width: 100%; min-height: 600;"></iframe> --}}
                                                    {{-- <iframe src="https://view.officeapps.live.com/op/view.aspx?href={{asset($student->file_path)}}" frameborder="0" style="width:100%;min-height:640px;"></iframe> --}}
                                                    {{-- <iframe href="D:\schoolmanagementdemo\storage\certificates\{{($student->s_certificate)}}"  style="width:550px; height:450px;" frameborder="0"></iframe> --}}
                                                   {{-- {{ asset($student->file_path)}} --}}
                                                    {{-- <embed href="http://docs.google.com/gview?src={{asset($student->file_path)}}" style="width:550px; height:450px;" frameborder="0"> --}}
                                                    {{-- <iframe  src="https://view.officeapps.live.com/op/embed.aspx?href={{ asset($student->file_path) }}" width="100%" height="565px" frameborder="0"> </iframe> --}}
                                                    {{-- <iframe href="https://docs.google.com/presentation/d/viewer?src={{asset($student->file_path)}}&embedded=true" frameborder="0" style="width: 100%; min-height: 600;"></iframe> --}}
                                                    {{-- <iframe src="https://www.officeapps.com/op/embed.aspx?href={{asset($student->file_path)}}"width="100%" height="565px" frameborder="0"> </iframe> --}}
                                                {{-- </li> --}}
                                    </td>
                                </tr>
                                <tr>

                                    <td>ADMISSION DATE</td>
                                    <td>   {{$student->s_admissiondate}}</td>
                                </tr>
                                {{-- <tr>
                                    <td><strong>Certificate:</strong></td>
                                    <td>{{ $student->s_certificate }}</td>
                                </tr>
                                <tr>
                                    <td> <strong>Join Date:</strong></td>

                                    <td> {{ $student->s_joindate }}</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>





{{-- modal --}}

<div class="modal fade" id="certificate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static"  data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe src="{{ asset($student->file_path) }}" type="application/pdf" width="100%" height="600px"></iframe>
            </div>

        </div>
    </div>
</div>


    </div>
@endsection
