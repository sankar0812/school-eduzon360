@extends('layouts.default')
@section('title', 'Class_section')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="col-xl-12 ">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true"
                        style="font-weight:bold;">
                        Create Class
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false"
                        style="font-weight:bold;">
                        Create Class Teacher
                    </button>
                </li>
                {{-- <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-top-class-staff" aria-controls="navs-top-class-staff" aria-selected="false"
                        style="font-weight:bold;">
                        Assign Class Staff
                    </button>
                </li> --}}
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">

                    <div class="card-body row g-3">

                        @if (auth()->user()->type == 'admin')
                            <form action="{{ route('sections.store') }}" class="" method="post"
                                enctype="multipart/form-data">
                            @elseif (auth()->user()->type == 'clerk')
                                <form action="{{ route('clerksections.store') }}" class="" method="post"
                                    enctype="multipart/form-data">
                                @else
                                    return redirect()->route('home');
                        @endif
                        @csrf
                        <div class="form-group row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Class/Section</label>
                            <div class="col-md-5">
                                <!-- <input type="text" name="section" id="" class="form-control"  placeholder="Class & Section" pattern="\d+-[A-Z]+" autocomplete="off" required> -->
                                <input type="text" name="section" id="" class="form-control" 
                                 placeholder="Class & Section"  autocomplete="off" required>

                            </div>
                        </div>
                        {{-- <div class="form-group row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Class Teacher</label>
                            <div class="col-md-5">
                                <select class="form-control" aria-label="Default select example" name="teacher">
                                    <option></option>
                                    @foreach ($stafflist as $staffs)
                                        <option value="{{ $staffs->id }}">{{ $staffs->sf_name }} --
                                            {{ $staffs->sf_subject_taken }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="mb-3 row">
                            <label for="" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary mb-4 ">Submit Form <i
                                        class="fa-solid fa-location-arrow"></i></button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <hr class="my-3" />

                    <div class="table-responsive text-nowrap">
                        <table class="table" id="example4">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>Class & section</th>
                                    {{-- <th>class Teacher</th> --}}
                                    <th>Status</th>
                                     <th>Actions</th> 
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($classdata as $class)
                                    <tr>
                                        <td>{{ $class->id }}</td>
                                        <td>{{ $class->c_class }}</td>
                                        {{-- <td>{{ $class->sf_name }}</td> --}}
                                        <td>

                                            @if (auth()->user()->type == 'admin')
                                                @if ($class->c_status == 1)
                                                    <a href="{{ route('class.status', $class->id) }}"><span
                                                            class="badge bg-label-primary me-1">Active</span></a>
                                                @else
                                                    <a href="{{ route('class.status', $class->id) }}"><span
                                                            class="badge bg-label-danger me-1">Deactive</span></a>
                                                @endif
                                            @elseif (auth()->user()->type == 'clerk')
                                                @if ($class->c_status == 1)
                                                    <a href="{{ route('clerkclass.status', $class->id) }}"><span
                                                            class="badge bg-label-primary me-1">Active</span></a>
                                                @else
                                                    <a href="{{ route('clerkclass.status', $class->id) }}"><span
                                                            class="badge bg-label-danger me-1">Deactive</span></a>
                                                @endif
                                            @else
                                                return redirect()->route('home');
                                            @endif




                                        </td>
                                         <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                  <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        @if (auth()->user()->type == 'admin')
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.classedit', $class->id) }}"><i
                                                                    class="fa-solid fa-pen"></i> Edit</a>
                                                        @elseif (auth()->user()->type == 'clerk')
                                                            <a class="dropdown-item"
                                                                href="{{ route('clerkadmin.classedit', $class->id) }}"><i
                                                                    class="fa-solid fa-pen"></i> Edit</a>
                                                        @else
                                                            return redirect()->route('home');
                                                        @endif

                                                    <li>
                                                </ul>
                                            </div>
                                        </td> 
                                        {{-- <td>
                                        <div class="dropdown">
                                            <button class=" dropdown-toggle drop" id="dropdownMenuButton1"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-sharp fa-solid fa-bars"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <form action="{{ route('sections.destroy', $class->id) }}"
                                                        method="POST">


                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                    <div class="card-body row g-3">

                        @if (auth()->user()->type == 'admin')
                            <form action="{{ route('sections.store') }}" class="" method="post"
                                enctype="multipart/form-data">
                            @elseif (auth()->user()->type == 'clerk')
                                <form action="{{ route('clerksections.store') }}" class="" method="post"
                                    enctype="multipart/form-data">
                                @else
                                    return redirect()->route('home');
                        @endif



                        @csrf
                        <div class="form-group row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Class/Section</label>
                            <div class="col-md-5">
                                {{-- <input type="text" name="section" id="" class="form-control"
                                    placeholder="Class & Section" pattern="[0-12]{0,2}-[A-Z]" autocomplete="off" required> --}}
                                <select class="form-control" aria-label="Default select example" name="section" required>
                                    <option value="" selected disabled hidden>Select Class</option>
                                    @foreach ($classlist as $class)
                                        <option value="{{ $class->id }}">
                                            {{ $class->c_class }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Class Teacher</label>
                            <div class="col-md-5">
                                <select class="form-control" aria-label="Default select example" name="teacher" required>
                                    <option value="" selected disabled hidden>Select Staff</option>
                                    @foreach ($stafflist as $staffs)
                                        <option value="{{ $staffs->id }}">{{ $staffs->sf_name }} (
                                            {{ $staffs->sf_subject_taken }} )
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary mb-4 ">Submit Form <i
                                        class="fa-solid fa-location-arrow"></i></button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <hr class="my-3" />
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="example2">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>Class & section</th>
                                    <th>class Teacher</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 0; $i++)
                                @endfor
                                @foreach ($classstaffdata as $classstaff)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $classstaff->c_class }}</td>
                                        <td>{{ $classstaff->sf_name }}</td>
                                        {{-- <td>

                                            @if (auth()->user()->type == 'admin')
                                                @if ($classstaff->c_status == 1)
                                                    <a href="{{ route('class.status', $classstaff->id) }}"><span
                                                            class="badge bg-label-primary me-1">Active</span></a>
                                                @else
                                                    <a href="{{ route('class.status', $classstaff->id) }}"><span
                                                            class="badge bg-label-danger me-1">Deactive</span></a>
                                                @endif
                                            @elseif (auth()->user()->type == 'clerk')
                                                @if ($classstaff->c_status == 1)
                                                    <a href="{{ route('clerkclass.status', $classstaff->id) }}"><span
                                                            class="badge bg-label-primary me-1">Active</span></a>
                                                @else
                                                    <a href="{{ route('clerkclass.status', $classstaff->id) }}"><span
                                                            class="badge bg-label-danger me-1">Deactive</span></a>
                                                @endif
                                            @else
                                                return redirect()->route('home');
                                            @endif
                                        </td> --}}
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                  <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        @if (auth()->user()->type == 'admin')
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.classteacheredit', $classstaff->id) }}"><i
                                                                    class="fa-solid fa-pen"></i> Edit</a>
                                                        @elseif (auth()->user()->type == 'clerk')
                                                            <a class="dropdown-item"
                                                                href="{{ route('clerkadmin.classteacheredit', $classstaff->id) }}"><i
                                                                    class="fa-solid fa-pen"></i> Edit</a>
                                                        @else
                                                            return redirect()->route('home');
                                                        @endif

                                                    <li>
                                                </ul>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- <div class="tab-pane fade" id="navs-top-class-staff" role="tabpanel">

                    <div class="card-body row g-3">

                        @if (auth()->user()->type == 'admin')
                            <form action="{{ route('sections.store') }}" class="" method="post"
                                enctype="multipart/form-data">
                            @elseif (auth()->user()->type == 'clerk')
                                <form action="{{ route('clerksections.store') }}" class="" method="post"
                                    enctype="multipart/form-data">
                                @else
                                    return redirect()->route('home');
                        @endif



                        @csrf
                        <div class="form-group row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Class/Section</label>
                            <div class="col-md-5">
                              
                                <select class="form-control" aria-label="Default select example" name="section" required>
                                    <option value="" selected disabled hidden>Select Class</option>
                                    @foreach ($classlist as $class)
                                        <option value="{{ $class->id }}">
                                            {{ $class->c_class }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Class Teacher</label>
                            <div class="col-md-5">
                                <select class="form-control" aria-label="Default select example" name="teacher" required>
                                    <option value="" selected disabled hidden>Select Staff</option>
                                    @foreach ($stafflist as $staffs)
                                        <option value="{{ $staffs->id }}">{{ $staffs->sf_name }} --
                                            {{ $staffs->sf_subject_taken }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary mb-4 ">Submit Form <i
                                        class="fa-solid fa-location-arrow"></i></button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table  table-striped table-hover" id="example1">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Class & section</th>
                                    <th>class staffs</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 0; $i++)
                                @endfor
                                @foreach ($classstaffdata as $classstaff)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $classstaff->c_class }}</td>
                                        <td>{{ $classstaff->sf_name }}</td>
                                        <td>

                                            @if (auth()->user()->type == 'admin')
                                                @if ($classstaff->c_status == 1)
                                                    <a href="{{ route('class.status', $classstaff->id) }}"><span
                                                            class="badge bg-label-primary me-1">Active</span></a>
                                                @else
                                                    <a href="{{ route('class.status', $classstaff->id) }}"><span
                                                            class="badge bg-label-danger me-1">Deactive</span></a>
                                                @endif
                                            @elseif (auth()->user()->type == 'clerk')
                                                @if ($classstaff->c_status == 1)
                                                    <a href="{{ route('clerkclass.status', $classstaff->id) }}"><span
                                                            class="badge bg-label-primary me-1">Active</span></a>
                                                @else
                                                    <a href="{{ route('clerkclass.status', $classstaff->id) }}"><span
                                                            class="badge bg-label-danger me-1">Deactive</span></a>
                                                @endif
                                            @else
                                                return redirect()->route('home');
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class=" dropdown-toggle drop " id="dropdownMenuButton1"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-sharp fa-solid fa-bars"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        @if (auth()->user()->type == 'admin')
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.classedit', $classstaff->id) }}"><i
                                                                    class="fa-solid fa-pen"></i> Edit</a>
                                                        @elseif (auth()->user()->type == 'clerk')
                                                            <a class="dropdown-item"
                                                                href="{{ route('clerkadmin.classedit', $classstaff->id) }}"><i
                                                                    class="fa-solid fa-pen"></i> Edit</a>
                                                        @else
                                                            return redirect()->route('home');
                                                        @endif

                                                    <li>
                                                </ul>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div> --}}

            </div>
        </div>
    </div>
@endsection
