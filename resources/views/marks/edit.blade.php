@extends('layouts.default')
@section('title', 'Mark Edit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    @if (auth()->user()->type == 'admin')
        <form class="" action="{{ route('admin.update', $markshow->markid) }}" method="post"
            enctype="multipart/form-data">
        @elseif (auth()->user()->type == 'staff')
            <form class="" action="{{ route('classteacher.update', $markshow->markid) }}" method="post"
                enctype="multipart/form-data">
            @else
                return redirect()->route('home');
    @endif

    @csrf
    <div class="card mb-4">

        <div class="card-body ">

            <div class="row">
                {{-- <div class="col-md-2">
                    <label for="" class="visually-hidden">Staff</label>
                    <select class="form-select" name="staffid" required>
                        <option value=""  disabled style="display:none;">staff</option>
                        @foreach ($staffslist as $staffslists)
                            <option value="{{ $staffslists->id }}"
                                {{ $markshow->staff_id == $staffslists->id ? 'selected' : '' }} disabled hidden readonly>
                                {{ $staffslists->sf_name }}
                            </option>
                        @endforeach
                    </select>
                    
                
                </div> --}}
                <div class="col-md-3">
                    <label for="" class="visually-hidden">staff</label>
                    <input type="text" class="form-control" value="{{ $markshow->sf_name }}" id=""
                        autocomplete="off" readonly>
                </div>
                <div class="col-md-2">
                    <label for="" class="visually-hidden">Class/Section</label>
                    <input type="text" class="form-control" value="{{ $markshow->c_class }}" id=""
                        autocomplete="off" readonly>
                </div>
                <div class="col-md-2">
                    <label for="" class="visually-hidden">Subject</label>
                    <select class="form-select" name="subjectid" required>
                        <option value="" selected disabled hidden>Subject</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                {{ $markshow->subject_id === "$subject->id" ? 'Selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach

                        {{-- @foreach ($countries as $country)
                                <option value="{{ $country->id, $country->name }}"
                                    {{ $staff->sf_nationality === "$country->id" ? 'Selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach --}}
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="" class="visually-hidden">Exam Type</label>
                    <select id="first-dropdown" class="form-select" name="exam_typeid" required>
                        <option value="" selected disabled hidden>Exam Type</option>
                        @foreach ($exams as $exam)
                            <option
                                value="{{ $exam->id }}"{{ $markshow->examtype_id === "$exam->id" ? 'Selected' : '' }}>
                                {{ $exam->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($markshow->examtype_id == 1)
                        <div id="another-input" class="hiddendat">
                            <label for="second-input">select date:</label>
                            <input type="date" id="second-input" name="exam_date" class="form-control"
                                value="{{ $markshow->exam_date }}">
                        </div>
                    @else
                    @endif

                </div>
                <div class="col-md-2">
                    <label for="" class="visually-hidden">Exam Month</label>
                    <input type="month" class="form-control" name="exam_month" required
                        value="{{ $markshow->exam_month }}">
                </div>
            </div>

        </div>
    </div>

    <hr class="" />
    <h5 class="fw-bold  "><span class="text-muted fw-light"></span>All Student Mark Edit</h5>

    <div class="col-xl">

        <div class="card mb-4">

            <div class="card-body field_wrapper row g-3">
                {{-- <div class="field_wrapper"> --}}
                {{-- <div> --}}
                <div class="table-responsive text-nowrap">
                    <table class="table ">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Student name</th>
                                <th>Exam Mark</th>
                                <th>Internal mark</th>
                                <th>Total mark</th>
                            </tr>
                        </thead>
                        @for ($i = 0; $i < 0; $i++)
                        @endfor
                        <tbody class="table-border-bottom-0">
                            @foreach ($markshow->tableview as $submark)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input type="text" class="form-control" value="{{ $submark->s_name }}"
                                            id="student_{{ $submark->id }}" autocomplete="off" required readonly>
                                        <input type="hidden" class="form-control" value="{{ $submark->id }}"
                                            name="student_id[]" id="student_id_{{ $submark->id }}" autocomplete="off">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="external[]"
                                            id="external_{{ $submark->id }}" placeholder="Enter External Mark"
                                            autocomplete="off" value="{{ $submark->external }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="internal[]"
                                            id="internal_{{ $submark->id }}" placeholder="Enter Internal Mark"
                                            autocomplete="off" value="{{ $submark->internal }}">
                                    </td>

                                    <td>
                                        <input type="text" class="form-control" name="mark[]"
                                            id="total_{{ $submark->id }}" placeholder="Total" autocomplete="off" readonly>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row py-2">
                    <div class="col-md-3">
                        <input type="submit" style="" name="submit" class="btn btn-primary " value="submit">
                        @if (auth()->user()->type == 'admin')
                            <a href="{{ url('admin/marks/show') }}" class="btn btn-dark">Back</a>
                        @elseif (auth()->user()->type == 'staff')
                            <a href="{{ url('marks/show') }}" class="btn btn-dark">Back</a>
                        @else
                            return redirect()->route('home');
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

@endsection


@push('other-scripts')
    <script>
        // Function to calculate the total for a specific row by ID
        function calculateRowTotal(submarkId) {
            var internalValue = parseFloat(document.getElementById('internal_' + submarkId).value) || 0;
            var externalValue = parseFloat(document.getElementById('external_' + submarkId).value) || 0;
            var total = internalValue + externalValue;
            document.getElementById('total_' + submarkId).value = total;
        }

        // Calculate and display the initial row totals for existing rows
        @foreach ($markshow->tableview as $submark)
            var internalValue = parseFloat(document.getElementById('internal_{{ $submark->id }}').value) || 0;
            var externalValue = parseFloat(document.getElementById('external_{{ $submark->id }}').value) || 0;
            var total = internalValue + externalValue;
            document.getElementById('total_{{ $submark->id }}').value = total;
        @endforeach

        // Add an event listener to each internal and external input field
        @foreach ($markshow->tableview as $submark)
            var internalInput_{{ $submark->id }} = document.getElementById('internal_{{ $submark->id }}');
            var externalInput_{{ $submark->id }} = document.getElementById('external_{{ $submark->id }}');

            internalInput_{{ $submark->id }}.addEventListener('input', function() {
                calculateRowTotal({{ $submark->id }});
            });

            externalInput_{{ $submark->id }}.addEventListener('input', function() {
                calculateRowTotal({{ $submark->id }});
            });
        @endforeach
    </script>
@endpush
