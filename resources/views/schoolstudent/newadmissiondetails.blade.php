@extends('layouts.default')
@section('title', 'New_Admission Details')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')


    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0"></h6>
        </div>
        <div class="card-body">
            @php
                $admissions = DB::table('newadmissions')
                    ->select('academic_year')
                    ->groupby('academic_year')
                    ->get();
            @endphp

            @if (auth()->user()->type == 'admin')
                <form action="{{ route('newstudents.yearfilter') }}" method="GET">
                @elseif (auth()->user()->type == 'clerk')
                    <form action="{{ route('clerknewstudents.yearfilter') }}" method="GET">
                    @else
                        return redirect()->route('home');
            @endif


            {{-- @csrf --}}
            <div class="form-group row mb-1">
                <label for="input" class="col-sm-2 col-form-label">Select Year</label>
                <div class="col-md-5">
                    <select class="form-control " aria-label="Default select example" name="year" required
                        autocomplete="off">
                        <option value="" selected disabled hidden>Select Year</option>
                        @foreach ($admissions as $admission)
                            <option value="{{ $admission->academic_year }}"> {{ $admission->academic_year }} </option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-3 py-2">
                    <button type="submit" class="btn btn-primary mt-2 btn-sm"> <i class="bx bx-search fs-5 lh-0"></i>
                        Search</button>
                </div>
            </div>
            </form>
        </div>
    </div>


    <hr class="my-3" />
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Admission List</h5>
    <div class="card p-2">

        <div class="table-responsive text-nowrap ">
            <table class="table" id="example">
                <thead class="">
                    <tr>
                        <th>Sl.No</th>
                        <th>Admission No.</th>
                        <th>Class</th>
                        <th>NAME</th>
                        <th>Admission DATE</th>
                        <th>Academic Year</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    {{-- @if ($class_select >= 1)
<h1>hiii</h1>
@else
<h1>error</h1>
                        @endif --}}
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $student->s_admissionno }}</td>
                            <td>{{ $student->class }}</td>
                            <td>{{ $student->s_name }}</td>
                            <td>{{ $student->s_admissiondate }}</td>
                            <td>{{ $student->academic_year }}</td>

                            <td>
                                @if ($student->status == '0')
                                    @if (auth()->user()->type == 'admin')
                                        <form action="{{ route('newstudent.status') }}" method="POST">
                                        @elseif (auth()->user()->type == 'clerk')
                                            <form action="{{ route('clerknewstudent.status') }}" method="POST">
                                            @else
                                                return redirect()->route('home');
                                    @endif


                                    @csrf

                                    <input type="hidden" class="form-control" name="s_admissionno"
                                        value="{{ $student->s_admissionno }}">
                                    <input type="hidden" class="form-control" name="s_name"
                                        value="{{ $student->s_name }}">
                                    <input type="hidden" class="form-control" name="s_dob"
                                        value="{{ $student->s_dob }}">
                                    <input type="hidden" class="form-control" name="s_gender"
                                        value="{{ $student->s_gender }}">
                                    <input type="hidden" class="form-control" name="s_email"
                                        value="{{ $student->s_email }}">
                                    <input type="hidden" class="form-control" name="s_religion"
                                        value="{{ $student->s_religion }}">
                                    <input type="hidden" class="form-control" name="s_aadharno"
                                        value="{{ $student->s_aadharno }}">
                                    <input type="hidden" class="form-control" name="s_bloodgroup"
                                        value="{{ $student->s_bloodgroup }}">
                                    <input type="hidden" class="form-control" name="s_permanentaddress"
                                        value="{{ $student->s_permanentaddress }}">
                                    <input type="hidden" class="form-control" name="s_presentaddress"
                                        value="{{ $student->s_presentaddress }}">
                                    <input type="hidden" class="form-control" name="s_nationality"
                                        value="{{ $student->s_nationality }}">
                                    <input type="hidden" class="form-control" name="s_state"
                                        value="{{ $student->s_state }}">
                                    <input type="hidden" class="form-control" name="s_fathername"
                                        value="{{ $student->s_fathername }}">
                                    <input type="hidden" class="form-control" name="s_fatheroccupation"
                                        value="{{ $student->s_fatheroccupation }}">
                                    <input type="hidden" class="form-control" name="s_mothername"
                                        value="{{ $student->s_mothername }}">
                                    <input type="hidden" class="form-control" name="s_motheroccupation"
                                        value="{{ $student->s_motheroccupation }}">
                                    <input type="hidden" class="form-control" name="s_phone"
                                        value="{{ $student->s_phone }}">
                                    <input type="hidden" class="form-control" name="s_disabledperson"
                                        value="{{ $student->s_disabledperson }}">
                                    <input type="hidden" class="form-control" name="s_profile"
                                        value="{{ $student->s_profile }}">
                                    <input type="hidden" class="form-control" name="image_path"
                                        value="{{ $student->image_path }}">
                                    <input type="hidden" class="form-control" name="s_certificate"
                                        value="{{ $student->s_certificate }}">
                                    <input type="hidden" class="form-control" name="file_path"
                                        value="{{ $student->file_path }}">
                                    <input type="hidden" class="form-control" name="s_admissiondate"
                                        value="{{ $student->s_admissiondate }}">
                                    <input type="hidden" class="form-control" name="academic_year"
                                        value="{{ $student->academic_year }}">
                                    <input type="hidden" class="form-control" name="status" value="0">
                                    <input type="hidden" class="form-control" name="id"
                                        value="{{ $student->id }}">
                                    <button type="button" style="border:none;background-color:transparent;">
                                        <span class="badge bg-label-danger me-1" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal12{{ $student->id }}">UN
                                            Changed</span></button>




                                    <div class="modal fade" id="exampleModal12{{ $student->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- <form action="{{ route('visitor.update') }}" class="row g-3" method="post"
                                                                        enctype="multipart/form-data">
                                                                        @csrf --}}

                                                    {{-- <input type="text" class="form-control" name="id"  value="{{ $student->id }}"> --}}
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">Select
                                                            Class</label>
                                                        <select class="form-select" id="inputGroupSelect02"
                                                            name="classid" required>
                                                            <option value="" selected disabled hidden>Choose...
                                                            </option>
                                                            @foreach ($classes as $class)
                                                                <option value="{{ $class->id }}">
                                                                    {{ $class->c_class }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">Student
                                                            Name</label>
                                                        <input type="hidden" class="form-control" name="s_firstname"
                                                            readonly value="{{ $student->s_firstname }}">
                                                        <input type="hidden" class="form-control" name="s_lastname"
                                                            readonly value="{{ $student->s_lastname }}">
                                                        <input type="text" class="form-control" name=""
                                                            readonly value="{{ $student->s_name }}">
                                                    </div>

                                                    <div class="modal-footer">
                                                        {{-- <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Close</button> --}}
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                    {{-- </form> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                @else
                                    {{-- <a href="{{ route('enews.status', ['id' => $student->id, 'status' => 1]) }}"> --}}
                                    <span class="badge bg-label-success me-1">Changed</span>
                                    {{-- </a> --}}
                                @endif
                            </td>
                            {{-- <td>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST">

                                <a href="{{ route('students.show', $student->id) }}"
                                    class="btn btn-outline-info btn-sm"><i class="fa-solid fa-eye fa-lg"></i></a>
                                <a href="{{ route('students.edit', $student->id) }}"
                                    class="btn btn-outline-warning btn-sm"><i
                                        class="fa-solid fa-file-pen fa-lg"></i></a>
                                @method('DELETE')
                                <a href="{{ route('students.destroy',$student->id) }}"  class="btn btn-outline-danger btn-sm"><i
                                class="fa-solid fa-trash fa-lg "></i></a>

                                @csrf


                                <button type="submit" class="btn btn-outline-danger btn-sm"><i
                                        class="fa-solid fa-trash fa-lg "></i></a></button>
                             </form>
                        </td> --}}
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            @if (auth()->user()->type == 'admin')
                                                <a class="dropdown-item"
                                                    href="{{ route('newstudents.show', $student->id) }}"><i
                                                        class="fa-solid fa-eye"></i> View
                                                    Profile</a>
                                            @elseif (auth()->user()->type == 'clerk')
                                                <a class="dropdown-item"
                                                    href="{{ route('clerknewstudents.show', $student->id) }}"><i
                                                        class="fa-solid fa-eye"></i> View
                                                    Profile</a>
                                            @else
                                                return redirect()->route('home');
                                            @endif

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

@endsection
