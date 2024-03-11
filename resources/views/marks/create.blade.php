@extends('layouts.default')

@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="card p-2">
        <div class="card-header ">

            @if (auth()->user()->type == 'admin')
                <form class="row g-3" action="{{ route('admin.create') }}" method="post" enctype="multipart/form-data">
                @elseif (auth()->user()->type == 'staff')
                    <form class="row g-3" action="{{ route('classteacher.create') }}" method="post"
                        enctype="multipart/form-data">
                    @else
                        return redirect()->route('home');
            @endif

            @csrf

            <div class="col-md-2">
                <label for="" class="form-label">Class/Section</label>
                <input type="text" class="form-control" value="{{ $classdatas->c_class }}" id=""
                    autocomplete="off" readonly>
                <input type="hidden" class="form-control" name="class_id" value="{{ $classdatas->id }}" id=""
                    autocomplete="off" readonly>
            </div>
            <div class="col-md-3">
                <label for="" class="form-label">Staff</label>
                <select class="form-select" name="staffid">
                    @foreach ($staffs as $staff)
                        <option value="{{ $staff->id }}" selected>
                            {{ $staff->sf_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="" class="form-label">Subject</label>
                <select class="form-select" name="subjectid" required>
                    <option value="" selected disabled hidden>Select Subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="" class="form-label">Exam Type</label>
                <select id="first-dropdown" class="form-select" name="exam_typeid" required>
                    <option value="" selected disabled hidden>Select Exam Type</option>
                    @foreach ($exam_types as $exam)
                        <option value="{{ $exam->id }}">
                            {{ $exam->name }}
                        </option>
                    @endforeach
                    {{-- <option value="DE">Daily Exam</option> --}}
                </select>

                <div id="another-input" class="hiddendate">
                    <label for="second-input">select date:</label>
                    {{-- <input type="date" id="second-input" name="exam_date" class="form-control"> --}}
                    <input type="date" id="automaticDate" name="exam_date" pattern="\d{4}-\d{2}-\d{2}"
                        placeholder="YYYY-MM-DD" class="form-control">
                </div>
            </div>


            <div class="col-md-2">
                <label for="" class="form-label">Exam Month</label>
                <input type="month" class="form-control" name="exam_month" required>
            </div>
          

        </div>
    </div>

    <hr class="" />
    <h5 class="fw-bold  "><span class="text-muted fw-light"></span>All Student Mark Enter</h5>
    <div class="card p-2">
        <h5 class="card-header">
            {{-- <a href="{{ url('classteacher/index') }}" style="float:right" class="btn btn-info">Mark Add</a> --}}
        </h5>
        <div class="col-xl">
            <div class="table-responsive text-nowrap ">
                <table class="table">
                    <thead class="">
                        <tr>
                            <th>Student Name</th>
                            <th>Exam Mark</th>
                            <th>Internal</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>
                                    <input type="text" class="form-control" value="{{ $student->s_name }}"
                                        id="student_{{ $student->id }}" autocomplete="off" readonly>
                                    <input type="hidden" class="form-control" value="{{ $student->id }}"
                                        name="student_id[]" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="external[]"
                                        id="external_{{ $student->id }}" placeholder="Enter Mark" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="internal[]"
                                        id="internal_{{ $student->id }}" placeholder="Enter Mark" autocomplete="off">
                                </td>

                                <td>
                                    <input type="text" class="form-control total" name="mark[]"
                                        id="total_{{ $student->id }}" placeholder="Total" readonly>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-md-3 py-2">
                    <input type="submit" style="" name="submit" class="btn btn-primary " value="submit">
                    @if (auth()->user()->type == 'admin')
                        <a href="{{ url('admin/index') }}" class="btn btn-dark">Back</a>
                    @elseif (auth()->user()->type == 'staff')
                        <a href="{{ url('classteacher/index') }}" class="btn btn-dark">Back</a>
                    @else
                        return redirect()->route('home');
                    @endif

                </div>
            </div>
            </form>
        </div>
    </div>

@endsection
@push('other-scripts')
    <script>
        // Function to calculate the total for a specific row by ID
        function calculateRowTotal(studentId) {
            var internalValue = parseFloat(document.getElementById('internal_' + studentId).value) || 0;
            var externalValue = parseFloat(document.getElementById('external_' + studentId).value) || 0;
            var total = internalValue + externalValue;
            document.getElementById('total_' + studentId).value = total;
        }

        // Add an event listener to each internal and external input field
        var students = @json($students); // Convert the students data to JavaScript array
        students.forEach(function(student) {
            var internalInput = document.getElementById('internal_' + student.id);
            var externalInput = document.getElementById('external_' + student.id);

            internalInput.addEventListener('input', function() {
                calculateRowTotal(student.id);
            });

            externalInput.addEventListener('input', function() {
                calculateRowTotal(student.id);
            });
        });
    </script>
@endpush
