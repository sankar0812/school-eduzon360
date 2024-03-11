@extends('layouts.default')
@section('title', 'Student_Promotion')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    @php
        $class = DB::table('class_sections')
            ->where(['c_status' => 1, 'c_delete' => 1])
            ->get();

        $lastYearRecord = DB::table('classpromotions')
            ->select('cp_year')
            ->orderBy('cp_year', 'desc')
            ->first();
    @endphp
    <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Add Student Promotion</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header"></h5>
                <div class="card-body">
                    @if (auth()->user()->type == 'admin')
                        <form class="row g-3" action="{{ route('admin.promotioninsert') }}" method="POST"
                            enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'clerk')
                            <form class="row g-3" action="{{ route('clerkadmin.promotioninsert') }}" method="POST"
                                enctype="multipart/form-data">
                            @else
                                return redirect()->route('home');
                    @endif
                    @csrf
                    <div class="mb-2">
                        <label for="classSelectid" class="form-label">From class/section</label>
                        <select class="form-control" id="classSelectid" name="fromid" required>
                            <option value="" selected disabled hidden>From class/section</option>
                            @foreach ($studentclass as $classs)
                                <option value="{{ $classs->id }}">{{ $classs->c_class }} ( {{ $classs->acdm_year }} )
                                </option>
                            @endforeach
                        </select>
                        @foreach ($studentclass as $classs)
                            <input type="hidden" value="{{ $classs->acdm_year }}" name="lastyear">
                        @endforeach
                    </div>
                    <!-- <div class="mb-2">
                                                                                                                            <label for="" class="form-label">To class/section</label>
                                                                                                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="newstaff_id[]">

                                                                                                                        </div> -->
                    <div id="student_checkboxes">
                        <input type="checkbox" name="all_students" id="selectAllStudents" class="form-check-input">
                        <label for="" class="form-label text-primary">Select All Student </label>
                    </div>

                    <div class="mb-2">
                        <label for="" class="form-label">To class/section</label>
                        <select class="form-control" name="toid" required>
                            <option value="" selected disabled hidden>To class/section</option>
                            @foreach ($class as $classes)
                                <option value="{{ $classes->id }}">{{ $classes->c_class }}</option>
                            @endforeach
                            <option value="CT">Completed</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#promotionconfirm">
                        promotion
                    </button>
                    <div class="modal fade" id="promotionconfirm" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are You Conform to Promotion </h5>
                                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button> --}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Yes</button>
                                </div>

                            </div>
                        </div>
                    </div>



                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card ">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text-success">{{ $fyear }}</h6>
                    <small class="text-muted  float-end">
                        <h6 class="text-danger">
                            @if (isset($lastYearRecord))
                                {{ $lastYearRecord->cp_year }}
                            @else
                                NO DATE
                            @endif
                            to {{ $fyear }}
                        </h6>
                    </small>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>From Class & Section</th>
                                    <th>To Class & Section</th>
                                    <th>Year</th>
                                    {{-- <th>TOTAL</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 0; $i++)
                                @endfor
                                @foreach ($classPromotions as $promotion)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td> {{ $promotion->from_class }}</td>
                                        <td> {{ $promotion->to_class }}</td>
                                        <td><span class="badge bg-label-success me-1">{{ $promotion->cp_year }}</span></td>
                                        {{-- <td>{{ $count }}</td> --}}
                                        <td>
                                            @if (auth()->user()->type == 'admin')
                                                <form action="{{ route('admin.promotiondelete') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                @elseif (auth()->user()->type == 'clerk')
                                                    <form action="{{ route('clerkadmin.promotiondelete') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                    @else
                                                        return redirect()->route('home');
                                            @endif
                                            @csrf
                                            <input type="hidden" name="promotionid" value="{{ $promotion->promid }}">
                                            <input type="hidden" name="froms" value="{{ $promotion->cp_from }}">
                                            <input type="hidden" name="tos" value="{{ $promotion->cp_to }}">
                                            <input type="hidden" name="lastyear" value="{{ $promotion->cp_lastyear }}">
                                            <input type="hidden" name="acdyear" value="{{ $promotion->cp_year }}">

                                            <button type="type" class="btn btn-danger btn-sm">Reset</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                @foreach ($promotionct as $promotioncts)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td> {{ $promotioncts->from_class }}</td>
                                        <td>{{ $promotioncts->cp_to }}</td>
                                        <td><span class="badge bg-label-success me-1">{{ $promotioncts->cp_year }}</span>
                                        </td>
                                        <td>
                                            @if (auth()->user()->type == 'admin')
                                                <form action="{{ route('admin.promotiondelete') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                @elseif (auth()->user()->type == 'clerk')
                                                    <form action="{{ route('clerkadmin.promotiondelete') }}"
                                                        method="POST" enctype="multipart/form-data">
                                                    @else
                                                        return redirect()->route('home');
                                            @endif
                                            @csrf
                                            <input type="hidden" name="promotionid" value="{{ $promotioncts->promid }}">
                                            <input type="hidden" name="froms" value="{{ $promotioncts->cp_from }}">
                                            <input type="hidden" name="tos" value="{{ $promotioncts->cp_to }}">
                                            <input type="hidden" name="lastyear" value="{{ $promotioncts->cp_lastyear }}">
                                            <input type="hidden" name="acdyear" value="{{ $promotioncts->cp_year }}">

                                            <button type="type" class="btn btn-danger btn-sm">Reset</button>
                                            </form>
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

    </div>
@endsection
@push('other-scripts')
    <script>
        $(document).ready(function() {
            $('#classSelectid').change(function() {
                var class_id = $(this).val();

                // Make an AJAX request to fetch students based on the selected class
                $.ajax({
                    url: "{{ url('get-student-by-class-for-fees') }}",
                    type: "POST",
                    data: {
                        class_id: class_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Clear previous options
                        $('#student_checkboxes').empty();

                        // Populate students based on the response
                        $('#student_checkboxes').append(
                            '<input type="checkbox" name="all_students" id="selectAllStudents" checked class="form-check-input">' +
                            '' +
                            '<label for="selectAllStudents" class="form-label text-primary">Select All Student </label>'
                        );

                        $.each(response.students, function(index, student) {
                            var checkbox = '<div class="form-check">' +
                                '<input class="form-check-input student-checkbox" type="checkbox" checked name="student_ids[]" value="' +
                                student.id + '" id="student_' + student.id + '">' +
                                '<label class="form-check-label " for="student_' +
                                student.id + '">' + student.s_name + ' ' + ' ( ' +
                                student
                                .s_admissionno + ' ) ' + '</label>' +
                                '</div>';
                            $('#student_checkboxes').append(checkbox);
                        });

                        // Add event listener for "All Student" checkbox
                        $('#selectAllStudents').change(function() {
                            $('.student-checkbox').prop('checked', $(this).prop(
                                'checked'));
                        });

                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>
@endpush
