@extends('layouts.default')
@section('title', 'Staff View')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="card">
                    <h6 class="card-header"></h6>
                    <div class="card-body text-center">
                        <img src="assets/img/avatars/5.png" width="100px" height="100px" class="rounded-circle">
                        <h4>sam</h4>
                    </div>
                </div>
            </div>
            {{-- <div class="row py-2">
                <div class="card">
                    <h6 class="card-header"></h6>
                    <div class="card-body text-center">
                        <div class="id-card">
                            <div class="photo"></div>
                            <div class="details">
                              <div class="name">John Doe</div>
                              <div class="designation">Math Teacher</div>
                            </div>
                          </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="col-md-9">
            <div class="card">
                <h6 class="card-header"></h6>
                <div class="card-body">
                   <h6> Personal Details</h6>
                    <div class="table-responsive text-nowrap ">
                        <table class="table table-hover table-bordered  border-dark">
                            <tbody>
                                <tr>
                                    <td>STAFF ID</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>NAME</td>
                                    <td>Sam</td>
                                </tr>
                                <tr>
                                    <td>EMAIL</td>
                                    <td>sam@gmail.com</td>
                                </tr>
                                <tr>
                                    <td>PERMANENT ADDRESS</td>
                                    <td>qqqqqqqqq,qqqqqqqqq</td>
                                </tr>
                                <tr>
                                    <td>PRESENT ADDRESS</td>
                                    <td>yyyyyyyyy,yyyyyyy</td>
                                </tr>
                                <tr>
                                    <td>PHONE NO</td>
                                    <td>111111111111</td>
                                </tr>
                                <tr>
                                    <td>CONTACT NO</td>
                                    <td>2222222222222222</td>
                                </tr>
                                <tr>
                                    <td>QUALIFICATION</td>
                                    <td>ttttttt</td>
                                </tr>
                                <tr>
                                    <td>EXPERIENCE</td>
                                    <td>5year</td>
                                </tr>
                                <tr>
                                    <td>LANGUAGES</td>
                                    <td>Tamil,English</td>
                                </tr>
                                <tr>
                                    <td>DATE OF BIRTH</td>
                                    <td>12/05/1998</td>
                                </tr>
                                <tr>
                                    <td>GENDER</td>
                                    <td>Male</td>
                                </tr>
                                <tr>
                                    <td>BLOOD GROUP</td>
                                    <td>0-</td>
                                </tr>
                                <tr>
                                    <td>CERTIFICATE</td>
                                    <td>
                                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                class=" pull-up">
                                                <img src="{{ url('asset/image/com.jpg') }}" alt="Avatar"
                                                    class="rounded-circle" width="50px" height="50px" />
                                            </li>
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                class=" pull-up">
                                                <img src="{{ url('asset/image/com.jpg') }}" alt="Avatar"
                                                    class="rounded-circle" width="50px" height="50px" />
                                            </li>
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                class=" pull-up">
                                                <img src="{{ url('asset/image/com.jpg') }}" alt="Avatar"
                                                    class="rounded-circle" width="50px" height="50px" />
                                            </li>
                                    </td>
                                </tr>
                                <tr>
                                    <td>JOIN DATE</td>
                                    <td>12/05/2015</td>
                                </tr>
                                <tr>
                                    <td>STAFF POSTION</td>
                                    <td>Teaching Staff</td>
                                </tr>
                                <tr>
                                    <td>SUBJECT TAUGHT</td>
                                    <td>English</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body py-3">
                    <h6>Account Details</h6>
                    <div class="table-responsive text-nowrap ">
                        <table class="table table-hover table-bordered  border-dark">
                            <tbody>
                                <tr>
                                    <td>BANK NAME</td>
                                    <td>State bank</td>
                                </tr>
                                <tr>
                                    <td>ACCOUNT NUMBER</td>
                                    <td>100000000000</td>
                                </tr>
                                <tr>
                                    <td>ACCOUNT HOLDER NAME</td>
                                    <td>sam</td>
                                </tr>
                                <tr>
                                    <td>BRANCH NAME</td>
                                    <td>nagercoil</td>
                                </tr>
                                <tr>
                                    <td>BRANCH CODE</td>
                                    <td>101</td>
                                </tr>
                                <tr>
                                    <td>IFSC CODE</td>
                                    <td>sb00111</td>
                                </tr>
                                <tr>
                                    <td>BANK ADDRESS</td>
                                    <td>nagercoil,nagercoil-12345</td>
                                </tr>
                                <tr>
                                    <td>ACCOUNT TYPE</td>
                                    <td>saving</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
