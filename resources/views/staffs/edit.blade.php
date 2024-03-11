@extends('layouts.default')
@section('title', 'Edit staff')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    @php
        $position = DB::table('staffpositions')
            ->select('sp_id', 'sp_name')
            ->get();
    @endphp

    <h5 class="fw-bold "><span class="text-muted fw-light"></span>Edit Staff</h5>

    <div class="col-xl p-2">

        @if (auth()->user()->type == 'admin')
            <form class="row g-3" action="{{ url('staffs', $staff->id) }}" method="POST" enctype="multipart/form-data">
            @elseif (auth()->user()->type == 'clerk')
                <form class="row g-3" action="{{ url('clerkstaffs.update', $staff->id) }}" method="POST"
                    enctype="multipart/form-data">
                @else
                    return redirect()->route('home');
        @endif

        @csrf

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Staff Details</h6>
                <small class="text-muted float-end">Profile Details</small>
            </div>
            <div class="card-body row g-3">
                <div class="col-md-2">
                    <label for="" class="form-label">Staff id</label>
                    <input type="text" class="form-control" name="sf_staffid" id=""
                        value="{{ $staff->staff_id }}" placeholder="" autocomplete="off" readonly>
                    {{-- <input type="hidden" name="sf_stafid" value="{{ $staff->id }}"> --}}
                </div>
                {{-- <div class="col-md-5">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="sf_name" id="" placeholder="Full Name"
                            value="{{ $staff->sf_name }}" autocomplete="off">
                    </div> --}}
                <div class="col-md-5">
                    <label for="" class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sf_firstname" id="" placeholder="First Name"
                        autocomplete="off" required value="{{ $staff->sf_firstname }}">
                </div>
                <div class="col-md-5">
                    <label for="" class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sf_lastname" id="" placeholder="Last Name"
                        autocomplete="off" required value="{{ $staff->sf_lastname }}">
                </div>

                <div class="col-md-3">
                    <label for="" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="" name="sf_dob" placeholder=""
                        max="<?php echo date('Y-m-d', strtotime('-1 year')); ?>" required value="{{ $staff->sf_dob }}" autocomplete="off">

                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">gender <span class="text-danger">*</span></label>
                    <select id="" name="sf_gender" class="form-select" autocomplete="off" required>
                        <option hidden selected>select gender</option>
                        <option value="male" {{ $staff->sf_gender === 'male' ? 'Selected' : '' }}>Male</option>
                        <option value="female" {{ $staff->sf_gender === 'female' ? 'Selected' : '' }}>Female
                        </option>
                        <option value="other"{{ $staff->sf_gender === 'other' ? 'Selected' : '' }}>other
                        </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="sf_email" id=""
                        placeholder="Email"value="{{ $staff->sf_email }}" autocomplete="off" required>
                </div>
                {{-- <div class="col-md-3">
                        <label for="" class="form-label">Aadhar Number</label>
                        <input type="number" class="form-control" name="sf_aadharno" id=""
                            value="{{ $staff->sf_aadharno }}" placeholder="Enter Aadhar No" autocomplete="off">
                    </div> --}}

                    <div class="col-md-6">
                        <label for="" class="form-label">permanent address <span
                                class="text-danger">*</span></label>
                        <textarea type="text" class="form-control" name="sf_permanentaddress" id=""
                            placeholder="Enter Permanent Address" autocomplete="off" required>{{ $staff->sf_permanentaddress }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">present address</label>
                        <textarea type="text" class="form-control" name="sf_presentaddress" id=""
                            placeholder="Enter Present Address" autocomplete="off">{{ $staff->sf_presentaddress }}</textarea>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="sf_phone"
                            id=""value="{{ $staff->sf_phone }}" placeholder="Enter Phone" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">nationality</label>
                        <select class="form-select" id="country-dropdown" name="sf_nationality">
                            <option value="" selected disabled hidden>Select Country</option>
                            @foreach ($countries as $country)
    <option value="{{ $country->id }}" {{ $staff->sf_nationality == $country->id ? 'selected' : '' }}>
        {{ $country->name }}
    </option>
@endforeach

                <div class="col-md-6">
                    <label for="" class="form-label">permanent address <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" name="sf_permanentaddress" id=""
                        placeholder="Enter Permanent Address" autocomplete="off" required>{{ $staff->sf_permanentaddress }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">present address</label>
                    <textarea type="text" class="form-control" name="sf_presentaddress" id=""
                        placeholder="Enter Present Address" autocomplete="off">{{ $staff->sf_presentaddress }}</textarea>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="sf_phone"
                        id=""value="{{ $staff->sf_phone }}" placeholder="Enter Phone" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">nationality</label>
                    <select class="form-select" id="country-dropdown" name="sf_nationality">
                        <option value="" selected disabled hidden>Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id, $country->name }}"
                                {{ $staff->sf_nationality === "$country->id" ? 'Selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach


                    </select>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">state</label>
                    <input type="hidden" id="sstate"value="{{ $staff->sf_state }}">
                    <select class="form-select" id="state-dropdown" name="sf_state">
                        <option value="" selected disabled hidden>Select State</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">blood group</label>
                    <div class="input-group ">
                        <select class="form-select" id="inputGroupSelect02" name="sf_bloodgroup">

                            <option value="" selected disabled hidden>select</option>
                            @foreach ($bloods as $blood)
                                <option value="{{ $blood->name }}"
                                    {{ $staff->sf_bloodgroup === "$blood->name" ? 'Selected' : '' }}>
                                    {{ $blood->name }}</option>
                            @endforeach
                            {{-- <option value="AB-">AB-</option> --}}
                        </select>
                        {{-- <div class="input-group-append">
                                    <a href="{{ url('bloodgroups') }}" class="btn btn-outline-primary "
                                        data-bs-toggle="modal" data-bs-target="#exampleModal9"
                                        data-bs-whatever="@mdo">ADD</a>
                                </div> --}}
                    </div>
                </div>


                <div class="col-md-3">
                    <label for="" class="form-label">Father / spouse name <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sf_fathername"
                        id=""value="{{ $staff->sf_fathername }}" placeholder="Father / Spouse Name"
                        autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Father / spouse Occupation</label>
                    <input type="text" class="form-control" name="sf_fatheroccupation"
                        id=""value="{{ $staff->sf_fatheroccupation }}" placeholder="Father / Spouse Occupation"
                        autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Mother name </label>
                    <input type="text" class="form-control" name="sf_mothername"
                        id=""value="{{ $staff->sf_mothername }}" placeholder="Mother Name" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Mother Occupation</label>
                    <input type="text" class="form-control" name="sf_motheroccupation"
                        id=""value="{{ $staff->sf_motheroccupation }}" placeholder="Mother Occupation"
                        autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">language</label>
                    <input type="text" class="form-control" name="sf_language"
                        id=""value="{{ $staff->sf_language }}" placeholder="Language" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Religion</label>
                    <input type="text" class="form-control" name="sf_religion"
                        id=""value="{{ $staff->sf_religion }}" placeholder="Religion" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Disabled Person</label>
                    <select id="" name="sf_disabledperson" class="form-select" autocomplete="off"
                        value="{{ $staff->sf_disabledperson }}">

                        <option value="" selected disabled hidden>select</option>
                        <option value="yes" {{ $staff->sf_disabledperson === 'yes' ? 'Selected' : '' }}>Yes
                        </option>
                        <option value="no" {{ $staff->sf_disabledperson === 'no' ? 'Selected' : '' }}>No
                        </option>

                    </select>
                </div>
                <div class="col-3">
                    <label for="" class="form-label">Join date</label>
                    <input type="date" class="form-control" id="" name="sf_joindate"
                        placeholder=""value="{{ $staff->sf_joindate }}" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">profile</label>
                    <input type="file" name="sf_profile" accept="image/png, image/jpeg ,image/jpg"
                        class="form-control" id="sf_profile" autocomplete="off" data-bs-backdrop="static">
                    <input type="hidden" name="sf_profileold" value="{{ $staff->sf_profile }}">
                    <input type="hidden" name="sf_image_pathold" value="{{ $staff->sf_image_path }}">
                    {{-- <img src="{{ asset($staff->sf_image_path) }}" width="150px" height="100px" class="square"> --}}
                    <h5>{{ $staff->sf_profile }}</h5>
                </div>
            </div>
        </div>

        <hr class="my-3" />
        <h5 class="fw-bold "><span class="text-muted fw-light"></span>Educational Details</h5>

        <div class="card ">
            <div class="card-header d-flex justify-content-between align-items-center">

                <small class="text-muted float-end">Educational Details</small>
            </div>
            <div class="card-body row g-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Qualification</label>
                    <input type="text" class="form-control" id="" name="sf_qualification"
                        value="{{ $staff->sf_qualification }}" placeholder="qualification" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Experience</label>
                    <input type="text" class="form-control" id="" name="sf_experience"
                        value="{{ $staff->sf_experience }}" placeholder="Experience" autocomplete="off">
                </div>
                 @if($staff->sf_position == 1)
                <div class="col-md-3">
                    <label for="" class="form-label">Subject Taken <span class="text-danger">*</span></label>
                    <select name="sf_subject_taken" class="form-select" autocomplete="off" required>
                        <option value="" selected disabled hidden>Select subject</option>
                        @foreach ($subjecttaken as $subjecttakens)
                            <option value="{{ $subjecttakens->name }}"
                                {{ $subjecttakens->name == $staff->sf_subject_taken ? 'selected' : '' }}>
                                {{ $subjecttakens->name }}
                            </option>
                        @endforeach
                    </select>

                </div>
                @endif
                <div class="col-md-3">
                    <label for="" class="form-label">Certificate Pdf</label>
                    <input type="hidden" name="sf_certificateold" value="{{ $staff->sf_certificate }}">
                    <input type="hidden" name="sf_file_pathold" value="{{ $staff->sf_file_path }}">
                    <input type="file" name="sf_certificate" accept=".pdf" class="form-control" id=""
                        autocomplete="off" data-bs-backdrop="static">
                    <h5>{{ $staff->sf_certificate }}</h5>
                    {{-- <embed src="{{ url($staff->sf_file_path) }}" width="150px" height="100px" class="square"> --}}
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Position</label>
                    {{-- <input type="text" class="form-control" name="sf_position" id=""
                                placeholder=""value="{{ $staff->sf_position }}" autocomplete="off"> --}}
                    <select id="" name="sf_position" class="form-select" autocomplete="off">
                        <option value="" selected disabled hidden>Select Position</option>
                        @foreach ($position as $positiondata)
                            <option value="{{ $positiondata->sp_id }}"
                                {{ $staff->sf_position === $positiondata->sp_id ? 'Selected' : '' }}>
                                {{ $positiondata->sp_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Designation</label>
                    <input type="text" class="form-control" id="" name="sf_designation"
                        placeholder="Designation" autocomplete="off" value="{{ $staff->sf_designation }}">
                </div>
            </div>
        </div>

        <hr class="" />
        <h5 class="fw-bold "><span class="text-muted fw-light"></span>Account Details</h5>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">

                <small class="text-muted float-end">Account Details</small>
            </div>

            <div class="card-body row g-3">
                @foreach ($staffac as $staffacc)
                    <div class="col-md-3">

                        <label for="" class="form-label">Account Number</label>

                        <input type="text" class="form-control" id="" name="account_no"
                            placeholder="Enter Account No" value="{{ $staffacc->account_no }}" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Account Holder Name</label>
                        <input type="text" class="form-control" id="" name="account_holder_name"
                            placeholder="Enter Account Holder Name" value="{{ $staffacc->account_holder_name }}"
                            autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Branch Name</label>
                        <input type="text" class="form-control" id="" name="branch_name"
                            placeholder="Branch Name" value="{{ $staffacc->branch_name }}" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Branch Code</label>
                        <input type="text" class="form-control" id="" name="branch_code"
                            placeholder="Branch Code" value="{{ $staffacc->branch_code }}" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">IFSC Code</label>
                        <input type="text" class="form-control" id="" name="ifsc_code"
                            placeholder="IFSC Code" value="{{ $staffacc->ifsc_code }}" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Bank Address</label>
                        <textarea type="text" class="form-control" name="bank_address" id="" placeholder="Enter Bank Address"
                            autocomplete="off">{{ $staffacc->bank_address }}</textarea>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Account Type</label>
                        <select id="" name="account_type" class="form-select" autocomplete="off"
                            value="">
                            <option value="" selected disabled hidden>Select Account Type </option>

                            <option value="savings" {{ $staffacc->account_type === 'savings' ? 'Selected' : '' }}>
                                Savings
                            </option>
                            <option value="current" {{ $staffacc->account_type === 'current' ? 'Selected' : '' }}>
                                Current
                            </option>

                        </select>
                    </div>
                @endforeach
            </div>
        </div>
        <hr class="" />
        <h5 class="fw-bold "><span class="text-muted fw-light"></span>Salary Details</h5>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0  text-muted">Staff Details</h6>
                <!--<small class="text-danger float-end">Before click the submit button ,Please Double Click on net Salary-->
                <!--    Field </small>-->
            </div>

            <div class="card-body row g-3">
                @foreach ($staffsal as $staffsa)
                    <div class="col-md-3">
                        <label for="" class="form-label">Basic Salary</label>
                        <input type="text" class="form-control" id="basic" value="{{ $staffsa->basic_salary }}"
                            required name="basic_salary" placeholder="Basic Salary" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Overtime</label>
                        <input type="text" class="form-control" id="overtime" value="{{ $staffsa->overtime }}"
                            required name="overtime" placeholder="Overtime" autocomplete="off">
                    </div>

                    <div class="col-md-3">
                        <label for="" class="form-label">Allowance</label>
                        <input type="text" class="form-control" id="allowance" value="{{ $staffsa->allowance }}"
                            required name="allowance" placeholder="Allowance" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Bonus</label>
                        <input type="text" class="form-control" id="bonus" value="{{ $staffsa->bonus }}"
                            required name="bonus" placeholder="Bonus" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Reduction</label>
                        <input type="text" class="form-control" id="reduction" value="{{ $staffsa->reduction }}"
                            required name="reduction" placeholder="Reduction Amount" autocomplete="off">
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Net salary</label>
                        <input type="text" class="form-control" onclick="add()" readonly name="net_salary" id="net_salary"
                            placeholder="Net salary" autocomplete="off" required>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Reduction Reason</label>
                        <textarea type="text" class="form-control" id="" name="reduction_reason" placeholder="Reduction Reason"
                            autocomplete="off">{{ $staffsa->reduction_reason }}</textarea>
                    </div>
                    <div class="col-md-3">
                        <label for="" class="form-label">Payment Type</label>
                        <select id="salary" name="payment_type" class="form-select" autocomplete="off">
                            <option value="" selected disabled hidden>Select Payment Type </option>

                            <option value="account" {{ $staffsa->payment_method === 'account' ? 'Selected' : '' }}>
                                Account Transfer
                            </option>
                            <option value="cheque" {{ $staffsa->payment_method === 'cheque' ? 'Selected' : '' }}>
                                Cheque</option>
                            <option value="cash" {{ $staffsa->payment_method === 'cash' ? 'Selected' : '' }}>
                                Cash</option>

                        </select>
                    </div>
                @endforeach
            </div>




            <div class="col-12">
                <button type="submit" class="btn btn-primary ">Submit Form <i
                        class="fa-solid fa-location-arrow"></i></button>
                @if (auth()->user()->type == 'admin')
                    <a href="{{ url('admin/staffsdetails') }}" class="btn btn-dark"> Back</a>
                @elseif (auth()->user()->type == 'clerk')
                    <a href="{{ url('clerk/staffsdetails') }}" class="btn btn-dark"> Back</a>
                @else
                    return redirect()->route('home');
                @endif


            </div>
            <br>
        </div>
        </form>

    </div>







    <div class="modal fade" id="exampleModal9" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('blood.create') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body ">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Blood Group</label>
                            <input type="text" class="form-control" id="" name="name">
                            {{-- <input type="hidden" class="form-control" id="" name="route"
                                value="{{ 'staffs/edi' }}"> --}}
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
 $(document).ready(function() {
    var country_id = <?php echo $staff->sf_nationality; ?>;
    var state = $('#sstate').val();
    var state = $('#sstate').val();
            // alert(state);
            if ('country_id' != '0') {

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
                        // $('#state-dropdown').html('<option value="">Select State</option>');
                        console.log(state);
                        // alert(state);
                        $.each(result.states, function(key, value) {
                            $("#state-dropdown").append('<option value="' + value.name + '" >' +
                                value.name + '</option>');
                        });
                        $("#state-dropdown option").each(function() {
                            if ($(this).val() == state) { // EDITED THIS LINE
                                $(this).attr("selected", "selected");
                            }
                        });
                    }
                });

            }


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
            // }

        });
          </script>
    <!--    <script>-->
    <!--    function add() {-->
    <!--        $(document).ready(function() {-->


    <!--            let basic = parseInt($('#basic').val());-->
                // alert("basic");
    <!--            let overtime = parseInt($('#overtime').val());-->
    <!--            let allowance = parseInt($('#allowance').val());-->
    <!--            let bonus = parseInt($('#bonus').val());-->
    <!--            let reduction = parseInt($('#reduction').val());-->


    <!--            $('#net_salary').on('click', function() {-->
    <!--                let net_salary = basic + overtime + allowance + bonus - reduction;-->
    <!--                document.getElementById("net_salary").value = net_salary;-->
    <!--            });-->
    <!--        })-->
    <!--    }-->
    <!--</script>-->
    
            <script>
    $(document).ready(function() {
        function calculateNetSalary() {
            let basic = parseInt($('#basic').val()) || 0;
            let overtime = parseInt($('#overtime').val()) || 0;
            let allowance = parseInt($('#allowance').val()) || 0;
            let bonus = parseInt($('#bonus').val()) || 0;
            let reduction = parseInt($('#reduction').val()) || 0;

            let net_salary = basic + overtime + allowance + bonus - reduction;
            $('#net_salary').val(net_salary);
        }

        // Calculate net salary on page load
        calculateNetSalary();

        // Bind the calculateNetSalary function to the change event of specified input fields
        $('#basic, #overtime, #allowance, #bonus, #reduction').on('change', function() {
            calculateNetSalary();
        });
    });
</script>
@endpush
