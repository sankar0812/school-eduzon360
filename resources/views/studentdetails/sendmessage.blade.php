@extends('layouts.studentapp')
@section('title', 'Exam Timetable')
@section('studentdashboard')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
        Logins</a></small> --}}
            </div>
            <div class="card-body">
                <form class="">
                    <div class="form-group row mb-1">
                        <label for="" class="col-sm-2 col-form-label">Exam Type</label>
                        <div class="col-md-5">
                            <select class="form-select form-select-sm" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary mb-4 btn-sm">Confirm <i
                                    class="fa-solid fa-location-arrow"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row py-2">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="text-danger">2023-2024</h4>
            </div>
            <table class="table table-primary table-bordered table-striped ">
                <thead class="table-dark">
                    <tr>
                        <th colspan="5">
                            <form>
                                <div class="row">
                                    <div class="col-6 py-2">
                                        <label>Exam type : Item - 1</label>
                                    </div>
                                    <div class="col-6 py-2">
                                        <label>section : Class : 11-A</label>
                                    </div>
                                    <div class="col-6 py-2">
                                        <label>FN (9.30am to 12.30pm)<br>AN (2.00pm to 4.00pm)</label>
                                    </div>
                                </div>
                            </form>
                        </th>

                    </tr>
                    <tr>
                        <th>Date</th>
                        <th>Day</th>
                        <th>FN</th>
                        <th>AN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>12/5/2023</td>
                        <td>monday</td>
                        <td>tamil</td>
                        <td>tamil</td>

                    </tr>
                    <tr>
                        <td>13/5/2023</td>
                        <td>Tuesday</td>
                        <td>English</td>
                        <td>English</td>

                    </tr>
                    <tr>
                        <td>14/5/2023</td>
                        <td>Wednesday</td>
                        <td>maths</td>
                        <td>maths</td>

                    </tr>
                    <tr>
                        <td>15/5/2023</td>
                        <td>Thursday</td>
                        <td>social</td>
                        <td>social</td>

                    </tr>
                    <tr>
                        <td>16/5/2023</td>
                        <td>Friday</td>
                        <td>science</td>
                        <td>science</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
