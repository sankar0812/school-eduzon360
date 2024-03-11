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
                                    <td>DEPARTMENT</td>
                                    <td>teaching</td>
                                </tr>
                                <tr>
                                    <td>BASIC SALARY</td>
                                    <td>5000</td>
                                </tr>
                                <tr>
                                    <td>ALLOWANCES</td>
                                    <td>300</td>
                                </tr>
                                <tr>
                                    <td>DEDUCTIONS</td>
                                    <td>11</td>
                                </tr>
                                <tr>
                                    <td>OTHER ALLOWANCE</td>
                                    <td>222</td>
                                </tr>
                                <tr>
                                    <td>OVERTIME</td>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td>BONUS</td>
                                    <td>500</td>
                                </tr>
                                <tr>
                                    <td>NET SALARY</td>
                                    <td>70000</td>
                                </tr>
                                <tr>
                                    <td>PAYMENT METHOD</td>
                                    <td>direct deposit</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
