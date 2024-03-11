@extends('layouts.default')
@section('title', 'Add New_Admission')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
<h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>New Admission Student</h5>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Profile Info </h5>
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
                        <form class="row g-3" action="{{ route('students.addnewstudent') }}" method="POST"
                            enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'clerk')
                            <form class="row g-3" action="{{ route('clerkstudents.addnewstudent') }}" method="POST"
                                enctype="multipart/form-data">
                            @else
                                return redirect()->route('home');
                    @endif


                    @csrf
                    <div class="col-md-2">
                        <label for="" class="form-label">Admission No <span class="text-danger">*</span></label>
                        @if ($students == '0')
                            <input type="text" class="form-control" name="s_admissionno"
                                value="{{ date('y') }}000{{ 1 }}" placeholder="Admission No"
                                autocomplete="off" readonly>
                        @else
                            <input type="text" class="form-control" name="s_admissionno"
                                value="{{ $students->s_admissionno + '1' }}" placeholder="Admission No" autocomplete="off"
                                readonly>
                        @endif
                    </div>
                    {{-- <div class="col-md-6">
                        <label for="" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="s_name" id="" placeholder="" required>
                    </div> --}}
                    <div class="col-md-5">
                        <label for="" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="s_firstname" id=""
                            placeholder="First Name" required  autocomplete="off">
                    </div>
                    <div class="col-md-5">
                        <label for="" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="s_lastname" id="" placeholder="Last Name"  autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" max="<?php echo date('Y-m-d', strtotime('-1 year')); ?>" name="s_dob" id=""
                            placeholder="Full Name" autocomplete="off" required>
                    </div>

                    <div class="col-md-3">
                        <label for="" class="form-label">Gender <span class="text-danger">*</span></label>
                        <select id="" name="s_gender" class="form-select" autocomplete="off" required>
                            <option value="" selected disabled hidden>Select Gender</option>
                            <option value="male">male</option>
                            <option value="female">female</option>
                            <option value="other">other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Email</label>
                        <input type="email" class="form-control" name="s_email" id="" placeholder="Email"
                            autocomplete="off">
                    </div>

                    {{-- <div class="col-md-6">
                        <label for="" class="form-label">Aadhar No</label>
                        <input type="text" class="form-control" name="s_aadharno" id="" placeholder="Full Name"
                            autocomplete="off">
                    </div> --}}


                    <div class="col-6">
                        <label for="" class="form-label">Permanent Address <span
                                class="text-danger">*</span></label>
                        <textarea type="text" class="form-control" name="s_permanentaddress" id="" placeholder="Permanent Address"
                            autocomplete="off" required></textarea>
                        {{--                         
                        <input type="text" class="form-control" id="" name="s_permanentaddress"
                            placeholder="Address" autocomplete="off" required> --}}
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">Present Address</label>
                        <textarea type="text" class="form-control" name="s_presentaddress" id="" placeholder="Present Address"
                            autocomplete="off"></textarea>
                        {{-- <input type="text" class="form-control" id="" name="s_presentaddress"
                            placeholder="Apartment or floor" autocomplete="off"> --}}
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Nationality</label>
                        <select class="form-select" id="country-dropdown" name="s_nationality">
                            <option value="" selected disabled hidden>Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id, $country->name }}">
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">State</label>
                        <select class="form-select" id="state-dropdown" name="s_state">
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Father Name / Guardian Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="" name="s_fathername"
                            placeholder="Father Name" autocomplete="off" required>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Father / Guardian Occupation</label>
                        <input type="text" class="form-control" id="" name="s_fatheroccupation"
                            placeholder="Father Occupation" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Mother Name</label>
                        <input type="text" class="form-control" id="" name="s_mothername"
                            placeholder="Mother Name" autocomplete="off">

                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Mother Occupation</label>
                        <input type="text" name="s_motheroccupation" class="form-control" id=""
                            autocomplete="off" placeholder="Mother Occupation">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Parent Phone No <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="s_phone" id=""
                            placeholder="Phone Number" autocomplete="off" required>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Disabled Person</label>
                        <select id="" name="s_disabledperson" class="form-select" autocomplete="off">
                            <option value="" selected disabled hidden>select</option>
                            <option value="no">No</option>
                            <option value="yes">Yes</option>


                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Religion</label>
                        <input type="text" class="form-control" name="s_religion" id=""
                            placeholder="Religion" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Blood Group</label>


                        <div class="input-group ">
                            <select class="form-select" id="inputGroupSelect02" name="s_bloodgroup">
                                <option value="" selected disabled hidden>select blood </option>
                                @foreach ($bloods as $blood)
                                    <option value="{{ $blood->name }}">{{ $blood->name }}</option>
                                @endforeach

                            </select>
                            <div class="input-group-append">
                                <a href="{{ url('bloodgroups') }}" class="btn btn-outline-primary "
                                    data-bs-toggle="modal" data-bs-target="#exampleModal9"
                                    data-bs-whatever="@mdo">ADD</a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-3">
                                                                    <label for="" class="form-label">Awards</label>
                                                                    <input type="text" class="form-control" id="" name="awards"
                                                                        placeholder="Awards" autocomplete="off" required>
                                                                </div> -->

                    <div class="col-md-3">
                        <label for="" class="form-label">Profile Image</label>
                        <input type="file" name="s_profile" accept="image/png, image/jpeg ,image/jpg"
                            class="form-control" id="s_profile" autocomplete="off">
                    </div>

                    <div class="col-md-3">
                        <label for="" class="form-label">Certificate Pdf</label>
                        <input type="file" class="form-control" id="" name="s_certificate" accept=".pdf"
                            autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Admission Date <span
                                class="text-danger">*</span></label>
                        <input type="date" name="s_admissiondate" class="form-control" id=""
                            autocomplete="off" required>
                    </div>


                    <!-- <div class="col-md-3">
                                                                    <label for="" class="form-label">Admission Class</label>
                                                                    <input type="text" name="admissionclass" class="form-control" id=""
                                                                        placeholder="Admission Class" autocomplete="off" required>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label for="" class="form-label">class section</label>
                                                                    <input type="text" name="classsection" class="form-control" id=""
                                                                        placeholder="class section" autocomplete="off" required>
                                                                </div> -->

                    <!-- <div class="card-header d-flex justify-content-between align-items-center">
                                                                    <h5 class="mb-0">Student Fees</h5>
                                                                    <small class="text-muted float-end">Fees Details</small>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="" class="form-label">Admission Fees</label>
                                                                    <input type="text" class="form-control" name="admissionfees" id=""
                                                                        placeholder="Admission Fees" autocomplete="off" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="" class="form-label">Tuition Fees</label>
                                                                    <input type="text" class="form-control" name="tuitionfees" id=""
                                                                        placeholder="Tuition Fees" autocomplete="off" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="" class="form-label">Exam Fees</label>
                                                                    <input type="number" class="form-control" name="examfees" id=""
                                                                        placeholder="Exam Fees" autocomplete="off" required>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="" class="form-label">Transport Fees</label>
                                                                    <input type="number" class="form-control" name="transportfees" id=""
                                                                        placeholder="Transport Fees" autocomplete="off" required>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="" class="form-label">Total Fees</label>
                                                                    <input type="number" class="form-control" name="totalfees" id=""
                                                                        placeholder="Total Fees" autocomplete="off" required>
                                                                </div> -->


                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                        <!-- <i class="fa-solid fa-arrow-up-from-bracket fa-xl"> </i>  -->
                    </div>

                    </form>




                    {{-- <div class="ps-relative">
            <div class="wmd-container mb8">
                <div id="wmd-button-bar" class="wmd-button-bar btr-sm"></div>
                <div class="js-stacks-validation">
                    <div class="ps-relative">
                        <textarea id="wmd-input"
                                  name="post-text"
                                  class="wmd-input s-input bar0 js-post-body-field"
                                  data-editor-type="wmd"
                                  data-post-type-id="2"
                                  cols="92" rows="15"
                                  aria-labelledby="your-answer-header"
                                  tabindex="101"
                                  data-min-length=""></textarea>
                    </div>
                    <div class="s-input-message mt4 d-none js-stacks-validation-message"></div>
                </div>
            </div>
        </div> --}}
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="exampleModal9" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">

                    @if (auth()->user()->type == 'admin')
                        <form action="{{ route('blood.create') }}" method="post" enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'clerk')
                            <form action="{{ route('blood.create') }}" method="post" enctype="multipart/form-data">
                            @else
                                return redirect()->route('home');
                    @endif

                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Blood Group</label>
                        <input type="text" class="form-control" id="" name="name" autocomplete="off">
                        {{-- <input type="hidden" class="form-control" id="" name="route"
                            value="{{ 'students/create' }}"> --}}
                    </div>


                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary " data-bs-dismiss="modal"
                            aria-label="Close">Close</button> --}}

                        <button type="submit" class="btn btn-primary">Submit<i
                                class="fa-solid fa-location-arrow"></i></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('other-scripts')
    <script>
        //  alert("0");
        $(document).ready(function() {
            $('#country-dropdown').on('change', function() {
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
                    success: function(result) {
                        $('#state-dropdown').html('<option value="">Select State</option>');
                        $.each(result.states, function(key, value) {
                            $("#state-dropdown").append('<option value="' + value.name +
                                '">' + value.name + '</option>');
                        });

                    }
                });
            });

        });
    </script>
@endpush
