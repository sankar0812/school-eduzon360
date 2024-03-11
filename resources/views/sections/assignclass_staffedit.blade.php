@extends('layouts.default')
@section('title', 'Assign Class_staff Edit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Edit Assign Staff</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    @if (auth()->user()->type == 'admin')
                        <form action="{{ route('admin.class_staffupdate', $assignstaffedit->id) }}" class=""
                            method="post" enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'clerk')
                            <form action="{{ route('clerk.class_staffupdate', $assignstaffedit->id) }}" class=""
                                method="post" enctype="multipart/form-data">
                            @else
                                return redirect()->route('home');
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="exampleInput" class="">Class & Section</label>
                        {{--  <select class="form-select" name="classid" aria-label="Default select example">
                                @foreach ($class as $section)
                                    <option value="{{ $section->id }}"
                                        {{ $section->id == $assignstaffedit->classid ? 'Selected' : '' }} readonly>
                                        {{ $section->c_class }}</option>
                                @endforeach 
                            </select> --}}
                        <input type="type" class="form-control" id="" name="classid"
                            value="{{ $assignstaffedit->c_class }}" readonly>
                    </div>

                    <div class="form-group py-3">
                        <label for="exampleInput" class="">Select Staff</label>

                        @foreach ($assignstaffedit->views as $assignstaffedits)
                            <div class="form-check py-1">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name=""
                                    value="{{ $assignstaffedits->id }}" checked>
                                <label class="form-check-label" for="exampleCheck1">{{ $assignstaffedits->sf_name }} (
                                    {{ $assignstaffedits->sf_subject_taken }} )</label>
                                @if (auth()->user()->type == 'admin')
                                    <a href="{{ url('admin/assignclass_staff_delete', $assignstaffedits->subassignid) }}"
                                        class=" text-danger"><i class="fa-solid fa-trash"></i></a>
                                @elseif (auth()->user()->type == 'clerk')
                                    <a href="{{ url('clerk/assignclass_staff_delete', $assignstaffedits->subassignid) }}"
                                        class=" text-danger"><i class="fa-solid fa-trash"></i></a>
                                @else
                                    return redirect()->route('home');
                                @endif
                            </div>
                        @endforeach


                        @foreach ($staffdetailsadd as $staffdetailsadds)
                            <div class="form-check py-1">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="newstaff_id[]"
                                    value="{{ $staffdetailsadds->id }}">
                                <label class="form-check-label" for="exampleCheck1">{{ $staffdetailsadds->sf_name }} (
                                    {{ $staffdetailsadds->sf_subject_taken }} )</label>
                            </div>
                        @endforeach
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
                        @if (auth()->user()->type == 'admin')
                            <a href="{{ url('admin/assignclass_staff') }}" class="btn btn-primary btn-sm">ADD </a>
                        @elseif (auth()->user()->type == 'clerk')
                            <a href="{{ url('clerk/assignclass_staff') }}" class="btn btn-primary btn-sm">ADD </a>
                        @else
                            return redirect()->route('home');
                        @endif
                    </small>
                </div>
                <div class="row">
                    <div class="table-responsive text-nowrap">


                        <table class="table" id="example">

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
                                                <li>{{ $staffview->sf_name }} ( {{ $staffview->sf_subject_taken }})
                                                </li>
                                            @endforeach
                                        </td>

                                        <td>
                                            <div class="dropdown">

                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
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
