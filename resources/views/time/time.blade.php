@extends('layouts.default')
@section('title', 'Times Details')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')

<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Times</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Exam Time</h6>
                    {{-- <small class="text-muted float-end">
                        <a href="" data-bs-toggle="modal" data-bs-target="#schoolinfoadd" data-bs-whatever="@fat"
                            class="btn btn-info btn-sm">Exam Time
                        </a>
                    </small> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table ">
                            <thead class="">
                                <th>section</th>
                                <th>time</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($examtime as $examtimes)
                                    <tr>
                                        <td>{{ $examtimes->et_name }}</td>
                                        <td>{{ $examtimes->time }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                  <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        @if (auth()->user()->type == 'admin')
                                                            <a class="dropdown-item"
                                                                href="{{ url('admin/examtimeedit', $examtimes->id) }}">
                                                                <i class="fa-solid fa-pen"></i> Edit
                                                            </a>
                                                        @elseif (auth()->user()->type == 'clerk')
                                                            <a class="dropdown-item"
                                                                href="{{ url('clerk/examtimeedit', $examtimes->id) }}">
                                                                <i class="fa-solid fa-pen"></i> Edit
                                                            </a>
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
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Daily Time</h6>
                    {{-- <small class="text-muted float-end">
                        <a href="" data-bs-toggle="modal" data-bs-target="#classadd" data-bs-whatever="@fat"
                            class="btn btn-info btn-sm">Class Time
                        </a>
                    </small> --}}

                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table ">
                            <thead class="">
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>section</th>
                                    <th>time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($classtime as $classtimes)
                                    <tr>

                                        <td>{{ $classtimes->classsection }}</td>
                                        <td>{{ $classtimes->classname }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                  <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        @if (auth()->user()->type == 'admin')
                                                            <a class="dropdown-item"
                                                                href="{{ url('admin/classtimeedit', $classtimes->id) }}"><i
                                                                    class="fa-solid fa-pen"></i>
                                                                Edit</a>
                                                        @elseif (auth()->user()->type == 'clerk')
                                                            <a class="dropdown-item"
                                                                href="{{ url('clerk/classtimeedit', $classtimes->id) }}"><i
                                                                    class="fa-solid fa-pen"></i>
                                                                Edit</a>
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
            </div>
        </div>
    </div>


    {{-- Administrative   --}}
    <div class="modal fade" id="schoolinfoadd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Exam Time</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('admin/examtimeadd') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="" class="col-form-label">Section:</label>
                            <select class="form-select" aria-label="Default select example" name="examsection">
                                <option value="FN">FN</option>
                                <option value="AN">AN</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label">Time:</label>
                            <input type="text" class="form-control" id="" name="examname" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="classadd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Class Time</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('admin/classtimeadd') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="" class="col-form-label">Section:</label>
                            <select class="form-select" aria-label="Default select example" name="classsection">
                                <option value="FN">FN</option>
                                <option value="AN">AN</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label">Time:</label>
                            <input type="text" class="form-control" id="" name="classname"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('other-scripts')
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    <script>
        // Initialize CKEditor on the textarea
        CKEDITOR.replace('editor');
        //     CKEDITOR.replace('editor', {
        //     // Configuration options
        //     placeholder: "Start typing here..."
        // });
    </script>
@endpush
