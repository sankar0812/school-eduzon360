@extends('layouts.default')
@section('title', 'School_Visitor')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>School_Visitor</h5>
    <div class="card p-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0"></h6>
            <small class="text-muted float-end">
                <a href="{{ url('/accountsadd') }}" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                   data-bs-target="#exampleModal1" data-bs-whatever="@mdo"> Add Visitor <i
                        class="fa-solid fa-file-circle-plus"></i>
                </a>
            </small>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table " id="example6">
                <thead class="">
                <tr>
                    <th>#</th>
                    <th>Visitor Name</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>inTime</th>
                    <th>outtime</th>
                    <th>Purpose Of Visit</th>
                    <th>visitor type</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach ($visitors as $visitor)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $visitor->visitor_name }}</td>
                        <td>{{ $visitor->phone }}</td>
                        <td>{{ $visitor->date }}</td>
                        <td>{{ $visitor->intime }}</td>
                        @if ($visitor->outtime == null)
                            <td>
                                <button type="button" class="btn btn-danger " style="background-color:white;color:orange;border:2px solid orange;" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal12{{ $visitor->id }}">
                                     OutTime
                                </button>
                            </td>
                        @else
                            <td>{{ $visitor->outtime }}</td>
                        @endif
                        <td>{{ $visitor->purpose }}</td>
                        <td>{{ $visitor->visitor_type }}</td>
                    </tr>
                    <!-- Edit OutTime Modal -->
                    <div class="modal fade" id="exampleModal12{{ $visitor->id }}" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit OutTime</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if (auth()->user()->type == 'admin')
                                        <form action="{{ route('visitor.update') }}" class="row g-3" method="post"
                                              enctype="multipart/form-data">
                                    @elseif (auth()->user()->type == 'frontoffice')
                                        <form action="{{ route('frontofficevisitor.update') }}" class="row g-3"
                                              method="post" enctype="multipart/form-data">
                                    @else
                                        return redirect()->route('home');
                                    @endif
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $visitor->id }}">
                                    <div class="col-md-5">
                                        <label for="" class="form-label">In Time</label>
                                        <!-- Display the visitor's inTime here -->
                                        <input type="time" class="form-control" name="intime" id=""
                                               value="{{ date('H:i', strtotime($visitor->intime)) }}"
                                               autocomplete="off" readonly>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="" class="form-label">OutTime</label>
                                        <!-- Allow editing of OutTime here -->
                                        <input type="time" class="form-control" name="outtime" id="outtime"
                                               placeholder="OutTime" autocomplete="off" required>
                                    </div>
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close
                                        </button> --}}
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Add Visitor Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Visitor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (auth()->user()->type == 'admin')
                        <form action="{{ route('visitor.add') }}" class="row g-3" method="post"
                              enctype="multipart/form-data">
                    @elseif (auth()->user()->type == 'frontoffice')
                        <form action="{{ route('frontofficevisitor.add') }}" class="row g-3" method="post"
                              enctype="multipart/form-data">
                    @else
                        return redirect()->route('home');
                    @endif
                    @csrf
                    <div class="col-md-6">
                        <label for="" class="form-label">Visitor Name</label>
                        <input type="text" class="form-control" name="visitorname" id=""
                               placeholder="Visitor Name" autocomplete="off" required>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" id="" placeholder="Date"
                               autocomplete="off" required>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Intime</label>
                        <input type="time" class="form-control" name="intime" id="" placeholder="Intime"
                               autocomplete="off" required>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">OutTime</label>
                        <input type="time" class="form-control" name="outtime" id="" placeholder="OutTime"
                               autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Phone</label>
                        <input type="number" class="form-control" name="phone" id="" placeholder="Phone"
                               autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">staff Member to Meet</label>
                        <input type="text" class="form-control" name="staff_to_meet" id=""
                               placeholder="staff Member to Meet" autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Visitor Type</label>
                        <input type="text" class="form-control" name="visitor_type" id=""
                               placeholder="Parent ,Guest Speaker..." autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Purpose Of Visit</label>
                        <input type="text" class="form-control" name="purpose" id=""
                               placeholder="meeting, event, parent-teacher conference..." autocomplete="off">
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
