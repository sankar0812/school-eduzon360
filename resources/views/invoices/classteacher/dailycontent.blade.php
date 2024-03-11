@extends('layouts.default')
@section('title', 'daily_content')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
        Logins</a></small> --}}
            </div>
            <div class="card-body">
                <form action="{{ route('classteacher.dailycontentfilter') }}" method="GET">
                    {{-- @csrf --}}
                    <div class="form-group row mb-1">
                        <label for="input" class="col-sm-2 col-form-label">Select Date</label>
                        <div class="col-md-5">
                            <input type="date" class="form-control form-control-sm" name="olddate" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary mb-4 btn-sm">Apply Filter <i
                                    class="fa-solid fa-location-arrow"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row py-2">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                <small class="text-muted float-end"> <a href="{{ url('/accountsadd') }}" class="btn btn-info btn-sm"
                        data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="@mdo">ADD CONTENT
                    </a></small>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table  table-striped table-hover  border-dark">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>date</th>
                            <th>class</th>
                            <th>subject</th>
                            <th>title</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>

                    <tbody class="table-border-bottom-0">
                        @for ($i = 0; $i < 0; $i++)
                        @endfor
                        @foreach ($contentview as $contentviews)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $contentviews->date }}</td>
                                <td>{{ $contentviews->c_class }}</td>
                                <td>{{ $contentviews->name }}</td>
                                <td>{{ $contentviews->title }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class=" dropdown-toggle drop " id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-sharp fa-solid fa-bars"></i>
                                        </button>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item"
                                                    href="{{ url('classteacher/dailycontentview', $contentviews->id) }}"><i
                                                        class="fa-solid fa-eye"></i> View
                                                    </a></li>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
                    <form action="{{ url('classteacher/dailycontentadd') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id="" placeholder="date"
                                autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">class</label>
                            <select class="form-control" name="classid" required>
                                <option value="" selected disabled hidden>Select class</option>
                                @foreach ($class as $section)
                                    <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label"></label>
                            <select class="form-control" name="subjectid">
                                <option value="" selected disabled hidden>Select </option>
                                @foreach ($subject as $subjects)
                                    <option value="{{ $subjects->id }}">{{ $subjects->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="title" autocomplete="off"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1">content</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit Form</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
