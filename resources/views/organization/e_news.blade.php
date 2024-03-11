@extends('layouts.default')
@section('title', 'School E-News')
@section('sidebar')
@include('include.sidebar')
@endsection
@section('contentdashboard')
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>School E-News</h5>
<div class="card p-2">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">School E-News</h6>
        <small class="text-muted float-end"> <a href="{{ url('/accountsadd') }}" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="@mdo">Add E-News <i class="fa-solid fa-file-circle-plus"></i>
            </a></small>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table " id="example">
            <thead class="">
                <tr>
                    <th>Sl.No</th>
                    <th>Upload Date & Time</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>STATUS</th>
                    {{-- <th>ACTION</th> --}}
                </tr>
            </thead>
            @for ($i = 0; $i < 0; $i++) @endfor <tbody class="table-border-bottom-0">

                @foreach ($enews as $enew)
                <tr>
                    <td>{{ ++$i }}</td>

                    <td>{{ $enew->date }} - {{$enew->time}}</td>
                    <td>{{ $enew->title }}</td>
                    <td><a href="" class="badge bg-label-primary me-1" data-bs-toggle="modal" data-bs-target="#contentview{{$enew->id}}" data-bs-whatever="@mdo"><i class="fa-solid fa-eye"></i> view</a></td>
                    <!-- <td> <img src="{{ asset($enew->image_path) }}" width="150px" height="100px" class="square"> -->
                    </td>
                    <td>
                        @if (auth()->user()->type == 'admin')
                        @if ($enew->status == '1')
                        <a href="{{ route('enews.status', ['id' => $enew->id, 'status' => 0]) }}"><span class="badge bg-label-success me-1">Active</span></a>
                        @else
                        <a href="{{ route('enews.status', ['id' => $enew->id, 'status' => 1]) }}"> <span class="badge bg-label-danger me-1">Deactive</span></a>
                        @endif
                        @elseif (auth()->user()->type == 'clerk')
                        @if ($enew->status == '1')
                        <a href="{{ route('clerkenews.status', ['id' => $enew->id, 'status' => 0]) }}"><span class="badge bg-label-success me-1">Active</span></a>
                        @else
                        <a href="{{ route('clerkenews.status', ['id' => $enew->id, 'status' => 1]) }}">
                            <span class="badge bg-label-danger me-1">Deactive</span></a>
                        @endif
                        @else
                        return redirect()->route('home');
                        @endif

                    </td>
                </tr>
                @endforeach
                </tbody>
        </table>
    </div>
</div>

{{-- model --}}

<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (auth()->user()->type == 'admin')
                <form action="{{ route('enews.add') }}" class="row g-3" method="post" enctype="multipart/form-data">
                    @elseif (auth()->user()->type == 'clerk')
                    <form action="{{ route('clerkenews.add') }}" class="row g-3" method="post" enctype="multipart/form-data">
                        @else
                        return redirect()->route('home');
                        @endif

                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">E-News Title</label>
                            <input type="text" class="form-control" name="title" id="" placeholder="Title" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">E-News Content</label>
                            <textarea type="text" class="form-control" name="content" id="" placeholder="content" autocomplete="off" required></textarea>
                            <!-- <input type="text" class="form-control" name="content" id="" placeholder="Content"
                            autocomplete="off" required> -->
                        </div>
                        <!-- <div class="mb-3">
                        <label for="" class="form-label">E-News Date</label>
                        <input type="date" class="form-control" name="date" id="" placeholder="Date"
                            autocomplete="off" required>
                    </div> -->
                        <!-- <div class="mb-3">
                        <label for="" class="form-label">E-News Time</label>
                        <input type="time" class="form-control" name="time" id="" placeholder="Time"
                            autocomplete="off" required>
                    </div> -->
                        <!-- <div class="md-3">
                            <label for="" class="form-label">E-News Files</label>
                            <input type="file" name="image" class="form-control">
                        </div> -->
                        {{-- <div class="mb-3">
                            <label for="" class="form-label">E-News Image</label>
                            <input type="file" class="form-control" name="image"  placeholder="image"
                                autocomplete="off" required>
                        </div> --}}

                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> --}}
                            <button type="submit" class="btn btn-primary">Submit Form</button>
                        </div>
                    </form>
            </div>

        </div>
    </div>
</div>

{{-- content view --}}
@foreach ($enews as $enew)
<div class="modal fade" id="contentview{{$enew->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (auth()->user()->type == 'admin')
                <form action="{{ route('enews.update',$enew->id) }}" class="row g-3" method="post">
                    @elseif (auth()->user()->type == 'clerk')
                    <form action="{{ route('clerkenews.update',$enew->id) }}" class="row g-3" method="post">
                        @else
                        return redirect()->route('home');
                        @endif

                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">title</label>
                            <input type="text" class="form-control" id="recipient-name" name="title" value="{{ $enew->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Content</label>
                            <textarea class="form-control" name="content" id="message-text">{{ $enew->content }}</textarea>
                        </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">change</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection