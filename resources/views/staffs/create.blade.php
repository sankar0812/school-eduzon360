@extends('layouts.default')
@section('title', 'Add staff')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    @php
        $position = DB::table('staffpositions')
            ->select('sp_id', 'sp_name')
            ->get();
    @endphp
    <h5 class="fw-bold "><span class="text-muted fw-light"></span>Add Staff</h5>


        @if (auth()->user()->type == 'admin')
            <form class="row g-3" action="{{ route('staffs.store') }}" method="POST" enctype="multipart/form-data">
            @elseif (auth()->user()->type == 'clerk')
                <form class="row g-3" action="{{ route('clerkstaffs.store') }}" method="POST" enctype="multipart/form-data">
                @else
                    return redirect()->route('home');
        @endif


        @csrf
        <div class="card ">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Profile Info</h6>
                <small class="text-muted float-end"></small>
            </div>
            <div class="card-body row g-3">
                <div class="col-md-2">
                    <label for="staff_id" class="form-label">Staff ID</label>
                    @if (!empty($next_no))
                        <input type="text" class="form-control" name="sf_staffid" id="staff_id" placeholder="Staff No"
                            autocomplete="off" readonly value="{{ $next_no }}">
                    @else
                        <input type="text" class="form-control" name="sf_staffid" id="staff_id" placeholder="Staff No"
                            autocomplete="off" readonly value="1">
                    @endif
                </div>
                {{-- <div class="col-md-5">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="sf_name" id="" placeholder="Full Name"
                            autocomplete="off" required>
                    </div> --}}
                <div class="col-md-5">
                    <label for="" class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sf_firstname" id="" placeholder="First Name"
                        autocomplete="off" required>
                </div>
                <div class="col-md-5">
                    <label for="" class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sf_lastname" id="" placeholder="Last Name"
                        autocomplete="off" required>
                </div>
                <div class="col-3">
                    <label for="" class="form-label">Date of Birth <span class="text-danger">*</span></label>

                    <input type="date" class="form-control" name="sf_dob" id="" placeholder="Full Name"
                        autocomplete="off" max="<?php echo date('Y-m-d', strtotime('-1 year')); ?>" required>
                </div>
                <div class="col-3">
                    <label for="" class="form-label">Gender <span class="text-danger">*</span></label>
                    <select id="" name="sf_gender" class="form-select" autocomplete="off" required>
                        <option value="" selected disabled hidden>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="sf_email" id="" placeholder="Email"
                        autocomplete="off" required>
                </div>
                {{-- <div class="col-md-3">
                        <label for="" class="form-label">Aadhar Number</label>
                        <input type="number" class="form-control" name="sf_aadharno" id=""
                            placeholder="Enter Aadhar No" autocomplete="off" required>
                    </div> --}}
                <div class="col-md-6">
                    <label for="" class="form-label">permanent address <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" name="sf_permanentaddress" id=""
                        placeholder="Enter Permanent Address" autocomplete="off" required></textarea>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">present address</label>
                    <textarea type="text" class="form-control" name="sf_presentaddress" id=""
                        placeholder="Enter Present Address" autocomplete="off"></textarea>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="sf_phone" id="" placeholder="Enter Phone"
                        autocomplete="off" required>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">nationality</label>
                    <select class="form-select" id="country-dropdown" name="sf_nationality">
                        <option value="" selected disabled hidden>Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id, $country->name }}">
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">state</label>
                    <select class="form-select" id="state-dropdown" name="s_state">
                        <option value="" selected disabled hidden>Select State</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">blood group</label>
                    <div class="input-group ">
                        <select class="form-select" id="inputGroupSelect02" name="sf_bloodgroup">
                            <option value="" selected disabled hidden>Choose...</option>
                            @foreach ($bloods as $blood)
                                <option value="{{ $blood->name }}">{{ $blood->name }}</option>
                            @endforeach
                            {{-- <option value="AB-">AB-</option> --}}
                        </select>
                        <div class="input-group-append">
                            <a class="btn btn-outline-primary " data-bs-toggle="modal" data-bs-target="#exampleModal9"
                                data-bs-whatever="@mdo">ADD</a>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <label for="" class="form-label">Father / spouse name <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sf_fathername" id=""
                        placeholder="Father / Spouse Name" autocomplete="off" required>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Father / spouse Occupation</label>
                    <input type="text" class="form-control" name="sf_fatheroccupation" id=""
                        placeholder="Father / Spouse Occupation" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Mother name </label>
                    <input type="text" class="form-control" name="sf_mothername" id=""
                        placeholder="Mother Name" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Mother Occupation</label>
                    <input type="text" class="form-control" name="sf_motheroccupation" id=""
                        placeholder="Mother Occupation" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">language</label>
                    <input type="text" class="form-control" name="sf_language" id="" placeholder="Language"
                        autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">profile</label>
                    <input type="file" name="sf_profile" accept="image/png, image/jpeg ,image/jpg"
                        class="form-control" id="sf_profile" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Religion</label>
                    <input type="text" class="form-control" name="sf_religion" id="" placeholder="Religion"
                        autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Disabled Person</label>
                    <select id="" name="sf_disabledperson" class="form-select" autocomplete="off">
                        <option value="" selected disabled hidden>select </option>
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="" class="form-label">Join date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="" name="sf_joindate" placeholder=""
                        autocomplete="off" required>
                </div>
            </div>
        </div>

        <hr class="my-3" />
        <h5 class="fw-bold "><span class="text-muted fw-light"></span>Educational Details</h5>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">

                <small class="text-muted float-end"></small>
            </div>
            <div class="card-body row g-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Position <span class="text-danger">*</span></label>
                    <select id="first-dropdown" name="sf_position" class="form-select" required>
                        <option value="" selected disabled hidden>Select Position</option>
                        @foreach ($position as $positiondata)
                            <option value="{{ $positiondata->sp_id }}">{{ $positiondata->sp_name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="col-md-3">
                        <label for="" class="form-label">Position <span class="text-danger">*</span></label>
                        <select id="first-dropdown" name="sf_position" class="form-select" required>
                            <option value="" selected disabled hidden>Select Position</option>
                            @foreach ($position as $positiondata)
                                <option value="{{ $positiondata->sp_id }}">{{ $positiondata->sp_name }}</option>
                            @endforeach
                        </select>
                    </div> --}}


                <div class="col-md-3">
                    <label for="" class="form-label">Qualification <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="" name="sf_qualification"
                        placeholder="qualification" autocomplete="off" required>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Experience</label>
                    <input type="text" class="form-control" id="" name="sf_experience"
                        placeholder="Experience" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Certificate Pdf</label>
                    <input type="file" class="form-control" id="" name="sf_certificate" accept=".pdf"
                        autocomplete="off" data-bs-backdrop="static">
                </div>

                {{-- <div id="another-input" class="hiddendate">
                        <label for="second-input">select date:</label>
                        <input type="date" id="second-input" name="exam_date" class="form-control">
                    </div> --}}
                {{-- <div id="another-input" class="hiddendate">
                        <div class="col-md-3">

                            <label for="" class="form-label">Subject Taken <span
                                    class="text-danger">*</span></label>
                            <select id="" name="sf_subject_taken" class="form-select" id="second-input"
                                autocomplete="off" required>
                                <option value="" selected disabled hidden>Select subject</option>
                                @foreach ($subjecttaken as $subjecttakens)
                                    <option value="{{ $subjecttakens->name }}">{{ $subjecttakens->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                <div id="another-input" class="hiddendate">
                    <div class="col-md-3">
                        <label for="" class="form-label">Subject Taken <span class="text-danger">*</span></label>
                        <select id="second-input" name="sf_subject_taken" class="form-select" autocomplete="off">
                            <option value="" selected disabled hidden>Select subject</option>
                            @foreach ($subjecttaken as $subjecttakens)
                                <option value="{{ $subjecttakens->name }}">{{ $subjecttakens->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="another-input" class="hiddendate">
                        <div class="col-md-3">
                            <label for="" class="form-label">Subject Taken <span
                                    class="text-danger">*</span></label>
                            <select id="second-input" name="sf_subject_taken" class="form-select" autocomplete="off"
                                >
                                <option value="" selected disabled hidden>Select subject</option>
                                @foreach ($subjecttaken as $subjecttakens)
                                    <option value="{{ $subjecttakens->name }}">{{ $subjecttakens->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Designation</label>
                    <input type="text" class="form-control" id="" name="sf_designation"
                        placeholder="Designation" autocomplete="off">
                </div>
            </div>
        </div>
        <hr class="" />
        <h5 class="fw-bold "><span class="text-muted fw-light"></span>Account Details</h5>



        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">

                <small class="text-muted float-end"></small>
                <small class="text-muted float-right" style="color: red !important;">If you Don't have Data to Enter
                    leave that</small>
            </div>

            <div class="card-body row g-3">

                <div class="col-md-3">

                    <label for="" class="form-label">Account Number</label>

                    <input type="text" class="form-control" id="" name="account_no"
                        placeholder="Enter Account No" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Account Holder Name</label>
                    <input type="text" class="form-control" id="" name="account_holder_name"
                        placeholder="Enter Account Holder Name" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Branch Name</label>
                    <input type="text" class="form-control" id="" name="branch_name"
                        placeholder="Branch Name" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Branch Code</label>
                    <input type="text" class="form-control" id="" name="branch_code"
                        placeholder="Branch Code" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">IFSC Code</label>
                    <input type="text" class="form-control" id="" name="ifsc_code" placeholder="IFSC Code"
                        autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Bank Address</label>
                    <textarea type="text" class="form-control" name="bank_address" id="" placeholder="Enter Bank Address"
                        autocomplete="off"></textarea>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Account Type</label>
                    <select id="" name="account_type" class="form-select" autocomplete="off">
                        <option value="" selected disabled hidden>Select Account Type </option>
                        <option value="savings">Savings</option>
                        <option value="current">Current</option>
                    </select>
                </div>

                {{-- </div>
                </div> --}}

                {{-- <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">

                        <small class="text-muted float-end">Salary Details</small>
                    </div>

                    <div class="card-body row g-3">

                        <div class="col-md-3">

                            <label for="" class="form-label">Account Number</label>

                            <input type="text" class="form-control" id="" name="account_no"
                                placeholder="Enter Account No" autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Account Holder Name</label>
                            <input type="text" class="form-control" id="" name="account_holder_name"
                                placeholder="Enter Account Holder Name" autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Branch Name</label>
                            <input type="text" class="form-control" id="" name="branch_name"
                                placeholder="Branch Name" autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Branch Code</label>
                            <input type="text" class="form-control" id="" name="branch_code"
                                placeholder="Branch Code" autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">IFSC Code</label>
                            <input type="text" class="form-control" id="" name="ifsc_code"
                                placeholder="IFSC Code" autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Bank Address</label>
                            <textarea type="text" class="form-control" name="bank_address" id="" placeholder="Enter Bank Address"
                                autocomplete="off"></textarea>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Account Type</label>
                            <select id="" name="account_type" class="form-select" autocomplete="off">
                                <option>Select Account Type </option>
                                <option value="savings">Savings
                                </option>
                                <option value="current">Current
                                </option>

                            </select>
                        </div> --}}

                <div class="col-12">
                    <button type="submit" class="btn btn-primary ">Submit Form <i
                            class="fa-solid fa-location-arrow"></i></button>
                </div>
            </div>
        </div>

        </form>






        {{-- <div class="modal fade" id="exampleModal9" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"   data-bs-backdrop="static"> --}}
        <div class="modal fade" id="exampleModal9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- <h1 class="modal-title fs-5" id="exampleModalLabel"></h1> --}}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <form action="{{ route('blood.create') }}" method="post" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Blood Group</label>
                                <input type="text" class="form-control" id="" name="name"
                                    autocomplete="off">
                                <input type="hidden" class="form-control" id="" name="route"
                                    value="{{ 'staffs/create' }}">
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
