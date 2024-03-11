@extends('layouts.default')
@section('title', 'Student Login list')
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
                    $class = DB::table('class_sections')
                        ->where(['c_status' => 1, 'c_delete' => 1])
                        ->get();
                @endphp

                @if (auth()->user()->type == 'admin')
                    <form action="{{ route('student.filters') }}" method="GET">
                    @elseif (auth()->user()->type == 'clerk')
                        <form action="{{ route('clerkstudent.filters') }}" method="GET">
                        @else
                            return redirect()->route('home');
                @endif


                {{-- @csrf --}}
                <div class="form-group row mb-1">
                    <label for="input" class="col-sm-2 col-form-label">Select Class</label>
                    <div class="col-md-5">
                        <select class="form-control " aria-label="Default select example" name="classfilter"
                            required autocomplete="off">
                            <option value="" selected disabled hidden>select class</option>
                            @foreach ($class as $section)
                                <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="mb-3 row mt-2">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary  btn-sm"> <i class="bx bx-search fs-5 lh-0"></i> Search</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

   
        <hr class="my-3" />
        <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Student Login List</h5>
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
                Logins</a></small> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table  " id="example">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Class & Section</th>
                                <th>name</th>
                                <th>date of Birth</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        @for ($i = 0; $i < 1; $i++)
                        @endfor
                        <tbody class="table-border-bottom-0">
                            @foreach ($classfilter as $student)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $student->c_class }}</td>
                                    <td>{{ $student->s_name }}</td>
                                    <td>{{ $student->s_dob }}</td>
                                    <td>

                                        @if (auth()->user()->type == 'admin')
                                            @if ($student->s_loginstatus == 1)
                                                <a href="{{ route('student.status', $student->id) }}"><span
                                                        class="badge bg-label-success me-1">active</span></a>
                                            @else
                                                <a href="{{ route('student.status', $student->id) }}"><span
                                                        class="badge bg-label-danger me-1">Deactive</span></a>
                                            @endif
                                        @elseif (auth()->user()->type == 'clerk')
                                            @if ($student->s_loginstatus == 1)
                                                <a href="{{ route('clerkstudent.status', $student->id) }}"><span
                                                        class="badge bg-label-success me-1">active</span></a>
                                            @else
                                                <a href="{{ route('clerkstudent.status', $student->id) }}"><span
                                                        class="badge bg-label-danger me-1">Deactive</span></a>
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
        </div>
   
@endsection
