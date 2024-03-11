@extends('layouts.default')
@section('title', 'Offline Annaul Exam')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="card p-2">
        <div class="col-xl">

                <h5 class="card-header">
                    <a href="{{ url('offlineexam') }}" class="btn btn-outline-primary btn-sm">Add Exam</a>
                    {{-- <a href="{{ url('offlinedailyexam') }}" class="btn btn-outline-primary">Daily Exam</a> --}}
                    <a href="{{ url('offlinequarterlyexam') }}" class="btn btn-outline-primary btn-sm">Quarterly Exam</a>
                    <a href="{{ url('offlinehalflyexam') }}" class="btn btn-outline-primary btn-sm">Halfly Exam</a>
                    <a href="{{ url('offlineannualexam') }}" class="btn btn-primary btn-sm">Annual Exam</a>

                </h5>
                {{-- <div class="card-body">

            </div> --}}
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>

                                <td>
                                    <h6>
                                        <a href="{{ url('offlineexamedit') }}" class="btn btn-outline-warning btn-sm"><i
                                                class="fa-solid fa-file-pen fa-lg"></i></a>
                                        <a href="" class="btn btn-outline-danger btn-sm"><i
                                                class="fa-solid fa-trash fa-lg "></i></a>
                                    </h6><h5>Year : 2023-2024 || class : 9 </h5>

                                    <table class="table table-success table-striped table-hover table-bordered border-dark">
                                        <thead class="table-dark">
                                            <tr class="text-info">
                                                <th>Date</th>
                                                <th>Day</th>
                                                <th>Time</th>
                                                <th>Subject Code</th>
                                                <th>Subject</th>
                                                <th>Question</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            <tr>
                                                <td>12/5/2023</td>
                                                <td>monday</td>
                                                <td>9.30am to 12.30pm</td>
                                                <td>013</td>
                                                <td>tamil</td>
                                                <td><img src="" width="50px" height="50px"></td>
                                            </tr>
                                            <tr>
                                                <td>13/5/2023</td>
                                                <td>Tuesday</td>
                                                <td>9.30am to 12.30pm</td>
                                                <td>012</td>
                                                <td>English</td>
                                                <td><img src="" width="50px" height="50px"></td>
                                            </tr>
                                            <tr>
                                                <td>14/5/2023</td>
                                                <td>Wednesday</td>
                                                <td>9.30am to 12.30pm</td>
                                                <td>014</td>
                                                <td>maths</td>
                                                <td><img src="" width="50px" height="50px"></td>
                                            </tr>
                                            <tr>
                                                <td>15/5/2023</td>
                                                <td>Thursday</td>
                                                <td>9.30am to 12.30pm</td>
                                                <td>023</td>
                                                <td>social</td>
                                                <td><img src="" width="50px" height="50px"></td>
                                            </tr>
                                            <tr>
                                                <td>16/5/2023</td>
                                                <td>Friday</td>
                                                <td>9.30am to 12.30pm</td>
                                                <td>002</td>
                                                <td>science</td>
                                                <td><img src="" width="50px" height="50px"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6>
                                        <a href="{{ url('offlineexamedit') }}" class="btn btn-outline-warning btn-sm"><i
                                                class="fa-solid fa-file-pen fa-lg"></i></a>
                                        <a href="" class="btn btn-outline-danger btn-sm"><i
                                                class="fa-solid fa-trash fa-lg "></i></a>
                                    </h6><h5>Year : 2023-2024 || class : 10 </h5>
                                    <table class="table table-success table-striped table-hover table-bordered border-dark">
                                        <thead class="table-dark">
                                            <tr class="text-info">
                                                <th>Date</th>
                                                <th>Day</th>
                                                <th>Time</th>
                                                <th>Subject Code</th>
                                                <th>Subject</th>
                                                <th>Question</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            <tr>
                                                <td>12/5/2023</td>
                                                <td>monday</td>
                                                <td>9.30am to 12.30pm</td>
                                                <td>013</td>
                                                <td>tamil</td>
                                                <td><img src="" width="50px" height="50px"></td>
                                            </tr>
                                            <tr>
                                                <td>13/5/2023</td>
                                                <td>Tuesday</td>
                                                <td>9.30am to 12.30pm</td>
                                                <td>012</td>
                                                <td>English</td>
                                                <td><img src="" width="50px" height="50px"></td>
                                            </tr>
                                            <tr>
                                                <td>14/5/2023</td>
                                                <td>Wednesday</td>
                                                <td>9.30am to 12.30pm</td>
                                                <td>014</td>
                                                <td>maths</td>
                                                <td><img src="" width="50px" height="50px"></td>
                                            </tr>
                                            <tr>
                                                <td>15/5/2023</td>
                                                <td>Thursday</td>
                                                <td>9.30am to 12.30pm</td>
                                                <td>023</td>
                                                <td>social</td>
                                                <td><img src="" width="50px" height="50px"></td>
                                            </tr>
                                            <tr>
                                                <td>16/5/2023</td>
                                                <td>Friday</td>
                                                <td>9.30am to 12.30pm</td>
                                                <td>002</td>
                                                <td>science</td>
                                                <td><img src="" width="50px" height="50px"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

        </div>
    </div>
@endsection
