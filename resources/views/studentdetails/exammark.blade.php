@extends('layouts.studentapp')
@section('title', 'Exam Mark')
@section('studentdashboard')
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
            </div>
            <div class="card-body">
                <form class="" action="{{ route('student.exammarkfilter') }}" method="GET">
                    <div class="form-group row mb-1">
                        <label for="" class="col-sm-2 col-form-label">Select</label>
                        <div class="col-md-3">
                            <select id="first-dropdown" class="form-select " aria-label="Default select example"
                                name="examid" required>
                                <option value="" selected disabled hidden>Select Exam Type</option>
                                @foreach ($examtype as $examtypes)
                                    <option value="{{ $examtypes->id }}">{{ $examtypes->name }}</option>
                                @endforeach
                            </select>
                            <div id="another-input" class="hiddendate">
                                <label for="second-input">select date:</label>
                                {{-- <input type="date" id="second-input" name="examdate" class="form-control"> --}}
                                <input type="date" id="automaticDate" name="examdate" pattern="\d{4}-\d{2}-\d{2}"
                                    placeholder="YYYY-MM-DD" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select " aria-label="Default select example" name="classid">
                                @foreach ($class as $section)
                                    <option value="{{ $section->id }}" {{ $clid == $section->id ? 'selected' : '' }}>
                                        {{ $section->c_class }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="month" name="monthid" id="" class="form-control ">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-3 py-2">
                            <button type="submit" class="btn btn-primary mb-4 btn-sm">Apply filter <i
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
                <h6 class="mb-0">Exam Result</h6>
                @foreach ($markshow as $mark)
                    <small class="text-danger float-end">
                        {{ $mark->exam_year }}
                    </small>
                @endforeach
            </div>
            <table class="table table-primary table-bordered table-striped ">
                <thead class="table-dark">
                    @foreach ($markshow as $mark)
                        <tr>
                            <th colspan="5">
                                <form>
                                    <div class="row">
                                        <div class="col-6 py-2">
                                            <label>EXAM TYPE : {{ $mark->name }}</label>
                                        </div>
                                        <div class="col-6 py-2">
                                            <label>NAME : {{ $stname }}</label>
                                        </div>
                                        <div class="col-6 py-2">
                                            <label>CLASS - SECTION : {{ $mark->c_class }}</label>
                                        </div>
                                        <div class="col-6 py-2">
                                            <label>EXAM MONTH :
                                                <input type="month" name="" id=""
                                                    value="{{ $mark->exam_month }}" readonly>
                                            </label>
                                        </div>
                                        <div class="col-6 py-2">
                                            <label>EXAM DATE :
                                                <input type="date" name="" id=""
                                                    value="{{ $mark->exam_date }}" readonly>
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </th>

                        </tr>
                        <tr>
                            <th> Subject</th><br>
                            <th> Exam Mark </th>
                            <th> Internal Mark</th>
                            <th> Total </th>
                            <th> Result </th>
                        </tr>
                </thead>
                <tbody>
                    @foreach ($mark->tableview as $entry)
                        <tr>
                            <td>{{ $entry->name }}</td>
                            <td>{{ $entry->external }}</td>
                            <td>{{ $entry->internal }}</td>
                            <td>{{ $entry->mark }}</td>
                            <td>
                                @if ($entry->mark > 35)
                                    <h6 class="text-success">P</h6>
                                @elseif ($entry->mark == 0)
                                    <h6 class="text-dark">AA</h6>
                                @elseif ($entry->mark == null)
                                    <h6 class="text-dark">AA</h6>
                                @else
                                    <h6 class="text-danger">F</h6>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
                @endforeach



            </table>
            <span>
                @foreach ($markshow as $mark)
                    <b> AAA-Absent | P-PASS | F-FAIL | ({{ $mark->exam_year }})</b>
                @endforeach
            </span>
        </div>
    </div>
@endsection
