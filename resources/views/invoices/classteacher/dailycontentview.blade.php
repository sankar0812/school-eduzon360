@extends('layouts.default')
@section('title', 'daily_contentview')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h6 class="card-header"></h6>
                <div class="card-body">

                    <div class="table-responsive text-nowrap ">
                        <table class="table table-hover table-bordered  border-dark">
                            <tbody>
                                <tr>
                                    <td>DATE</td>
                                    <td>{{ $contentshow->date }}</td>
                                </tr>
                                <tr>
                                    <td>CLASS</td>
                                    <td>{{ $contentshow->c_class }}</td>
                                </tr>
                                <tr>
                                    <td>SUBJECT</td>
                                    <td>{{ $contentshow->name }}</td>
                                </tr>
                                <tr>
                                    <td>TITLE</td>
                                    <td>{{ $contentshow->title }}</td>
                                </tr>
                                <tr>
                                    <td>TOPICS</td>
                                    <td>{{ $contentshow->content }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div><br>
                    <a href="{{ url('classteacher/dailycontent') }}" class="btn btn-dark">Back</a>
                </div>

            </div>
        </div>
    </div>
@endsection
