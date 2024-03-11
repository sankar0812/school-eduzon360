@extends('layouts.studentapp')
@section('title', 'dailytopic')
@section('studentdashboard')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>

            </div>
            <div class="card-body">
                <form class="" action="{{ route('student.dailytopicfilter') }}" method="get">
                    <div class="form-group row mb-1">
                        <label for="" class="col-sm-2 col-form-label">Previous Date</label>
                        <div class="col-md-5">

                            <input type="date" name="olddate" id="" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary mt-2 btn-sm">Confirm <i
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
                {{-- <small class="text-danger float-end">{{ $fyear }}</small> --}}
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-primary table-bordered table-striped ">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Subject</th>
                            <th>Title</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contentview as $content)
                            <tr>
                                <td>{{ $content->date }}</td>
                                <td>{{ $content->name}}</td>
                                <td>{{ $content->title }}</td>
                                <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#content{{ $content->id }}">
                                        <i class="fa-solid fa-eye" style="color:black"></i> view
                                    </a>
                                    <!-- Other content here -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
        {{-- modal --}}
        @foreach ($contentview as $content)
            <div class="modal fade" id="content{{ $content->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-backdrop="static">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Content</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="{{ asset($content->content_path) }}" type="application/pdf" width="100%"
                                height="700px"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
@endsection
