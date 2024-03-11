@extends('layouts.default')
@section('title', 'mark Show')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')

    <div class="card p-2">
        <div class="card-header ">

            @if (auth()->user()->type == 'admin')
                <form class="row g-3" action="{{ route('admin.marks.show') }}" method="get" enctype="multipart/form-data">
                @elseif (auth()->user()->type == 'staff')
                    <form class="row g-3" action="{{ route('marks.show') }}" method="get" enctype="multipart/form-data">
                    @else
                        return redirect()->route('home');
            @endif
            <div class="col-md-2">
                <label for="" class="visually-hidden">year</label>
                <select class="form-select" name="staffid" required>
                    <option value="" selected disabled hidden>Select Staff</option>
                    @foreach ($staffslist as $staffslists)
                        <option value="{{ $staffslists->id }}">
                            {{ $staffslists->sf_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="" class="visually-hidden">year</label>
                <select class="form-select" name="subjectid" required>
                    <option value="" selected disabled hidden>Select Subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="" class="visually-hidden">Select year</label>
                <select class="form-select" name="adyear" required>
                    <option value="" selected disabled hidden>Select Year</option>
                    @if ($Adyear)
                        @foreach ($Adyear as $Adyear)
                            <option value="{{ $Adyear->exam_year }}">
                                {{ $Adyear->exam_year }}
                            </option>
                        @endforeach
                    @else
                        <option value="" selected disabled hidden>Select Year</option>
                    @endif

                </select>
            </div>
            <div class="col-md-2">
                <label for="" class="visually-hidden">Select Class</label>
                <select class="form-select" name="classid" required>
                    <option value="" selected disabled hidden>Select Class</option>
                    @foreach ($classs as $class)
                        <option value="{{ $class->id }}">
                            {{ $class->c_class }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="" class="visually-hidden">Select Exam_Type</label>
                <select id="first-dropdown" class="form-select" name="examid" required>
                    <option value="" selected disabled hidden>Select Exam_Type</option>
                    @foreach ($exams as $exam)
                        <option value="{{ $exam->id }}">
                            {{ $exam->name }}
                        </option>
                    @endforeach
                </select>
                <div id="another-input" class="hiddendate">
                    <label for="second-input">select date:</label>
                    {{-- <input type="date" id="second-input" name="exam_date" class="form-control"> --}}
                    <input type="date" id="automaticDate" name="exam_date" pattern="\d{4}-\d{2}-\d{2}"
                        placeholder="YYYY-MM-DD" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary mb-3"> <i class="bx bx-search fs-5 lh-0"></i> Search</button>
            </div>
            </form>
        </div>
    </div>
    <hr class="" />
    <h5 class="fw-bold  "><span class="text-muted fw-light"></span>All Student Mark view</h5>
    @for ($i = 0; $i < 0; $i++)
    @endfor
    @if (!empty($markshow))

        <div class="card p-2">
       
            <div class="col-xl">
                <div class="table-responsive text-nowrap">
                    <table class="table p-2">
                        @foreach ($markshow as $markentry)
                            <thead class="">
                                <tr>
                                    <th colspan="5">
                                        <form>
                                            <div class="row">
                                                <div class="col-6 py-2">
                                                    <label>SUBJECT : {{ $markentry->subname }}</label>
                                                </div>
                                                <div class="col-6 py-2">
                                                    <label>CLASS : {{ $markentry->c_class }}</label>
                                                </div>
                                                <div class="col-6 py-2">
                                                    <label>EXAM TYPE : {{ $markentry->exaname }}</label>

                                                </div>
                                                <div class="col-6 py-2">
                                                    <label>Academic YEAR : {{ $markentry->exam_year }}</label>
                                                </div>

                                                <div class="col-6 py-2">
                                                    <label>Exam Month : <input type="month"
                                                            value="{{ $markentry->exam_month }}" readonly></label>
                                                </div>
                                                <div class="col-6 py-2">
                                                    <label>Exam Date : <input type="date"
                                                            value="{{ $markentry->exam_date }}" readonly></label>
                                                </div>

                                            </div>
                                        </form>
                                    </th>

                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Student name</th>
                                    <th>Exam mark</th>
                                    <th>internal mark</th>
                                    <th>Total mark</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($markentry->tableview as $submark)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $submark->s_name }}</td>
                                        <td>{{ $submark->external }}</td>
                                        <td>{{ $submark->internal }}</td>
                                        <td>{{ $submark->mark }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endforeach
                    </table>

                    @if (auth()->user()->type == 'admin')
                        @foreach ($markshow as $markentry)
                            @if ($markentry->examtype_id == '1')
                                <div class="py-2">
                                    <a href="{{ url('admin/dailyexam/edit', $markentry->markid) }}"
                                        class="btn btn-secondary">EDIT</a>
                                </div>
                            @else
                                <div class="py-2">
                                    <a href="{{ url('admin/edit', $markentry->markid) }}"
                                        class="btn btn-secondary">EDIT</a>
                                </div>
                            @endif
                        @endforeach
                    @elseif (auth()->user()->type == 'staff')
                        @foreach ($markshow as $markentry)
                            @if ($markentry->examtype_id == '1')
                                <div class="py-2">
                                    <a href="{{ url('dailyexam/edit', $markentry->markid) }}"
                                        class="btn btn-secondary">EDIT</a>
                                </div>
                            @else
                                <div class="py-2">
                                    <a href="{{ url('classteacher/edit', $markentry->markid) }}"
                                        class="btn btn-secondary">EDIT</a>
                                </div>
                            @endif
                        @endforeach
                    @else
                        return redirect()->route('home');
                    @endif





                </div>
            </div>
        </div>
    @else
        <p>No mark entries found.</p>
    @endif
@endsection
