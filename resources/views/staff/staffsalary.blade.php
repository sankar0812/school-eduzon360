@extends('layouts.default')
@section('title', 'Manage Staff salary')
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('contentdashboard')
    @php
        $position = DB::table('salaryexpenses')
            ->select('month')
            ->groupby('month')
            ->get();
    @endphp
 
        <div class="col-xl-12">

            <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true"
                            style="font-weight:bold;">
                            Salary View
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false"
                            style="font-weight:bold;">
                            Salary Expense
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                        <div class="card-body">

                            @if (auth()->user()->type == 'admin')
                                <form class="row g-3" method="POST" action="{{ route('salary.filter') }}"
                                    enctype="multipart/form-data">
                                @elseif (auth()->user()->type == 'clerk')
                                    <form class="row g-3" method="POST" action="{{ route('clerksalary.filter') }}"
                                        enctype="multipart/form-data">
                                    @else
                                        return redirect()->route('home');
                            @endif


                            @csrf
                            <div class="form-group row mb-2">
                                <label for="inputPassword" class="col-sm-2 col-form-label">staff Month</label>
                                <div class="col-md-5">
                                    <select id="" name="month" class="form-control "
                                        autocomplete="off" required>
                                        <option value="" selected disabled hidden>Select Month</option>
                                        @foreach ($position as $positiondata)
                                            <option value="{{ $positiondata->month }}">{{ $positiondata->month }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-3 py-2">
                                    <button type="submit" class="btn btn-primary  btn-sm"> <i class="bx bx-search fs-5 lh-0"></i> Search</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">

                        <div class="card-body row g-3">


                            @if (auth()->user()->type == 'admin')
                                <form class="row g-3" action="{{ 'salaryadd' }}" method="POST"
                                    enctype="multipart/form-data">
                                @elseif (auth()->user()->type == 'clerk')
                                    <form class="row g-3" action="{{ url('clerk/salaryadd') }}" method="POST"
                                        enctype="multipart/form-data">
                                    @else
                                        return redirect()->route('home');
                            @endif


                            @csrf

                              @php
                                $position = DB::table('staffpositions')
                                    ->select('sp_id','sp_name')
                                    ->get();
                            @endphp
                            <div class="col-md-3">
                                <label for="" class="form-label">Position</label>


                                <select id="sf_position" name="sf_position" class="form-select" autocomplete="off" required>
                                    <option value="" selected disabled hidden>Select Position</option>
                                    @foreach ($position as $positiondata)
                                        <option value="{{ $positiondata->sp_id }}">{{ $positiondata->sp_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">

                                <label for="" class="form-label">Staff Name</label>
                                <select class="form-select" id="staff_id" required name="staff_name">
                                   
                                    <!-- @foreach ($salaryChecks as $staff)
                                        <option value="{{ $staff->id }}">{{ $staff->id }} - {{ $staff->sf_name }}
                                        </option>
                                    @endforeach
 -->

                                </select>

                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Basic Salary</label>
                                <input type="text" class="form-control" id="basic" required name="basic_salary"
                                    placeholder="Basic Salary" autocomplete="off">
                            </div>
                           
                            <div class="col-md-3">
                                <label for="" class="form-label">Overtime</label>
                                <input type="text" class="form-control" id="overtime" required name="overtime"
                                    placeholder="Overtime" autocomplete="off">
                            </div>

                            <div class="col-md-3">
                                <label for="" class="form-label">Allowance</label>
                                <input type="text" class="form-control" id="allowance" required name="allowance"
                                    placeholder="Allowance" autocomplete="off">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Bonus</label>
                                <input type="text" class="form-control" id="bonus" required name="bonus"
                                    placeholder="Bonus" autocomplete="off">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Reduction</label>
                                <input type="text" class="form-control" id="reduction" required name="reduction"
                                    placeholder="Reduction Amount" autocomplete="off">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Net salary</label>
                                <input type="text" class="form-control" onclick="add()" name="net_salary"
                                    id="net_salary" placeholder="Net salary" autocomplete="off">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Reduction Reason</label>
                                <textarea type="text" class="form-control" id="" name="reduction_reason" placeholder="Reduction Reason"
                                    autocomplete="off"></textarea>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Payment Type</label>
                                <select id="salary" name="payment_type" class="form-select" autocomplete="off">
                                    <option>Select Payment Type </option>
                                    <option value="account">Account Transfer</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="cash">Cash</option>

                                </select>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary ">Submit Form <i
                                        class="fa-solid fa-location-arrow"></i></button>
                                {{-- <a href="{{ route('staffs') }}" class="btn btn-outline-dark"><i
                              class="fa-solid fa-backward "></i> Back</a> --}}
                            </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

            <hr class="my-3" />
            <h5 class="fw-bold  mb-3"><span class="text-muted fw-light"></span>Salary List</h5>

            <div class="card p-2">
                {{-- <h6 class="card-header" style="font-weight:bold;">Staff Salary

                </h6> --}}
                <div class="table-responsive text-nowrap ">
                    <table class="table " id="example">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                {{-- <th>Staff Id</th> --}}
                                <th>NAME</th>
                                {{-- <th>IMAGE</th> --}}
                                <th>Allowances</th>
                                <th>Reduction</th>
                                <th>Reduction Reason</th>
                                <th>Net Salary</th>
                                {{-- <th>STATUS</th> --}}
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($salarys as $salary)
                                <tr>

                                    <td>{{ ++$i }}</td>
                                    {{-- @foreach ($staffs as $staff) --}}
                                    <td>{{ $salary->staffname }}</td>
                                    {{-- @endforeach --}}
                                    <td>{{ $salary->allowance }}</td>
                                    <td>{{ $salary->reduction }}</td>
                                    <td>{{ $salary->reduction_reason }}</td>
                                    {{-- <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-xs pull-up" title="ideaux">
                                        <img src="assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                                    </li>

                                </ul>
                               </td> --}}
                                    <td>{{ $salary->net_salary }}</td>

                                    {{-- <td><span class="badge bg-label-danger me-1">Deactive</span></td> --}}
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                              <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                {{-- <li><a class="dropdown-item" href="{{ url('staffsalaryview') }}"><i
                                                        class="fa-solid fa-eye"></i> View
                                                    Profile</a></li> <a href="/edit/{{$product->id}}"> --}}
                                                <li>
                                                    @if (auth()->user()->type == 'admin')
                                                        <a class="dropdown-item"
                                                            href="/staffsalaryedit/{{ $salary->staff_id }}/{{ $salary->date }}"><i
                                                                class="fa-solid fa-pen"></i> Edit</a>
                                                    @elseif (auth()->user()->type == 'clerk')
                                                        <a class="dropdown-item"
                                                            href="/clerk/staffsalaryedit/{{ $salary->staff_id }}/{{ $salary->date }}"><i
                                                                class="fa-solid fa-pen"></i> Edit</a>
                                                    @else
                                                        return redirect()->route('home');
                                                    @endif



                                                </li>
                                                {{-- {{ url('edit-recipient').'/'.$item->rpt_id }}" --}}
                                                {{-- <li><a class="dropdown-item" href="#"><i
                                                        class="fa-solid fa-trash "></i>
                                                    Delete</a></li> --}}
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        

        {{-- model 2 view --}}



    @endsection
    @push('other-scripts')
        // <script>
        //     function add() {
        //         $(document).ready(function() {


        //             let basic = parseInt($('#basic').val());
        //             // alert("basic");
        //             let overtime = parseInt($('#overtime').val());
        //             let allowance = parseInt($('#allowance').val());
        //             let bonus = parseInt($('#bonus').val());
        //             let reduction = parseInt($('#reduction').val());


        //             $('#net_salary').on('click', function() {
        //                 let net_salary = basic + overtime + allowance + bonus - reduction;
        //                 document.getElementById("net_salary").value = net_salary;
        //             });
        //         })
        //     }
        // </script>

<script>
    $(document).ready(function() {
        // Function to fetch salary details for a specific staff_id
        function fetchSalaryDetails(staffId) {
            $.ajax({
                url: '/get-salary-by-staff/' + staffId, // Corrected URL
                method: 'GET',
                success: function(response) {
                    // Pre-fill input fields with fetched data
                    $('#basic').val(response.data[0].basic_salary || '');
                    $('#overtime').val(response.data[0].overtime || '');
                    $('#allowance').val(response.data[0].allowance || '');
                    $('#bonus').val(response.data[0].bonus || '');
                    $('#reduction').val(response.data[0].reduction || '');

                    // Trigger net salary calculation
                    calculateNetSalary();
                },
                error: function(error) {
                    console.error('Error fetching salary details:', error);
                }
            });
        }

        function calculateNetSalary() {
            let basic = parseInt($('#basic').val()) || 0;
            let overtime = parseInt($('#overtime').val()) || 0;
            let allowance = parseInt($('#allowance').val()) || 0;
            let bonus = parseInt($('#bonus').val()) || 0;
            let reduction = parseInt($('#reduction').val()) || 0;

            let net_salary = basic + overtime + allowance + bonus - reduction;
            $('#net_salary').val(net_salary);
        }

        // Bind the fetchSalaryDetails function to the change event of the staff_id select
        $('#staff_id').change(function() {
            var staffId = $(this).val(); // Get the selected staff_id
            fetchSalaryDetails(staffId);
        });

        // Trigger fetchSalaryDetails when the document is ready, assuming you want to get the initial staff_id
        var initialStaffId = $('#staff_id').val(); // Get the initial selected staff_id
        fetchSalaryDetails(initialStaffId);

        // Bind the calculateNetSalary function to the change event of specified input fields
        $('#basic, #overtime, #allowance, #bonus, #reduction').on('change', function() {
            calculateNetSalary();
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#sf_position').change(function() {
            var sf_position = $(this).val();
// alert(sf_position);
            // Make an AJAX request to fetch students based on the selected class
            $.ajax({
                url: "{{ url('get-staff-by-position') }}",
                type: "POST",
                data: {
                    sf_position: sf_position,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Clear previous options
                    $('#staff_id').empty();
                    console.log(response, 'hiii');
                    // Populate students based on the response
                    $('#staff_id').append('<option disabled selected>Select Staff</option>');
                    $.each(response.staff, function(index, staff) {
                        $('#staff_id').append('<option value="' + staff.id + '">' + staff.sf_name + '</option>');
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
