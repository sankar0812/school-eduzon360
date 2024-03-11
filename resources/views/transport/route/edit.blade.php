@extends('layouts.default')
@section('title', 'Student Details')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')

<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Edit Student</h5>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Profile info</h5>
                    {{-- <small class="text-muted float-end">Profile Details</small> --}}
                </div>
                <div class="card-body">

                    {{-- message alert --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (auth()->user()->type == 'admin')
                        <form class="row g-3" action="{{ route('students.update', $student->id) }}" method="POST"
                            enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'clerk')
                            <form class="row g-3" action="{{ route('clerkstudents.update', $student->id) }}" method="POST"
                                enctype="multipart/form-data">
                            @else
                                return redirect()->route('home');
                    @endif


                    @csrf
                    @method('PUT')
                    @csrf
                    <div class="col-md-2">
                        <label for="" class="form-label">Admission No</label>
                        <input type="text" class="form-control" name="s_admissionno" id=""
                            value="{{ $student->s_admissionno }}" placeholder="Admission No" autocomplete="off" readonly>
                        <input type="hidden" class="form-control" name="s_id" id=""
                            value="{{ $student->id }}">
                    </div>
                    <div class="col-md-2">
                        <label for="" class="form-label">Roll No</label>
                        <input type="number" class="form-control" name="s_rollno" id=""
                            value="{{ $student->s_rollno }}" placeholder="Roll No" autocomplete="off">
                        <input type="hidden" class="form-control" name="s_id" id=""
                            value="{{ $student->id }}">
                    </div>
                    {{-- <div class="col-md-6">
                        <label for="" class="form-label">Student Name</label>
                        <input type="text" class="form-control" name="s_name" value="{{ $student->s_name }}"
                            id="" placeholder="Full Name" required>
                    </div> --}}
                    <div class="col-md-4">
                        <label for="" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="s_firstname" id=""
                            value="{{ $student->s_firstname }}" placeholder="First Name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="s_lastname" id=""
                            value="{{ $student->s_lastname }}" placeholder="Last Name">
                    </div>

                    <div class="col-md-3">
                        <label for="" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="s_dob" value="{{ $student->s_dob }}"
                            id="" placeholder="Full Name" max="<?php echo date('Y-m-d', strtotime('-1 year')); ?>" autocomplete="off" required>
                    </div>

                    <div class="col-md-3">
                        <label for="" class="form-label">Gender</label>
                        <select id="" name="s_gender" class="form-select" value="{{ $student->s_gender }}"
                            autocomplete="off" required>
                            <option value="" selected disabled hidden>Select Gender</option>
                            <option value="male" {{ $student->s_gender === 'male' ? 'Selected' : '' }}>male</option>
                            <option value="female" {{ $student->s_gender === 'female' ? 'Selected' : '' }}>female
                            </option>
                            <option value="other"{{ $student->s_gender === 'other' ? 'Selected' : '' }}>other
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Email</label>
                        <input type="email" class="form-control" name="s_email" value="{{ $student->s_email }}"
                            id="" placeholder="Email" autocomplete="off">
                    </div>

                    {{-- <div class="col-md-6">
                        <label for="" class="form-label">Student Aadhar No</label>
                        <input type="text" class="form-control" name="s_aadharno" value="{{ $student->s_aadharno }}"
                            id="" placeholder="Full Name" autocomplete="off" required>
                    </div> --}}

                    <div class="col-6">
                        <label for="" class="form-label">Permanent Address</label>
                        {{-- <input type="text" class="form-control" id=""
                            value="{{ $student->s_permanentaddress }}" name="s_permanentaddress" placeholder="Address"
                            autocomplete="off" required> --}}
                        <textarea type="text" class="form-control" name="s_permanentaddress" id=""
                            placeholder="Permanent Address" autocomplete="off" required>{{ $student->s_permanentaddress }}</textarea>
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">Present Address</label>
                        {{-- <input type="text" class="form-control" id=""
                            value="{{ $student->s_presentaddress }}" name="s_presentaddress"
                            placeholder="Apartment or floor" autocomplete="off"> --}}
                        <textarea type="text" class="form-control" name="s_presentaddress" id="" placeholder="Present Address"
                            autocomplete="off">{{ $student->s_presentaddress }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Nationality</label>
                        <select class="form-select" id="country-dropdown" name="s_nationality">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id, $country->name }}"
                                    {{ $student->s_nationality === "$country->id" ? 'Selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">State</label>
                        <input type="hidden" class="form-control" value="{{ $student->s_state }}" id="sstate">
                        <select class="form-select" id="state-dropdown" value="{{ $student->s_state }}" name="s_state">
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Father Name / Guardian Name</label>
                        <input type="text" class="form-control" id="" value="{{ $student->s_fathername }}"
                            name="s_fathername" placeholder="Father Name" autocomplete="off" required>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Father / Guardian Occupation</label>
                        <input type="text" class="form-control" id=""
                            value="{{ $student->s_fatheroccupation }}" name="s_fatheroccupation"
                            placeholder="Father Occupation" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Mother Name</label>
                        <input type="text" class="form-control" value="{{ $student->s_mothername }}" id=""
                            name="s_mothername" placeholder="Mother Name" autocomplete="off">

                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Mother Occupation</label>
                        <input type="text" name="s_motheroccupation" class="form-control" id=""
                            value="{{ $student->s_motheroccupation }}" autocomplete="off"
                            placeholder="Mother Occupation">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Parent Phone No</label>
                        <input type="number" class="form-control" name="s_phone" id=""
                            value="{{ $student->s_phone }}" placeholder="Phone Number" autocomplete="off" required>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Disabled Person</label>
                        <select id="" name="s_disabledperson" class="form-select" autocomplete="off"
                            value="{{ $student->s_disabledperson }}">
                            <option value="" selected disabled hidden>select </option>
                            <option value="no" {{ $student->s_disabledperson === 'no' ? 'Selected' : '' }}>No
                            </option>
                            <option value="yes" {{ $student->s_disabledperson === 'yes' ? 'Selected' : '' }}>Yes
                            </option>


                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label"> Route</label>
                        <select class="form-control" aria-label="Default select example" name="route">
                            <option value="" selected disabled hidden>Select Route</option>
                            @foreach ($assignvehicles as $assign)
                                <option value="{{ $assign->route_id }}"
                                    {{ $assign->route_id === $student->s_vanid ? 'Selected' : '' }}>{{ $assign->route }}
                                </option>
                            @endforeach
                            <option value=""></option>
                        </select>
                    </div>
                    <!-- <div class="col-md-3">
                                                                            <label for="" class="form-label">Awards</label>
                                                                            <input type="text" class="form-control" id="" name="awards"
                                                                                placeholder="Awards" autocomplete="off" required>
                                                                        </div> -->


                    <div class="col-md-3">
                        <label for="" class="form-label">Religion</label>
                        <input type="text" class="form-control" name="s_religion" value="{{ $student->s_religion }}"
                            id="" placeholder="Religion" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Blood Group</label>

                        <select class="form-select" id="" name="s_bloodgroup">
                            <option value="" selected disabled hidden>Select blood</option>
                            @foreach ($bloods as $blood)
                                <option value="{{ $blood->name }}"
                                    {{ $student->s_bloodgroup === "$blood->name" ? 'Selected' : '' }}>
                                    {{ $blood->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Admission Date</label>
                        <input type="date" name="s_admissiondate" class="form-control" id=""
                            value="{{ $student->s_admissiondate }}" autocomplete="off" required>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label"> Class</label>
                        @php
                            $class = DB::table('class_sections')
                                ->where(['c_status' => 1, 'c_delete' => 1])
                                ->get();
                        @endphp

                        <select class="form-control" name="class" required>
                            <option value="" selected disabled hidden>Select Class</option>
                            @foreach ($class as $section)
                                {{-- <option value="{{ $section->id }}">{{ $section->c_class }}</option> --}}
                                <option value="{{ $section->id }}"
                                    {{ $student->s_classid === "$section->id" ? 'Selected' : '' }}>
                                    {{ $section->c_class }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Profile Image</label>
                        <input type="hidden" name="s_profileold" value="{{ $student->s_profile }}">
                        <input type="hidden" name="image_pathold" value="{{ $student->image_path }}">
                        <input type="file" name="s_profile" accept="image/png, image/jpeg ,image/jpg" value=""
                            class="form-control" id="" autocomplete="off">
                        <img src="{{ asset($student->image_path) }}" width="150px" height="100px" class="square">
                    </div>

                    <div class="col-md-3">
                        <label for="" class="form-label">Certificate Pdf</label>
                        <input type="hidden" class="form-control" id="" name="s_certificateold"
                            value="{{ $student->s_certificate }}" autocomplete="off">
                        <input type="hidden" name="file_pathold" value="{{ $student->file_path }}"
                            class="form-control" id="" autocomplete="off">
                        <input type="file" name="s_certificate" accept=".pdf" class="form-control" id=""
                            autocomplete="off">
                        <embed src="{{ asset($student->file_path) }}" width="150px" height="100px" class="square">
                    </div>
                    {{-- <div class="col-md-3">
                <label for="" class="form-label">class section</label>
                <input type="text" name="classsection" class="form-control" id=""
                    placeholder="class section" autocomplete="off" required>
            </div> --}}

                    <!-- <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Student Fees</h5>
                        <small class="text-muted float-end">Fees Details</small>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Admission Fees</label>
                        <input type="text" class="form-control" name="admission" id="admission"
                            {{-- placeholder="Admission Fees" value="{{ $fee->admission }}" autocomplete="off" required> --}}
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Term1 Fees</label>
                        <input type="text" class="form-control" name="term1" id="term1"
                            {{-- placeholder="Term1 Fees" value="{{ $fee->term1 }}" autocomplete="off" required> --}}
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Term2 Fees</label>
                        <input type="text" class="form-control" name="term2" id="term2"
                            {{-- placeholder="Term2 Fees" value="{{ $fee->term2 }}" autocomplete="off" required> --}}
                    </div>

                    <div class="col-md-4">
                        <label for="" class="form-label">Term3 Fees</label>
                        <input type="text" class="form-control" name="term3" id="term3"
                            {{-- placeholder="Term3 Fees" value="{{ $fee->term3 }}" autocomplete="off" required> --}}
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Extra Curricular Activity</label>
                        <input type="text" class="form-control" name="extra" id="extra"
                            {{-- placeholder="Extra Curricular Activity" value="{{ $fee->extra }}" autocomplete="off" --}}
                            required>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Book Fees</label>
                        <input type="text" class="form-control" name="book" id="book"
                            {{-- placeholder="Book Fees" value="{{ $fee->books }}" autocomplete="off" required> --}}
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Uniform</label>
                        <input type="text" class="form-control" name="uniform" id="uniform" placeholder="Uniform"
                            {{-- value="{{ $fee->uniform }}" autocomplete="off" required> --}}
                    </div>

                    <div class="col-md-4">
                        <label for="" class="form-label">Fine</label>
                        <input type="text" class="form-control" name="fine" id="fine" placeholder="Fine"
                            {{-- value="{{ $fee->fine }}" autocomplete="off" required> --}}
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Fine Reason</label>
                        <textarea type="text" class="form-control" name="fine_reason" id="" placeholder="Fine Reason"
                            {{-- autocomplete="off" required>{{ $fee->fine_reas6on }}</textarea> --}}
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Total Fees</label>
                        <input type="text" class="form-control" name="totalfees" onclick="add()" id="totalfees"
                            placeholder="Total Fees" autocomplete="off" required>
                    </div> -->
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                        <!-- <i class="fa-solid fa-arrow-up-from-bracket fa-xl"> </i>  -->


                        @if (auth()->user()->type == 'admin')
                            <a href="{{ url('students') }}" class="btn btn-dark">Back</a>
                        @elseif (auth()->user()->type == 'clerk')
                            <a href="{{ url('clerk/students') }}" class="btn btn-dark">Back</a>
                        @else
                            return redirect()->route('home');
                        @endif

                    </div>
                    <!-- <div class="col-12">
                        <label for="" class="form-label" style="color: red;float:right;">* if there is any
                            empty fields except fine reason enter "0" only in Student Fees</label>

                    </div> -->



                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection




@push('other-scripts')
<script>
    $(document).ready(function () {
        var country_id = "{{ $student->s_nationality }}";
        var state = '{{ $student->s_state }}';
        // alert(state);

        if (country_id != '0') {
            // alert(state);
            $.ajax({
                url: "{{ url('get-states-by-country') }}",
                type: "POST",
                data: {
                    country_id: country_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $("#state-dropdown").html('');
                    $.each(result.states, function (key, value) {
                        $("#state-dropdown").append('<option value="' + value.name + '" >' + value.name + '</option>');
                    });

                    $("#state-dropdown").val(state); // Set the selected state
                }
            });
        }

        $('#country-dropdown').on('change', function () {
            var country_id = this.value;
            $("#state-dropdown").html('');
            $.ajax({
                url: "{{ url('get-states-by-country') }}",
                type: "POST",
                data: {
                    country_id: country_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#state-dropdown').html('<option value="">Select State</option>');
                    $.each(result.states, function (key, value) {
                        $("#state-dropdown").append('<option value="' + value.name + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
</script>

   

    <script>
        function add() {
            $(document).ready(function() {


                let admission = parseInt($('#admission').val());
                let term1 = parseInt($('#term1').val());
                let term2 = parseInt($('#term2').val());
                let term3 = parseInt($('#term3').val());
                let extra = parseInt($('#extra').val());
                let book = parseInt($('#book').val());
                let uniform = parseInt($('#uniform').val());
                let fine = parseInt($('#fine').val());


                $('#totalfees').on('click', function() {
                    let total = admission + term1 + term2 + term3 + book + fine + extra + uniform;

                    document.getElementById("totalfees").value = total;






                });
            })
        }
    </script>
@endpush
