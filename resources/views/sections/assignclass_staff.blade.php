@extends('layouts.default')
@section('title', 'Assign Class_staff')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Assign Class Staff</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        @if (auth()->user()->type == 'admin')
                            <form action="{{ route('admin.class_staff') }}" class="" method="post"
                                enctype="multipart/form-data">
                            @elseif (auth()->user()->type == 'clerk')
                                <form action="{{ route('clerk.class_staff') }}" class="" method="post"
                                    enctype="multipart/form-data">
                                @else
                                    return redirect()->route('home');
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="exampleInput" class="">Class & Section</label>
                            <select class="form-select" name="classid" aria-label="Default select example" required>
                                <option value="" selected disabled hidden>Select Class</option>
                                @foreach ($class as $section)
                                    <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                                @endforeach
                            </select>
                            <!-- <span
                            class="text-danger">Must to select staffs</span> -->
                        </div>

                        <div class="form-group py-3">
                            <label for="exampleInput" class="">Select Staff</label>
                            @foreach ($staffdetails as $staffdetail)
                                <div class="form-check py-1">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="staff_id[]"
                                        value="{{ $staffdetail->id }}">
                                    <label class="form-check-label" for="exampleCheck1">{{ $staffdetail->sf_name }}
                                        ({{ $staffdetail->sf_subject_taken }})
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        {{-- <a href="" class="btn btn-info">Add Form</a> --}}
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card" style="padding: 12px;">
                    {{-- <h5 class="card-header">Exam Type
                        <a style="float:right;" href="{{ url('/examtypes/create') }}"
                            class="btn btn-outline-primary btn-sm">ADD</a>
                    </h5> --}}
                    <div class="row">
                        <div class="table-responsive text-nowrap">


                            <table class="table  table-hover" id="example">

                                <thead class="">
                                    <tr class="text-info">
                                        <th>#</th>
                                        <th>class & section</th>
                                        <th>staffs</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @for ($i = 0; $i < 1; $i++)
                                @endfor
                                <tbody class="">
                                    @foreach ($assignstaff as $assignstaffs)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $assignstaffs->c_class }}</td>

                                            <td>
                                                @foreach ($assignstaffs->view as $staffview)
                                                    <li>{{ $staffview->sf_name }} ( {{ $staffview->sf_subject_taken }} )
                                                    </li>
                                                @endforeach
                                            </td>

                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                      </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                                        @if (auth()->user()->type == 'admin')
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.assignclass_staff_edit', $assignstaffs->id) }}">
                                                                    <i class="fa-solid fa-pen"></i> Edit
                                                                </a>
                                                            </li>
                                                        @elseif (auth()->user()->type == 'clerk')
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('clerk.assignclass_staff_edit', $assignstaffs->id) }}">
                                                                    <i class="fa-solid fa-pen"></i> Edit
                                                                </a>
                                                            </li>
                                                        @else
                                                            return redirect()->route('home');
                                                        @endif

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
