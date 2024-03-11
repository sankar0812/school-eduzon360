{{-- @extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>ADD</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('students.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($students as $student)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $student->s_name }}</td>
            <td>{{ $student->s_email }}</td>
            <td>
                <form action="{{ route('students.destroy',$student->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('students.show',$student->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $students->links() !!}

@endsection --}}

@extends('layouts.default')
@section('title', 'Student_detailslist')
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
                <form action="{{ route('classteacher.studentclassfilter') }}" method="GET">
                    {{-- @csrf --}}
                    <div class="form-group row mb-1">
                        <label for="input" class="col-sm-2 col-form-label">Select Class</label>
                        <div class="col-md-5">
                            <select class="form-control " name="class">
                                <option value="" selected disabled hidden>Select class</option>
                                @foreach ($class as $section)
                                    <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary mt-2 btn-sm"><i class="bx bx-search fs-5 lh-0 "></i> Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <hr class="my-3" />
        <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Take Attendance </h5>

        <div class="card p-2">
            <div class="table-responsive text-nowrap py-2">
                <div class="table-responsive text-nowrap ">
                    <table class="table" id="example">
                        <thead class="">
                            <tr>
                                <th>Sl.No</th>
                                <th>NAME</th>
                                <th>CLASS</th>
                                <th>login</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        @for ($i = 0; $i <0; $i++)
                        @endfor
                        <tbody class="table-border-bottom-0">
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $student->s_name }}</td>
                                    <td>{{ $student->cname }}</td>
                                    <td>
                                        @if ($student->s_loginstatus == 1)
                                            <a href="{{ url('classteacher/status', $student->id) }}"><span
                                                    class="badge bg-label-success me-1">active</span></a>
                                        @else
                                            <a href="{{ url('classteacher/status', $student->id) }}"><span
                                                    class="badge bg-label-danger me-1">Deactive</span></a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                              <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item"
                                                        href="{{ url('classteacher/studentdetailsview', $student->id) }}"><i
                                                            class="fa-solid fa-eye"></i> View
                                                        Profile</a></li>
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
