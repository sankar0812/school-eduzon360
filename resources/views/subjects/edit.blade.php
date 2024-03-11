@extends('layouts.default')
@section('title', 'Edit staff')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Edit Subject</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('subjects.update', $subjectsedit->id) }}" class="" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="exampleInput" class=" py-3">Subject</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Subject Name"
                                autocomplete="off" required value="{{ $subjectsedit->name }}">
                        </div>
                        <div class="form-check">
                            {{-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> --}}
                            {{-- <label class="form-check-label" for="exampleCheck1">Check me out</label> --}}
                        </div>
                        <button type="submit" class="btn btn-primary">update</button>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card" style="padding: 12px;">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"></h6>
                    <small class="text-muted float-end">
                        <a href="{{ url('subjects') }}" class="btn btn-primary btn-sm">Add</a>
                    </small>
                </div>
                <div class="row">
                    <div class="table-responsive text-nowrap">


                        <table class="table" id="example">

                            <thead class="">
                                <tr class="text-info">
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($subjectsview as $subject)
                                    <tr>
                                        <td>{{ $subject->id }}</td>
                                        <td> {{ $subject->name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('subjects.edit', $subject->id) }}">
                                                            <i class="fa-solid fa-pen"></i> Edit
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach



                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
