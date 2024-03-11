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
                                    <td>  <a href="" data-bs-toggle="modal" data-bs-target="#content"><i
                                        class="fa-solid fa-eye" style="color:black"> </i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div><br>
                    @if (auth()->user()->type == 'admin')
                    <a href="{{ url('admin/dailycontent') }}" class="btn btn-dark">Back</a>
                    @elseif (auth()->user()->type == 'staff')
                    <a href="{{ url('classteacher/dailycontent') }}" class="btn btn-dark">Back</a>
                        @else
                            return redirect()->route('home');
                @endif
                 
                </div>

            </div>
        </div>

{{-- modal --}}

<div class="modal fade" id="content" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static"  data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe src="{{ asset($contentshow->content_path) }}" type="application/pdf" width="100%" height="700px"></iframe>
            </div>

        </div>
    </div>
</div>



    </div>
@endsection
