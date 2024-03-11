@extends('layouts.default')
@section('title', 'inbox')
@section('sidebar')
    @include('include.classteachersidebar')
@endsection
@section('contentdashboard')
@include('classteacher.message.messageform')
    <button type="button" class="btn btn-lg btn-outline-secondary" data-bs-toggle="modal"
        data-bs-target="#parentmessage"><i class="fa-solid fa-pen"></i> compose</button>
    <div class="row py-2">
        <div class="card p-2">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped table-hover" id="example">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>Ashok</td>
                            <td> If I'm not there when you phone, leave a message</td>
                            <td>12-5</td>
                        </tr>

                        <tr>
                            <td>Ravi</td>
                            <td> If I'm not there when you phone, leave a message</td>
                            <td>12-5</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
