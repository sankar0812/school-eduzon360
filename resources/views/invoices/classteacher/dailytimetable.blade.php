@extends('layouts.default')
@section('title', 'Daily Timetable')
@section('sidebar')
    @include('include.classteachersidebar')
@endsection
@section('contentdashboard')
    @php
        $classtime = DB::table('dailyclasstimes')
            ->select('classname')
            ->get();
    @endphp

    <div class="row py-2">
        <div class="card p-2">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0"></h6>
                <small class="text-danger float-end">
                    {{ $fyear }}
                </small>
            </div>
            <table class="table table-primary table-bordered table-striped ">
                <thead class="table-dark">
                    @foreach ($timetableView as $requested)
                        <tr>
                            <th colspan="9">
                                <form>
                                    <div class="row">
                                        <div class="col-6 py-2">
                                            <label>{{ $requested->sf_name }}</label>
                                        </div>

                                    </div>
                                </form>
                            </th>

                        </tr>
                        <tr>
                            <th>Date</th>
                            @foreach ($classtime as $classtimes)
                                <th>{{ $classtimes->classname }}</th>
                            @endforeach
                        </tr>
                </thead>
                <tbody>
                    @foreach ($requested->tableview as $subTimetable)
                        <tr>
                            <td>{{ $subTimetable->day_name }}</td>
                            <td>{{ $subTimetable->pre1 }}</td>
                            <td>{{ $subTimetable->pre2 }}</td>
                            <td>{{ $subTimetable->pre3 }}</td>
                            <td>{{ $subTimetable->pre4 }}</td>
                            <td>{{ $subTimetable->pre5 }}</td>
                            <td>{{ $subTimetable->pre6 }}</td>
                            <td>{{ $subTimetable->pre7 }}</td>
                            <td>{{ $subTimetable->pre8 }}</td>
                        </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
