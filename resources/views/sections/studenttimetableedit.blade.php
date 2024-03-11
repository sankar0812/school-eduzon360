@extends('layouts.default')
@section('title', 'Student_Timetable Edit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Edit Student Timetable</h5>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"></h5>
                </div>
                <div class="card-body">
                    @php
                        $class = DB::table('class_sections')
                            ->where(['c_status' => 1, 'c_delete' => 1])
                            ->get();
                        $classtime = DB::table('dailyclasstimes')
                            ->select('classname')
                            ->get();
                    @endphp

                    @foreach ($timetableView as $requested)
                        @if (!empty($requested->tableview))
                            @if (auth()->user()->type == 'admin')
                                <form method="POST" action="{{ route('admin.classtimetableupdate', $requested->id) }}"
                                    enctype="multipart/form-data">
                                @elseif (auth()->user()->type == 'clerk')
                                    <form method="POST"
                                        action="{{ route('clerkadmin.classtimetableupdate', $requested->id) }}"
                                        enctype="multipart/form-data">
                                    @else
                                        return redirect()->route('home');
                            @endif



                            @csrf
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Class_Section</label>
                                <div class="col-sm-6">
                                    <div class="input-group ">
                                        <select class="form-select" aria-label="Default select example"
                                            name="classid">
                                            {{-- <option value="{{ $requested->class_id }}">{{ $requested->c_class }}
                                            </option>
                                            <option></option> --}}
                                            @foreach ($class as $section)
                                                <option value="{{ $section->id }}"{{ $requested->class_id === "$section->id" ? 'Selected' : '' }}>{{ $section->c_class }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered ">
                                    <thead class="">
                                        <tr>
                                            <th>Date</th>
                                            @foreach ($classtime as $classtimes)
                                                <th>{{ $classtimes->classname }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    @foreach ($requested->tableview as $subTimetable)
                                        <tr>
                                            <th class="text-dark">{{ $subTimetable->day_name }}</th>
                                            <th><input type="text" value="{{ $subTimetable->pre1 }}" name="pre1[]"
                                                    style="border:none;" autocomplete="off"></th>
                                            <th><input type="text" value="{{ $subTimetable->pre2 }}" name="pre2[]"
                                                    style="border:none;" autocomplete="off"></th>
                                            <th><input type="text" value="{{ $subTimetable->pre3 }}" name="pre3[]"
                                                    style="border:none;" autocomplete="off"></th>
                                            <th><input type="text" value="{{ $subTimetable->pre4 }}" name="pre4[]"
                                                    style="border:none;" autocomplete="off"></th>
                                            <th><input type="text" value="{{ $subTimetable->pre5 }}" name="pre5[]"
                                                    style="border:none;" autocomplete="off"></th>
                                            <th><input type="text" value="{{ $subTimetable->pre6 }}" name="pre6[]"
                                                    style="border:none;" autocomplete="off"></th>
                                            <th><input type="text" value="{{ $subTimetable->pre7 }}" name="pre7[]"
                                                    style="border:none;" autocomplete="off"></th>
                                            <th><input type="text" value="{{ $subTimetable->pre8 }}" name="pre8[]"
                                                    style="border:none;" autocomplete="off"></th>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>


                            <div class="col-12 py-2">
                                <button type="submit" class="btn btn-primary">Submit Form</button>

                                @if (auth()->user()->type == 'admin')
                                    <a href="{{ url('admin/studenttimetable') }}" class="btn btn-dark">Back</a>
                                @elseif (auth()->user()->type == 'clerk')
                                    <a href="{{ url('clerk/studenttimetable') }}" class="btn btn-dark">Back</a>
                                @else
                                    return redirect()->route('home');
                                @endif

                            </div>
                            </form>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

    </div>


@endsection
