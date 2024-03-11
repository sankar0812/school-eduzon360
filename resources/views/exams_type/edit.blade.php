@extends('layouts.default')
@section('title', 'Edit staff')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')


    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Edit Exam Type</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('examtypes.update', $examtypesedit->id) }}" class="" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInput" class=" py-3">Exam Type</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Exam Type"
                                autocomplete="off" required value="{{ $examtypesedit->name }}">
                        </div>
                        <div class="form-check">
                            {{-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> --}}
                            {{-- <label class="form-check-label" for="exampleCheck1">Check me out</label> --}}
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card" style="padding: 12px;">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"></h6>
                    <small class="text-muted float-end">
                        <a href="{{ url('examtypes') }}" class="btn btn-primary btn-sm">Add</a>
                    </small>
                </div>
                <div class="row">
                    <div class="table-responsive text-nowrap">


                        <table class="table " id="example">

                            <thead class="">
                                <tr class="text-info">
                                    <th>#</th>
                                    <th>Exam Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="">

                                @foreach ($examtypesview as $type)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td> {{ $type->name }}</td>
                                        <td>
                                            @if ($type->id == 1)
                                                {{-- <div class="dropdown">
                                                    <button class=" dropdown-toggle drop " id="dropdownMenuButton1"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-sharp fa-solid fa-bars"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('examtypes.edit', $type->id) }}">
                                                                <i class="fa-solid fa-pen"></i> Edit
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div> --}}
                                            @else
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('examtypes.edit', $type->id) }}">
                                                                <i class="fa-solid fa-pen"></i> Edit
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
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
