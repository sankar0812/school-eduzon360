@extends('layouts.default')
@section('title', 'Staff_Edit')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Staff_Edit</h6>

                </div>
                <div class="card-body">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="" placeholder="Full Name"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="" placeholder="Email"
                                autocomplete="off" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Permanent Address</label>
                            <input type="text" class="form-control" id="" name="address" placeholder="Address"
                                autocomplete="off" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Present Address</label>
                            <input type="text" class="form-control" id="" name="address1"
                                placeholder="Apartment or floor" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Phone No</label>
                            <input type="number" class="form-control" name="phone" id="" placeholder="Phone"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Contact No</label>
                            <input type="number" class="form-control" name="contact" id="" placeholder="Contact"
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Qualification</label>
                            <input type="text" class="form-control" id="" name="qualification"
                                placeholder="qualification" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Experience</label>
                            <input type="text" class="form-control" id="" name="experience"
                                placeholder="Experience" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Languages</label>
                            <input type="text" class="form-control" id="" name="languages"
                                placeholder="Languages" autocomplete="off" required>

                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Date Of Birth</label>
                            <input type="date" name="dob" class="form-control" id="" autocomplete="off"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Gender</label>
                            <select id="" name="gender" class="form-select" autocomplete="off" required>
                                <option>select gender</option>
                                <option value="male">male</option>
                                <option value="female">female</option>
                                {{-- <option value="other">other</option> --}}
                            </select>
                        </div>
                        {{-- <div class="col-md-6">
                            <label for="" class="form-label">Awards</label>
                            <input type="text" class="form-control" id="" name="awards"
                                placeholder="Awards" autocomplete="off" required>
                        </div> --}}
                        <div class="col-md-6">
                            <label for="" class="form-label">Blood Group</label>
                            <input type="text" class="form-control" id="" name="bloodgroup"
                                placeholder="Blood Group" autocomplete="off" required>

                        </div>
                        {{-- <div class="col-md-6">
                            <label for="" class="form-label">Resume</label>
                            <input type="file" name="resume" class="form-control" id="" autocomplete="off"
                                required>
                        </div> --}}
                        <div class="col-md-6">
                            <label for="" class="form-label">Profile Image</label>
                            <input type="file" name="profile" class="form-control" id="" autocomplete="off"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Certificate</label>
                            <input type="file" class="form-control" id="" name="certificate[]"
                            accept=".pdf"   autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Join Date</label>
                            <input type="date" name="joindate" class="form-control" id=""
                                autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">staff Postion</label>
                            <select id="" name="staffpostion" class="form-select" autocomplete="off" required>
                                <option></option>
                                <option value="teachingstaff">Teaching Staff</option>
                                <option value="non-teachingstaff">NON-Teaching staff</option>
                                <option value="cleaning">Cleaning</option>
                                <option value="driver">Driver</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Subject Taught</label>
                            <input type="text" name="workingpostion" class="form-control" id=""
                                placeholder="eg : tamil sir,pt sir" autocomplete="off" required>
                        </div>
                        {{-- <div class="col-md-6">
                            <label for="" class="form-label">Designation</label>
                            <select id="" name="designation" class="form-select" autocomplete="off" required>
                                <option></option>
                                <option value="">Pirincipal</option>
                                <option value="">Vice Pirincipal</option>
                                <option value="">HOD</option>
                                <option value="">Accountant</option>`
                            </select>
                        </div> --}}
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Staff Account</h5>
                            <small class="text-muted float-end">Account Details</small>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Bank Name</label>
                            <input type="text" class="form-control" name="bankname" id=""
                                placeholder="Bank Name" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Account Number</label>
                            <input type="number" class="form-control" name="accountno" id=""
                                placeholder="Account Number" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Account Holder Name</label>
                            <input type="text" class="form-control" name="accountname" id=""
                                placeholder="Account Name" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Branch Name</label>
                            <input type="text" class="form-control" name="branchname" id=""
                                placeholder="Branch Name" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Branch Code</label>
                            <input type="number" class="form-control" name="branchcode" id=""
                                placeholder="Branch Code" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">IFSC Code</label>
                            <input type="text" class="form-control" name="email" id=""
                                placeholder="IFSC Code" autocomplete="off" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Bank Address</label>
                            <input type="text" class="form-control" id="" name="bankaddress"
                                placeholder="Bank Address" autocomplete="off" required>
                        </div>


                        <div class="col-md-6">
                            <label for="" class="form-label">Account Type</label>
                            <select id="" name="accounttype" class="form-select" autocomplete="off" required>
                                <option></option>
                                <option value="current">Current</option>
                                <option value="savings">Savings</option>
                                {{-- <option value="other">Other</option> --}}

                            </select>
                        </div>
                        <div class="col-12">

                            <button type="submit" class="btn btn-primary">Update Form <i
                                    class="fa-solid fa-location-arrow"></i></button>
                            <a href="{{ url('staffdetails') }}" class="btn btn-dark">Back</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
