@extends('layouts.default')
@section('title', 'Student Details')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')



    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0"></h6>
            {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
            Logins</a></small> --}}
        </div>
        <div class="card-body">
            @php
                $class = DB::table('class_sections')
                    ->where(['c_status' => 1, 'c_delete' => 1])
                    ->get();
            @endphp

            @if (auth()->user()->type == 'admin')
                <form action="{{ route('admin.studentclassfilter') }}" method="GET">
                @elseif (auth()->user()->type == 'clerk')
                    <form action="{{ route('clerkstudent.studentclassfilter') }}" method="GET">
                    @else
                        return redirect()->route('home');
            @endif


            {{-- @csrf --}}
            <div class="form-group row mb-1">
                <label for="input" class="col-sm-2 col-form-label">Select Class</label>
                <div class="col-md-4">
                    <select class="form-control" name="class">
                        <option value="" selected disabled hidden>Select Class</option>
                        @foreach ($class as $section)
                            <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="type" class="form-control" name="admissionno" placeholder="Admission No"
                        autocomplete="off">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-3 py-2">
                    <button type="submit" class="btn btn-primary  btn-sm"> <i class="bx bx-search fs-5 lh-0"></i>
                        Search</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <hr class="my-5" />
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Student List</h5>
    <!-- Student List -->
    <div class="card p-2">
        <div class="table-responsive text-nowrap ">
            <table class="table" id="example">
                <thead class="">
                    <tr>
                        <th>Sl.No</th>
                        <th>NAME</th>
                        <th>CLASS</th>
                        <th>ADMISSION NO</th>
                        <th>PARENT NO</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $student->s_name }}</td>
                            <td>{{ $student->cname }}</td>
                            <td>{{ $student->s_admissionno }}</td>
                            <td>{{ $student->s_phone }}</td>
                            {{-- <td>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST">

                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-outline-info btn-sm"><i class="fa-solid fa-eye fa-lg"></i></a>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-file-pen fa-lg"></i></a>
                            @method('DELETE')
                            <a href="{{ route('students.destroy',$student->id) }}" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash fa-lg "></i></a>

                            @csrf


                            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash fa-lg "></i></a></button>
                            </form>
                            </td> --}}
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>

                                    @if (auth()->user()->type == 'admin')
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('students.show', $student->id) }}"><i
                                                        class="fa-solid fa-eye"></i> View
                                                    Profile</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('students.edit', $student->id) }}"><i
                                                        class="fa-solid fa-pen"></i> Edit</a></li>
                                            <li>
                                                <form action="{{ route('students.transfer', $student->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit"
                                                        href="{{ route('students.transfer', $student->id) }}"
                                                        class="dropdown-item"><i
                                                            class="fa-solid fa-person-walking-luggage"></i>
                                                        Transfer</button>
                                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                    <input type="hidden" name="class_id"
                                                        value="{{ $student->s_classid }}">
                                                </form>

                                            </li>
                                            {{-- <li>
                                                <form action="{{ route('students.completed', $student->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit"
                                                        href="{{ route('students.completed', $student->id) }}"
                                                        class="dropdown-item"><i class="fa-solid fa-user-graduate"></i>
                                                        Completed</button>

                                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                    <input type="hidden" name="class_id"
                                                        value="{{ $student->s_classid }}">

                                                </form>

                                            </li> --}}
                                            {{--
                                                    <li>
                                                        <form action="{{ route('students.destroy', $student->id) }}"
                                        method="POST">


                                        @method('DELETE')
                                        <button type="submit" href="{{ route('students.destroy', $student->id) }}" class="dropdown-item"><i class="fa-solid fa-trash"></i> Delete</button>

                                        @csrf

                                        </form>
                                        </li> --}}
                                        </ul>
                                    @elseif (auth()->user()->type == 'clerk')
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('clerkstudents.show', $student->id) }}"><i
                                                        class="fa-solid fa-eye"></i> View
                                                    Profile</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('clerkstudents.edit', $student->id) }}"><i
                                                        class="fa-solid fa-pen"></i> Edit</a></li>

                                            <li>
                                                <form action="{{ route('clerkstudents.transfer', $student->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit"
                                                        href="{{ route('clerkstudents.transfer', $student->id) }}"
                                                        class="dropdown-item"><i
                                                            class="fa-solid fa-person-walking-luggage"></i>
                                                        Transfer</button>
                                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                    <input type="hidden" name="class_id" value="{{ $student->cname }}">
                                                </form>

                                            </li>
                                            {{-- <li>
                                                <form action="{{ route('clerkstudents.completed', $student->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit"
                                                        href="{{ route('clerkstudents.completed', $student->id) }}"
                                                        class="dropdown-item"><i class="fa-solid fa-user-graduate"></i>
                                                        Completed</button>

                                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                    <input type="hidden" name="class_id" value="{{ $student->cname }}">

                                                </form>

                                            </li> --}}




                                            {{--
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('clerkstudents.transfer', $student->id) }}"><i class="fa-solid fa-person-walking-luggage"></i> Transfer</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('clerkstudents.completed', $student->id) }}"><i class="fa-solid fa-user-graduate"></i> Completed</a></li> --}}
                                            {{-- <li>
                                                        <form action="{{ route('clerkstudents.destroy', $student->id) }}"
                                        method="POST">


                                        @method('DELETE')
                                        <button type="submit" href="{{ route('clerkstudents.destroy', $student->id) }}" class="dropdown-item"><i class="fa-solid fa-trash"></i> Delete</button>

                                        @csrf

                                        </form>
                                        </li> --}}
                                        </ul>
                                    @else
                                        return redirect()->route('home');
                                    @endif


                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
@push('other-scripts')
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script> --}}
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js">
    </script>
@endpush
