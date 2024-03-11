@extends('layouts.default')
@section('title', 'Administrative Details')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')

<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Add Administrative </h5>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"></h6>
                    <small class="text-muted float-end">
                        {{-- <a href="" data-bs-toggle="modal" data-bs-target="#schoolinfoadd"
                            data-bs-whatever="@fat" class="btn btn-info btn-sm">Add School Information
                        </a> --}}
                        school Details
                    </small>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead class="">
                                <tr>

                                    <th>Image</th>
                                    <th>Name</th>
                                    {{-- <th>DesigAboutnation</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                {{-- @foreach ($profilelist as $profilelists) --}}
                                <tr>
                                    @if ($schoolinfo == '')
                                        <td></td>
                                        {{-- <td></td> --}}
                                        <td></td>
                                    @else
                                        <td><img src="{{ asset($schoolinfo->logo_path) }}" class="" alt=""
                                                width="50px" height="50px"></td>
                                        <td>{{ $schoolinfo->name }}</td>
                                        {{-- <td>{{ strip_tags($schoolinfo->about) }}</td> --}}



                                        {{-- // $content = '<p>This is some content with paragraphs.</p>';
// $contentWithoutTags = strip_tags($content);
// echo $contentWithoutTags; // Output: This is some content with paragraphs. --}}

                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                  <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item"
                                                            href="{{ url('admin/schoolinfoedit', $schoolinfo->id) }}"><i
                                                                class="fa-solid fa-pen"></i> Edit</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"></h6>
                    <small class="text-muted float-end"><a href="" data-bs-toggle="modal"
                            data-bs-target="#profileadd" data-bs-whatever="@fat" class="btn btn-primary btn-sm">Add
                          
                        </a></small>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead class="">
                                <tr>

                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($profilelist as $profilelists)
                                    <tr>

                                        <td><img src="{{ asset('myimage/administrative/' . $profilelists->Pr_image) }}"
                                                class="" alt="" width="50px" height="50px"></td>
                                        <td>{{ $profilelists->Pr_name }}</td>
                                        <td>{{ $profilelists->Pr_designation }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                  <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item"
                                                            href="{{ url('admin/administrativeedit', $profilelists->id) }}"><i
                                                                class="fa-solid fa-pen"></i> Edit</a></li>
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
    <div class="modal fade" id="schoolinfoadd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">School Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.schollinfo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">


                        <div class="mb-3">
                            <label for="" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="" name="name" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label">Address:</label>
                            <input type="text" class="form-control" id="" name="address" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label">Reg.No:</label>
                            <input type="text" class="form-control" id="" name="regno"
                                autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label">About:</label>
                            {{-- <input type="text" class="form-control" id="" name="designation"
                                autocomplete="off"> --}}
                            <textarea name="about" id="editor" placeholder="Describe yourself here..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label">Logo:</label>
                            <input type="file" class="form-control" id="" name="logo"
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
    <div class="modal fade" id="profileadd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.adminitrative') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="" class="col-form-label">Image:</label>
                            <input type="file" class="form-control" id="" name="image"
                                autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="" name="name"
                                autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label">Designation:</label>
                            <input type="text" class="form-control" id="" name="designation"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
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
