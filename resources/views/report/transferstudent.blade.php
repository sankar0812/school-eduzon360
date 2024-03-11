@extends('layouts.default')
@section('title', 'Transfer Student Details')
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


            @if (auth()->user()->type == 'admin')
                <form action="{{ route('admin.studenttransferfilter') }}" method="GET">
                @elseif (auth()->user()->type == 'clerk')
                    <form action="{{ route('clerkstudent.studenttransferfilter') }}" method="GET">
                    @else
                        return redirect()->route('home');
            @endif


            {{-- @csrf --}}
            <div class="form-group row mb-1">
                <label for="input" class="col-sm-2 col-form-label">Select Year</label>
                <div class="col-md-5">
                    <select class="form-control" name="year" required>
                        <option value="" selected disabled hidden>Academic Year</option>
                        @if ($Adyear)
                            @foreach ($Adyear as $Adyears)
                                <option value="{{ $Adyears->tr_year }}">ACADEMIC YEAR - {{ $Adyears->tr_year }}</option>
                            @endforeach
                        @endif
                    </select>
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

    <hr class="my-3" />
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Student Compelet</h5>

    <div class="card p-2">
      
            <div class="table-responsive text-nowrap ">
                <table class="table " id="example">
                    <thead class="">
                        <tr>
                            <th>SL.NO</th>
                            <th>NAME</th>
                            <th>LAST CLASS</th>
                            <th>ADMISSION DATE</th>
                            <th>ACADEMIC YEAR</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @for ($i = 0; $i < 1; $i++)
                        @endfor
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $student->s_name }}</td>
                                <td>{{ $student->c_class }}</td>
                                <td>{{ $student->s_admissiondate }}</td>
                                <td>{{ $student->tr_year }}</td>

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
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>

                                      @if (auth()->user()->type == 'admin')
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('students.show', $student->tr_student_id) }}"><i
                                                            class="fa-solid fa-eye"></i> View
                                                        Profile</a></li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('students.edit', $student->tr_student_id) }}"><i
                                                            class="fa-solid fa-pen"></i> Edit</a></li>
                                            </ul>
                                        @elseif (auth()->user()->type == 'clerk')
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('clerkstudents.show', $student->tr_student_id) }}"><i
                                                            class="fa-solid fa-eye"></i> View
                                                        Profile</a></li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('clerkstudents.edit', $student->tr_student_id) }}"><i
                                                            class="fa-solid fa-pen"></i> Edit</a></li>
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
