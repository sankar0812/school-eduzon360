@extends('layouts.default')
@section('title', 'staff profile')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
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
                                {{-- <a href="{{ url('resultedit') }}" class="btn btn-outline-secondary btn-sm"><i
                                        class="fa-solid fa-file-pen fa-lg"></i></a> --}}
                                <a href="" class="btn btn-outline-danger btn-sm"><i
                                        class="fa-solid fa-trash fa-lg "></i></a>
                            </h6>
                            <h5>Year : 2023-2024 || class : 9 </h5>

                            <table class="table table-sm table-success table-striped table-hover table-bordered border-dark">
                                <thead class="table-dark">
                                    <tr class="text-info">
                                        <th>student name</th>
                                        <th>class</th>
                                        <th>tamil</th>
                                        <th>english</th>
                                        <th>maths</th>
                                        <th>social</th>
                                        <th>science</th>
                                        <th>total mark</th>
                                        <th>percentage</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <tr>
                                        <td>sam</td>
                                        <td>10A</td>
                                        <td>50</td>
                                        <td>60</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>260</td>
                                        <td>45%</td>
                                    </tr>
                                    <tr>
                                        <td>ravi</td>
                                        <td>10A</td>
                                        <td>50</td>
                                        <td>60</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>260</td>
                                        <td>45%</td>
                                    </tr>
                                    <tr>
                                        <td>kavin</td>
                                        <td>10A</td>
                                        <td>50</td>
                                        <td>60</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>260</td>
                                        <td>45%</td>
                                    </tr>
                                    <tr>
                                        <td>ram</td>
                                        <td>10A</td>
                                        <td>50</td>
                                        <td>60</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>260</td>
                                        <td>45%</td>
                                    </tr>
                                    <tr>
                                        <td>siva</td>
                                        <td>10A</td>
                                        <td>50</td>
                                        <td>60</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>50</td>
                                        <td>260</td>
                                        <td>45%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
