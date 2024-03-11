@extends('layouts.default')
@section('title', 'Staffposition')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')

    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Add Staff Position</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">

                    <form action="{{ url('/subjects') }}" class="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInput" class=" py-3">Subject</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Subject Name"
                                autocomplete="off" required>
                        </div>
                        <div class="form-check">
                  
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card" style="padding: 12px;">
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
                                <!-- @foreach ($subjects as $subject)
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
                                @endforeach -->



                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
