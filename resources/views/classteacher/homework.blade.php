@extends('layouts.default')
@section('title', 'Home Work')
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
                <form action="{{ route('admin.homeworkfilter') }}" method="GET">
                @elseif (auth()->user()->type == 'staff')
                    <form action="{{ route('classteacher.homeworkfilter') }}" method="GET">
                    @else
            @endif

            {{-- @csrf --}}
            <div class="form-group row mb-1">
                <label for="input" class="col-sm-2 col-form-label">Select previous Date</label>
                <div class="col-md-5">
                    <input type="date" class="form-control " name="olddate" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary mt-2 btn-sm"> <i class="bx bx-search fs-5 lh-0"></i>
                        Search</button>
                </div>
            </div>
            </form>
        </div>
    </div>


    <hr class="my-3" />
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Daily Homework</h5>

    <div class="card p-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0"></h6>
            <small class="text-muted float-end"> <a href="{{ url('/accountsadd') }}" class="btn btn-primary btn-sm"
                    data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="@mdo">ADD HOMEWORK
                </a></small>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table" id="example">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>date</th>
                        <th>class</th>
                        <th>subject</th>
                        <th>title</th>
                        <th>File</th>
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                    @for ($i = 0; $i < 0; $i++)
                        @endfor @foreach ($homeworkview as $homeworkviews)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $homeworkviews->hw_date }}</td>
                                <td>{{ $homeworkviews->c_class }}</td>
                                <td>{{ $homeworkviews->name }}</td>
                                <td>{{ $homeworkviews->hw_title }}</td>
                                <td>
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#content{{ $homeworkviews->id }}">
                                        <i class="fa-solid fa-eye" style="color:black"></i> View
                                    </a>
                                    {{-- <div class="dropdown">
                                        <button class="dropdown-toggle drop" id="dropdownMenuButton{{ $contentviews->id }}"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-sharp fa-solid fa-bars"></i>
                                </button>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $contentviews->id }}">
                                    <li>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#content{{ $contentviews->id }}">
                                            <i class="fa-solid fa-eye" style="color:black"></i> View
                                        </a>
                                    </li>
                                </ul>
            </div> --}}
                                </td>
                            </tr>

                            <!-- Modal for each row -->
                            <div class="modal fade" id="content{{ $homeworkviews->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Content</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="{{ url($homeworkviews->hw_content_path) }}" type="application/pdf"
                                                width="100%" height="700px"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- model --}}

    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (auth()->user()->type == 'admin')
                        <form action="{{ url('admin/homeworkadd') }}" method="POST" enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'staff')
                            <form action="{{ url('classteacher/homeworkadd') }}" method="POST"
                                enctype="multipart/form-data">
                            @else
                    @endif

                    @csrf
                    @if (auth()->user()->type == 'admin')
                        <div class="mb-3">
                            <label for="" class="form-label">staff</label>
                            <select class="form-control" name="staffid" required>
                                <option value="" selected disabled hidden>Select Staff</option>
                                @foreach ($stafflist as $stafflists)
                                    <option value="{{ $stafflists->staff_id }}">{{ $stafflists->sf_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class="mb-3">
                            <label for="" class="form-label">staff</label>
                            <select class="form-control" name="staffid" required>
                                {{-- <option value="" selected disabled hidden>Select Staff</option> --}}
                                @foreach ($stafflist as $stafflists)
                                    <option value="{{ $stafflists->staff_id }}">{{ $stafflists->sf_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="" class="form-label">Class</label>
                        <select class="form-control" name="classid" required>
                            <option value="" selected disabled hidden>Select class</option>
                            @foreach ($class as $section)
                                <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Subject</label>
                        <select class="form-control" name="subjectid" required>
                            <option value="" selected disabled hidden>Select subject</option>
                            @foreach ($subject as $subjects)
                                <option value="{{ $subjects->id }}">{{ $subjects->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        {{-- <input type="text" class="form-control" name="title" placeholder="title" autocomplete="off"
                                        required> --}}
                        <textarea type="text" class="form-control" name="title" id="" placeholder="Title"
                            autocomplete="off"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1">Upload Doucment</label>
                        <input type="file" class="form-control" id="" name="content" accept=".pdf"
                            autocomplete="off" required data-bs-backdrop="static" readonly>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary">Submit Form</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
