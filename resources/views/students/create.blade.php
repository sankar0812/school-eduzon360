@extends('layouts.default')
@section('title', 'Add Student')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Bulk Student Add</h3>
        {{-- <small class="text-muted float-end"><a href="{{ url('logindetails') }}" class="btn btn-info btn-sm">Show
    Logins</a></small> --}}
    </div>
    <div class="card-body">
        <div class="row">

            <div class="col-md-6">
                @if (auth()->user()->type == 'admin')
                    <a href="{{ route('admin.studentexport') }}" class="btn btn-primary">Download To fill Excel
                        Sheet</a>
                @elseif (auth()->user()->type == 'clerk')
                    <a href="{{ route('clerk.studentexport') }}" class="btn btn-primary">Download To fill Excel
                        Sheet</a>
                @else
                    return redirect()->route('home');
                @endif
            </div>
            <div class="col-md-6">
                <div>
                    <!-- Display success or error messages, if any -->
                    @if (session('success'))
                        <div style="color: green;">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div style="color: red;">{{ session('error') }}</div>
                    @endif

                    <!-- Add your other HTML content here -->
                    @if (auth()->user()->type == 'admin')
                        <form action="{{ route('admin.studentimport') }}" method="post" enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'accountant')
                            <form action="{{ route('clerk.studentimport') }}" method="post"
                                enctype="multipart/form-data">
                            @else
                                return redirect()->route('home');
                    @endif
                    @csrf

                    <div class="form-group row mb-3">
                        <label class="col-sm-6 col-form-label" for="file">Select Excel File To Upload:<b>(Fees
                                Upload)</b></label>

                        <div class="col-md-6">
                            <input type="file" name="file" accept=".xlsx" class="form-control" autocomplete="off"
                                data-bs-backdrop="static">
                        </div>
                    </div>
                    <!-- <input type="file" name="file" accept=".xlsx"> -->
                    <button type="submit" class="btn btn-primary">Upload Filled Excel Sheet</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<hr class="my-3" />
<h4 class="fw-bold py-2"><span class="text-muted fw-light"></span>Add Student</h4>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Profile info</h5>
                    <small class="text-muted float-end"></small>
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
                        <form class="row g-3" action="{{ route('students.store') }}" method="POST"
                            enctype="multipart/form-data">
                        @elseif (auth()->user()->type == 'clerk')
                            <form class="row g-3" action="{{ route('clerkstudents.store') }}" method="POST"
                                enctype="multipart/form-data">
                            @else
                                return redirect()->route('home');
                    @endif

                    @csrf
                    <div class="col-md-2">
                        <label for="" class="form-label">Admission No <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="s_admissionno" placeholder="Admission No"
                            autocomplete="off" required>

                    </div>
                    <div class="col-md-2">
                        <label for="" class="form-label">Roll No </label>
                        <input type="text" class="form-control" name="s_rollno" placeholder="Roll No" autocomplete="off">

                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="s_firstname" id=""
                            placeholder="First Name" required autocomplete="off">
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="s_lastname" id="" placeholder="Last Name"
                            autocomplete="off">
                    </div>
                    {{-- <div class="col-md-6">
                        <label for="" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="s_name" id="" placeholder="" required>
                    </div> --}}
                    <div class="col-md-3">
                        <label for="" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="s_dob" id="" placeholder=""
                            autocomplete="off" max="<?php echo date('Y-m-d', strtotime('-1 year')); ?>" required>

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
                        <label for="" class="form-label">Student Aadhar No</label>
                        <input type="text" class="form-control" name="s_aadharno" id="" placeholder=""
                            autocomplete="off" required>
                    </div> --}}


                    <div class="col-6">
                        <label for="" class="form-label">Permanent Address <span
                                class="text-danger">*</span></label>
                        <textarea type="text" class="form-control" name="s_permanentaddress" id="" placeholder="Permanent Address"
                            autocomplete="off" required></textarea>
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">Present Address</label>
                        <textarea type="text" class="form-control" name="s_presentaddress" id="" placeholder="Present Address"
                            autocomplete="off"></textarea>

                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Nationality</label>
                        <select class="form-select" id="country-dropdown" name="s_nationality">
                            <option value="" selected disabled hidden>Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">
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
                        <label for="" class="form-label">Religion</label>
                        <input type="text" class="form-control" name="s_religion" id=""
                            placeholder="Religion" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Blood Group</label>
                        <div class="input-group ">
                            <select class="form-select" id="inputGroupSelect02" name="s_bloodgroup">
                                <option value="" selected disabled hidden>Select Blood</option>
                                @foreach ($bloods as $blood)
                                    <option value="{{ $blood->name }}">{{ $blood->name }}</option>
                                @endforeach
                                {{-- <option value="AB-">AB-</option> --}}
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-outline-primary " data-bs-toggle="modal"
                                    data-bs-target="#exampleModal9" data-bs-whatever="@mdo">ADD</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Disabled Person</label>
                        <select id="" name="s_disabledperson" class="form-select" autocomplete="off">
                            <option value="" selected disabled hidden>select </option>
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                    </div>
                    <!-- <div class="col-md-3">
                                                                        <label for="" class="form-label">Awards</label>
                                                                        <input type="text" class="form-control" id="" name="awards"
                                                                            placeholder="Awards" autocomplete="off" required>
                                                                    </div> -->

                    <div class="col-md-3">
                        <label for="" class="form-label">Profile Image</label>
                        <input type="file" name="s_profile" accept="image/png, image/jpeg ,image/jpg"
                            class="form-control" id="s_profile" autocomplete="off" data-bs-backdrop="static">
                    </div>

                    <div class="col-md-3">
                        <label for="" class="form-label">Certificate Pdf</label>
                        <input type="file" class="form-control" id="" name="s_certificate" accept=".pdf"
                            autocomplete="off" data-bs-backdrop="static">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Admission Date <span
                                class="text-danger">*</span></label>
                        <input type="date" name="s_admissiondate" class="form-control" id=""
                            autocomplete="off" required>
                    </div>


                    <div class="col-md-3">
                        <label for="" class="form-label"> Class/Section <span
                                class="text-danger">*</span></label>
                        @php
                            $class = DB::table('class_sections')
                                ->where(['c_status' => 1, 'c_delete' => 1])
                                ->get();
                        @endphp

                        <select class="form-control" name="class" required>
                            <option value="" selected disabled hidden>Select Class</option>
                            @foreach ($class as $section)
                                <option value="{{ $section->id }}">{{ $section->c_class }}</option>
                            @endforeach

                        </select>
                    </div>
                 
                    <!--      <div class="col-md-3">
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
                    <form action="{{ route('blood.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Blood Group</label>
                            <input type="text" class="form-control" id="" name="name"
                                autocomplete="off">
                            {{-- <input type="hidden" class="form-control" id="" name="route"
                                value="{{ 'students/create' }}"> --}}
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary " data-bs-dismiss="modal"
                                aria-label="Close">Close</button>

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
